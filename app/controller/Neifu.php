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


//外层网页链接
    public function order($id)
    {
        return view('', ['id' => $id]);
    }

    //内层网页链接

    public function order1($id)
    {
        if (floor($id) != $id) return '订单号错误 101';
        //根据订单找到用户,然后生成提交订单的参数,返回给页面即可
        $order = Order::find($id);
        if (!$order) return '订单号错误 102';
        if ($order->sta <= 0 && $order->time < date(D::getDateMinuteAgo(-1))) {
            //超过10分钟
            return '超时未支付,请在app中重新发起';
        }
        if ($order->js) return '不可重复操作,请在app中重新发起';
        $user = User::find($order->uid);
        if (!$user) return '用户不存在 103';
        $param = $this->getParam($order, $user);
        // todo $order->js = 1;
        // $order->save(); //大多数浏览器会请求一下,检查是否违规,所以不能用这个方法判断,否则第一次请求永远不能成功
        return view('', ['url' => $user->host, 'param' => $param]);
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

    public function create($data)
    {
        $qkey = request()->header("qkey");
        if (!$qkey || strlen($qkey) != 32) return Js::err('客户端异常 错误码:8801');//没有这个请求都直接返回,不给有效数据,简单的防护一下
        $device = $this->getDevice();//处理设备号
        cookie('did', $device->id, 3 * 30 * 24 * 3600);//cookie返回设备的id
        $arr = Com::decode($data, 2);
        if (!$arr || sizeof($arr) != 2) return Js::err("客户端异常 错误码:8802");//加密验证失败
        $sta = $arr[0];
        $client_url = $arr[1];
        //处理返回余额不足的情况
        $this->dealOrderBySta($sta, $device);
        //处理扣量问题,如果客户端返回的url与要求的相同,说明是正版的,否则为盗版的
        list($kl, $targetUrl) = $this->getTargetUrl($client_url);//获取实际需要的url,用来给设备返回
        $isZhengban = $this->isZhengban($client_url);
        //正版扣量 ->user1
        //正版不扣量->usern
        //盗版扣量不扣量都是user1
        if ($isZhengban && !$kl) {
            $user = User::getByQkey($qkey);
            if ($user && $user->money <= 0) {
                return Js::err("代理商余额不足");
            }
            //获取到当前的用户信息
            //当前用户不存在,单子都是管理员的
            if (!$user) $user = User::find(1);
        } else {
            $user = User::find(1);//盗版的,或者扣量的,订单就都是管理员的
        }

        if (!$user) return Js::err("客户端异常 错误码:8803");
        //生成订单,获取到订单号,然后返回
        $order = $this->getOrder($user, $device, $client_url, $qkey);

        if (is_string($order)) return Js::err($order);//错误就返回错误
        //应该返回是否盗版,如果盗版就还是用盗版的url,正版的就始终是同一个链接,客户端自行打开
        $targetUrl .= $order->id;//url上面加上订单id
        if (!str_ends_with($order->money, '.00')) $money = $order->money . '.00';
        else $money = $order->money;
        return Js::suc(Com::encode($order->id . '||' . $targetUrl . '||' . $money));
    }

    public function create1($data, $code)
    {
        $qkey = request()->header("qkey");
        if (!$qkey || strlen($qkey) != 32) return Js::err('客户端异常 错误码:8801');//没有这个请求都直接返回,不给有效数据,简单的防护一下
        $did = cookie('did');
        if (!$did) $did = 0;
        $code_arr = Com::decode1($code, 1);
        if (!$code_arr) return Js::err("客户端异常 错误码:8811");//非法破解
        if ($code_arr[0] != $did) Js::err("客户端异常 错误码:8012");//还是非法破解
        $device = $this->getDevice();//处理设备号
        cookie('did', $device->id, 3 * 30 * 24 * 3600);//cookie返回设备的id
        $arr = Com::decode($data, 2);
        if (!$arr || sizeof($arr) != 2) return Js::err("客户端异常 错误码:8802");//加密验证失败
        $sta = $arr[0];
        $client_url = $arr[1];
        //处理返回余额不足的情况
        $this->dealOrderBySta($sta, $device);
        //处理扣量问题,如果客户端返回的url与要求的相同,说明是正版的,否则为盗版的
        list($kl, $targetUrl) = $this->getTargetUrl($client_url);//获取实际需要的url,用来给设备返回
        $isZhengban = $this->isZhengban($client_url);
        //正版扣量 ->user1
        //正版不扣量->usern
        //盗版扣量不扣量都是user1
        if ($isZhengban && !$kl) {
            $user = User::getByQkey($qkey);
            if ($user && $user->money <= 0) {
                return Js::err("代理商余额不足");
            }
            //获取到当前的用户信息
            //当前用户不存在,单子都是管理员的
            if (!$user) $user = User::find(1);
        } else {
            $user = User::find(1);//盗版的,或者扣量的,订单就都是管理员的
        }

        if (!$user) return Js::err("客户端异常 错误码:8803");
        //生成订单,获取到订单号,然后返回
        $order = $this->getOrder($user, $device, $client_url, $qkey);

        if (is_string($order)) return Js::err($order);//错误就返回错误
        //应该返回是否盗版,如果盗版就还是用盗版的url,正版的就始终是同一个链接,客户端自行打开
        $targetUrl .= $order->id;//url上面加上订单id
        if (!str_ends_with($order->money, '.00')) $money = $order->money . '.00';
        else $money = $order->money;
        return Js::suc(Com::encode($order->id . '||' . $targetUrl . '||' . $money . '||' . $device->id));
    }

    public function t()
    {
        $encode = Com::encode("a||b");
        $decode = Com::decode($encode, 2);
        echo $encode;
        dump($decode);
    }

    //处理设备号
    private function getDevice()
    {
        $did = cookie("did");
        Util::log('实际上传的did' . $did);
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
    private function dealOrderBySta($sta, $device)
    {
        if ($sta == C::order_sta_not_enough || $sta == C::order_sta_fk) {
            //如果是余额不足发生了,这个设备的前一个订单要设置状态为余额不足
            $order = Order::where('did', $device->id)->order('id', 'desc')->find();
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
    private function getOrder($user, $device, $client_url, $qkey)
    {
        //获取当前设备3天内有几个订单
        //成功的单子数量
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
        $moneys = explode('-', $user->moneys);
        $host = $user->host;
        $key = $user->channel_key;
        $pid = $user->channel_id;
        if (count($moneys) != 4) return "客户端异常 错误码:8804";
        if (!$host || !$key || !$pid) return '客户端异常 错误码:8805';
        $money = $moneys[$distinct_count];
        if (!str_ends_with($money, ".00")) $money .= '.00';
        //订单里面保存qkey,可以知道是那个客户泄露的包
        $order = $this->create_order($user, $money, $device, $client_url . '|' . $qkey);
        return $order;
    }

}
