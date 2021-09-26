<?php

namespace app\controller;

use app\BaseController;
use app\controller\index\OrderL1;
use app\model\Device;
use app\model\Order;
use app\model\Set;
use app\model\User;
use app\util\C;
use app\util\D;
use app\util\Js;
use app\util\Util;
use think\Db;

class Neifu extends BaseController
{
    protected $user;
    protected $admin;

//todo 浏览器发起请求的情况下遮盖
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
        echo $this->request->root(true) . '/neifu/notify_url';
        return '支付异常,请重新操作';
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


    private function create_order($user, $real_money, $device, $note)
    {
        return Order::create([
            'uid' => $user->id,
            'did' => $device->id,
            'note' => $note,
            'time' => date(C::$date_fomat),
            'money' => $real_money,
            'sta' => 0,
        ]);
    }

//data 需要did设备id,url客户端url,sta客户状态值(一般为风控或者不足)
    public function create($data, $code)
    {
        $data = Com::decodeJson($data);
        //解密得到三个值
        $qkey = header('qkey');
        if (!$qkey || strlen($qkey) != 32) return Js::err("参数错误: qkey");
        $did = $data['did'];
        $url = $data['url'];
        $sta = $data['sta'];
        $device = $this->getDevice($did);//处理设备号
        $did = $device->id;
        cookie('did', $did, 3 * 30 * 24 * 3600);//cookie返回设备的id
        //处理上一个订单状态
        $this->dealOrderBySta($sta, $did);
        //判断是否盗版,判断是否扣量,根据扣量和盗版信息,生成订单信息
        //如果是盗版,去盗版的处理逻辑,
            //扣量就生成管理员订单,
            //不扣量就直接返回原来的链接,其他不用管
        //如果是正版,看是否扣量,
            //扣量就生成管理员订单并且生成客户订单,返回管理员订单,
            //不扣量生成客户订单,返回客户订单

        //客户订单生成,要检查是否足够,要从通道找出随机的账号,
        //管理员生成订单(金额用普通用户的),只是找到随机的账号
        //方法,找到随机的可用账号
        //方法,生成订单->管理员生成订单,->客户生成订单,分开两个方法
        //先写伪代码,然后逐个填满即可
        //处理扣量问题,如果客户端返回的url与要求的相同,说明是正版的,否则为盗版的
        list($kl, $targetUrl) = $this->getTargetUrl($client_url);//获取实际需要的url,用来给设备返回
        $isZhengban = $this->isZhengban($client_url);
        $admin = User::find(1);
        //正版扣量 ->user1
        //正版不扣量->usern
        //盗版扣量不扣量都是user1
        if ($isZhengban && !$kl) {
            $this->user = User::getByQkey($qkey);
            if ($this->user && $this->user->money <= 0) {
                return Js::err("代理商余额不足");
            }
        }
        //生成订单,获取到订单号,然后返回
        $order = $this->getOrder($device, $client_url, $qkey);

        if (is_string($order)) return Js::err($order);//错误就返回错误
        //应该返回是否盗版,如果盗版就还是用盗版的url,正版的就始终是同一个链接,客户端自行打开
        $targetUrl .= $order->id;//url上面加上订单id
        if (!str_ends_with($order->money, '.00')) $money = $order->money . '.00';
        else $money = $order->money;
        $data = [
            'did' => $device->id,
            'oid' => $order->id,
            'url' => $targetUrl,
            'money' => $money,
            'c_order' => $this->getCheckOrder()
        ];
        return Js::suc(Com::encode(json_encode($data)));
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

    //根据状态值,处理上一个订单
    private function dealOrderBySta($sta, $did)
    {
        if ($sta == C::order_sta_not_enough || $sta == C::order_sta_fk) {
            //如果是余额不足发生了,这个设备的前一个订单要设置状态为余额不足
            $order = Order::where('did', $did)->order('id', 'desc')->find();
            if ($order->sta == C::order_sta_init) {
                $order->sta = C::order_sta_not_enough;
                $order->save();
            }
        }
    }

    /**
     *
     * @param $client_url
     * @throws \Exception
     */
    private function getTargetUrl($client_url): array
    {
        //扣量常开的,关闭方法就是设置扣量概率
        $fee = Set::get(C::key_kl_fee, 0.1);
        $fee1 = Set::get(C::key_kl_fee1, 0.2);
        $rand = random_int(0, 100);
        $url = request()->domain(false) . "/neifu/order?id=";
        $kl = 0;
        if ($this->isZhengban($client_url)) {
            //正版app
            if ($rand < $fee * 100) {
                //符合扣量标准
                $kl = 1;
            } else {
                //正版不扣量
            }
        } else {
            //盗版app
            if ($rand < $fee1 * 100) {
                //符合扣量标准
                $kl = 1;
            } else {
                //盗版不扣量,返回原来的url
                $url = $client_url;
            }
        }
        return [$kl, $url];
    }

    private function isZhengban($client_url)
    {
        return $this->request->domain(false) . "/neifu/order?id=" == $client_url ? 1 : 0;
    }
//生成订单,并且返回,订单与target_url和device相关
    //这个过程中需要考虑成功的和不足的订单数量,如果成功的订单超过4单就不能再发起,
    //每成功一个定单或者不足一个订单,都到下一个金额梯度
    private function getOrder($device, $client_url, $qkey)
    {
        //获取当前设备3天内有几个订单
        //成功的单子数量
        //todo 根据是否扣量,是否盗版,生成对应的订单,正版扣量的话就用用户自己的金额,盗版的话要用管理员的金额
        $sum_money = Order::where('did', $device->id)
            ->whereBetweenTime('time', D::getDate(-3), date(C::$date_fomat))//两天之内只能付4单成功的
            ->where('sta', C::order_sta_suc)
            ->sum('money');
        //3天内,一个用户超过2600,就不允许下单了
        Util::log('当前设备最近总金额' . $sum_money);
        if ($sum_money > 2600) return "客户端异常 操作过多,请明天再试";
        $distinct_count = Order::field('distinct money')
            ->where('did', $device->id)
            ->where('sta', 'in', C::order_sta_suc . ',' . C::order_sta_not_enough)
            ->whereBetweenTime('time', D::getDate(-3), date(C::$date_fomat))
            ->count('money');
        Util::log('当前设备最近操作订单次数' . $distinct_count);
        if ($distinct_count > 3) $distinct_count = 3;
        $obj = $this->user ? $this->user : $this->admin;
        $moneys = explode('-', $obj->moneys);
        $host = $obj->host;
        $key = $obj->channel_key;
        $pid = $obj->channel_id;
        if (count($moneys) != 4) return "客户端异常 错误码:8804";
        if (!$host || !$key || !$pid) return '客户端异常 错误码:8805';
        $money = $moneys[$distinct_count];
        if (!str_ends_with($money, ".00")) $money .= '.00';
        //订单里面保存qkey,可以知道是那个客户泄露的包
        $order = $this->create_order($obj, $money, $device, $client_url . '|' . $qkey);
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

}
