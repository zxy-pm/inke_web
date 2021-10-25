<?php

namespace app\controller;

use app\BaseController;
use app\controller\index\OrderL1;
use app\model\Account;
use app\model\Device;
use app\model\Order;
use app\model\Set;
use app\model\User;
use app\util\C;
use app\util\D;
use app\util\Js;
use app\util\Util;
use think\Db;
use think\response\View;

class Neifu2 extends BaseController
{
    protected $user;
    protected $admin;

    /**
     * @param $url 订单对应的url
     * @param $data 订单相关情况
     * @return \think\response\Json|View
     */
    public function nei($url)
    {
        return view('/neifu/nei', ['url' => $url]);
    }

    public function order_info($data)
    {
        $data = Com::decodeJson($data);
        if (!$data) return Js::err('参数错误');
        $oid = $data['oid'];
        $trade_no = $data['trade_no'];
        $note = $data['data'];
        if (!$oid || !$trade_no) Js::err('参数错误');
        $order = Order::find($oid);
        if (!$order) Js::err('订单不存在');
        $order->trade_no = $trade_no;
        $order->note = $note;
        $order->save();
        return Js::suc("");
    }

//外层网页链接
    public function order($id)
    {
        return view('/neifu/order', ['id' => $id]);
    }

    //内层网页链接

    public function order1($id)
    {
        if (floor($id) != $id) return '订单号错误 101';
        //根据订单找到用户,然后生成提交订单的参数,返回给页面即可
        $order = Order::find($id);
        if (!$order) return '订单号错误 102';
        if ($order->sta <= 0 && $order->time < date(D::getDateMinute(-1))) {
            //超过10分钟
            return '超时未支付,请在app中重新发起';
        }
        if ($order->js > 2) return '不可重复操作,请在app中重新发起';
        $user = User::find($order->uid);
        if (!$user) return '用户不存在 103';
        $param = $this->getParam($order, $user);
        $order->js++;
        $order->save(); //大多数浏览器会请求一下,检查是否违规,所以不能用这个方法判断,否则第一次请求永远不能成功
        return view('/neifu/order1', ['url' => $user->host, 'param' => $param]);
    }

    public function notify_url()
    {
        $params = $this->request->param();
        $sign = $params['sign'];
        unset($params['sign']);
        unset($params['sign_type']);
        ksort($params);
        reset($params);
        $s = '';
        foreach ($params as $k => $v) {
            if ($s == '') $s .= "$k=$v";
            else $s .= "&$k=$v";
        }
        $id = $params['out_trade_no'];
        if (!$id) return 'order id err 2';
        $id = explode('-', $id);
        if (count($id) != 2) return 'order id err 3';
        $order = Order::find($id[0]);
        if (!$order) return 'order err 4';
        $user = User::find($order->uid);
        if (!$user) return 'order user err 5';
        $sign1 = md5($s . $user->channel_key);
        if ($sign == $sign1) {
            //签名验证通过
            //获取实际订单号和金额,更新到自己的数据库中
            $order->finish_time = date(C::$date_fomat);
            $order->sta = 1;
            $order->trade_no = $params['trade_no'];
            $order->save();
            $user->money -= $user->fee * $order->money;
            $user->save();
            return 'success';
        } else {
            return 'sign err 1';
        }
    }

    public function return_url()
    {
        // echo $this->request->root(true) . '/neifu/notify_url';
        return '支付异常,请重新操作';
    }

    //查询订单,每秒查询一个订单,每个订单每分钟只查询一次
    public function sta()
    {
        //按检查时间,取出一个aid!=0的订单,并把查询时间设置为当前时间,然后查询结果,如果成功修改状态
    }

    private function getParam($order, $user)
    {
        //插入订单数据
        $param = [
            'pid' => $user->channel_id,
            'type' => 'alipay',
            'out_trade_no' => $order->id . '-' . $user->id,
            'notify_url' => $this->request->root(true) . '/neifu/notify_url',
            'return_url' => $this->request->root(true) . '/neifu/return_url',
            'name' => '套餐',
            'money' => $order->money,
        ];
        ksort($param);
        reset($param);
        $s = '';
        foreach ($param as $k => $v) {
            if ($s == '') $s .= "$k=$v";
            else $s .= "&$k=$v";
        }
        $sign = md5($s . $user->channel_key);
        $param['sign'] = $sign;
        $param['sign_type'] = 'MD5';
        return $param;
    }


    private function create_order($uid, $real_money, $did, $account, $kl)
    {
        return Order::create([
            'uid' => $uid,
            'did' => $did,
            'aid' => $account->id,
            'cid' => $account->cid,
            'time' => date(C::$date_fomat),
            'finish_time' => D::getDateSecond(30),//新创建的订单设置至少在30秒后才检查,以免浪费性能
            'money' => $real_money,
            'sta' => $kl ? 4 : 0,//扣量的话,状态值为4
        ]);
    }

//data 需要did设备id,url客户端url,sta客户状态值(一般为风控或者不足)
    public function create($data)
    {
        $data = Com::decodeJson($data);
        if (!$data) return Js::err('参数错误');
        //解密得到三个值
        $qkey = request()->header('qkey');
        if (!$qkey || strlen($qkey) != 32) return Js::err("参数错误: qkey");
        $this->user = User::getByQkey($qkey);
        if (!$this->user) return Js::err("商户不存在");
        if ($this->user && $this->user->money <= 0) return Js::err("商户余额不足");
        $did = $data['did'];
        $sta = $data['sta'];
        $device = $this->getDevice($did);//处理设备号
        $did = $device->id;
        cookie('did', $did, 3 * 30 * 24 * 3600);//cookie返回设备的id
        //处理上一个订单状态
        $this->admin = User::find(1);
        $last_time = $this->dealOrderBySta($sta, $did);
        $dateMinute = D::getDateSecond(-60);
        if ($last_time > $dateMinute) {
            //上次订单距离本次订单时间小于1分钟的情况下,不允许发起支付
            return Js::err('因排队人数过多,每分钟只能发起一次');
        }
        // 判断对接的是自己的通道还是别人的通道
        $tongdao_type = $this->user->tongdao_type;
        $kl = $this->isKl();//本次是否扣量
        $account = null;
        $account_id = 0;
        if ($kl) {
            if ($tongdao_type == C::tongdao_type_neibu) {
                // 随机获取一个可用账号,ck,name,cid,返回给客户端,并且扣量和不扣量获取的不同
                $account = Account::getAccount_canUse(1);
                if (!$account) {
                    Account::getAccount_canUse($this->user->id);
                    if (!$account) return Js::err('收款账号不足');  //用户也没有账号,返回错误
                    //管理员账号没有,找用户的.但是这个时候,订单就不是扣量的了要回到不扣量的逻辑
                    $order = $this->zhengchang_order($tongdao_type, $did);
                    return $this->returnEncode([
                        'did' => $device->id,
                        'url' => $this->request->domain(false) . "/neifu2/order?id=" . $order->id,
                        'money' => $order->money,
                        'account' => $account,
                        'oid' => $order->id,
                    ]);
                }
            } elseif ($tongdao_type == C::tongdao_type_waibu) {
                //外部通道,要检查管理员的通道信息是否设置过
                //没有设置,返回网站设置错误,联系管理员
                if ($this->check_tongdao($this->admin)) return Js::err("网站配置有误,请联系管理员");
            }
            //扣量,生成两个订单,但返回admin订单
            $order1 = $this->getUserOrder($did, $account, true);
            $order = $this->getAdminOrder($order1);
        } else {
            $order = $this->zhengchang_order($tongdao_type, $did);
        }


        return $this->returnEncode([
            'did' => $device->id,
            'url' => $this->request->domain(false) . "/neifu2/order?id=" . $order->id,
            'money' => $order->money,
            'account' => $account,
            'oid' => $order->id,
        ]);
    }

    //生成正常订单
    private function zhengchang_order($tongdao_type, $did)
    {
        if ($tongdao_type == C::tongdao_type_neibu) {
            // 随机获取一个可用账号,ck,name,cid,返回给客户端,并且扣量和不扣量获取的不同
            $account = Account::getAccount_canUse($this->user->id);
            if (!$account) return Js::err('收款账号不足');  //没有账号,返回错误
        } elseif ($tongdao_type == C::tongdao_type_waibu) {
            //外部通道,要检查  用户的通道信息是否设置过,没有设置返回外部通道设置错误
            if ($this->check_tongdao($this->admin)) return Js::err("通道信息设置错误");
        }
        //不扣量,生成一个订单,只有用户的订单
        return $this->getUserOrder($did, $account, false);

    }

    private function check_tongdao($obj)
    {
        $moneys = explode('-', $obj->moneys);
        $host = $obj->host;
        $key = $obj->channel_key;
        $pid = $obj->channel_id;
        if (count($moneys) != 4) return "金额设置错误";
        if (!$host || !$key || !$pid) return '通道信息错误';
    }

    public function returnEncode($arr)
    {
        return Js::suc(Com::encode(json_encode($arr)));
    }

    public function t()
    {
        $encode = Com::encode("a||b");
        $decode = Com::decode($encode, 2);
        echo $encode;
        dump($decode);
    }

    //处理设备号
    private function getDevice($did)
    {
        if (!$did) {
            //设备不存在,新建
            return Device::create(['time' => \date(C::$date_fomat),]);
        } else {
            //存在id,查找
            $device = Device::find($did);
            if (!$device) { //实际不存在设备,新建
                return Device::create(['time' => \date(C::$date_fomat),]);
            }
            return $device;//实际也是存在的,直接返回
        }
    }

    //根据状态值,处理上一个订单,返回一个值,他的上一个订单的时间
    private function dealOrderBySta($sta, $did)
    {
        $order = Order::where('did', $did)->order('id', 'desc')->find();
        if (!$order) return '';
        if ($sta == C::order_sta_not_enough || $sta == C::order_sta_fk) {
            //如果是余额不足发生了,这个设备的前一个订单要设置状态为余额不足
            if ($order->sta == C::order_sta_init) {
                $order->sta = C::order_sta_not_enough;
                $order->save();
            }
        }
        return $order->time;

    }


//本次是否要扣量
    private function isKl()
    {
        $fee = Set::get(C::key_kl_fee, 0.1);
        $rand = random_int(0, 100);
        return $rand < $fee * 100;
    }

//生成订单,并且返回,订单与target_url和device相关
    //这个过程中需要考虑成功的和不足的订单数量,如果成功的订单超过4单就不能再发起,
    //每成功一个定单或者不足一个订单,都到下一个金额梯度
    private function getUserOrder($did, $account, $kl)
    {
        //获取当前设备3天内有几个订单
        //成功的单子数量
        $sum_money = Order::where('did', $did)
            ->whereBetweenTime('time', D::getDate(-3), date(C::$date_fomat))
            ->where('sta', C::order_sta_suc)
            ->sum('money');
        //3天内,一个用户超过2600,就不允许下单了
        Util::log('当前设备最近总金额' . $sum_money);
        if ($sum_money > 2600) return "客户端异常 操作过多,请明天再试";
        $distinct_count = Order::field('distinct money')
            ->where('did', $did)
            ->where('sta', 'in', C::order_sta_suc . ',' . C::order_sta_not_enough)
            ->whereBetweenTime('time', D::getDate(-3), date(C::$date_fomat))
            ->count('money');
        Util::log('当前设备最近操作订单次数' . $distinct_count);
        if ($distinct_count > 3) $distinct_count = 3;
        $moneys = explode('-', $this->user->moneys);
        if (count($moneys) != 4) return "客户端异常 错误码:8804";
        $money = $moneys[$distinct_count];
        if (!str_ends_with($money, ".00")) $money .= '.00';
        //订单里面保存qkey,可以知道是那个客户泄露的包
        $order = $this->create_order($this->user->id, $money, $did, $account, $kl);
        return $order;
    }


    //获取需要检查状态的订单id,同时要把她的账号对应的ck值返回
    public function getCheckOrder()
    {
        //获取一个没有经过验证的,并且时间超过15分钟的,并且按时间从小到大排序的订单
        $order = Order::field('id,cid')
            ->whereTime('time', '>', D::getDateMinute(15))
            ->order('time', 'asc')
            ->find();
        return $order;
    }

//创建一个admin的订单
    private function getAdminOrder(\think\Model $order1)
    {

        $order1->uid = 1;
        $order1->sta = 0;
        //其他的都是一样的,因为这个本身就是扣量订单,账号信息就是用的admin的,user只是生成一个假订单而已
        unset($order1['id']);
        return Order::create($order1->toArray());
    }

}
