<?php


namespace app\controller\td;


use app\model\Account;
use app\model\User;
use app\util\C;
use app\util\D;
use app\util\Net;

class Xigua
{
//    public static $url = "http://127.0.0.1:8001/t/t";
    public static $url = "https://tp-pay.snssdk.com/gateway-cashier2/tp/cashier/trade_create";
    public static $method = "post";
    public static $param = ['scene' => 'h5', 'risk_info' => '{"device_platform":"android"}', 'biz_content' => ''];

    public static function sta($order)
    {
        self::$param['biz_content'] = $order->note;
        $res = Net::posturl(self::$url, self::$param);
        $order['finish_time'] = date(C::$date_fomat);
        if ($res['code'] == 'CA3002') {
            //过期了
            if ($order['sta'] == 0)//其他情况下(不足,或者风控)不用修改
                $order['sta'] = 3;
            $order->save();
            return '订单过期未支付,id:' . $order->id;
        } elseif ($res['code'] == 'CA3001') {
            //交易成功了
            $order['sta'] = 1;
            $user = User::field('id,money,fee')->find($order->uid);
            if ($user) {
                $user->money -= $order->money * $user->fee;//用户余额扣减
                $user->save();
            }
            //找到对应的账号,账号收款总数增加上去
            $account = Account::find($order->aid);
            if ($account) {
                if (!is_numeric($account->money)) {
                    $account->money = 0;
                }
                $account->money += $order->money;
                $account->save();
            }
            $order->save();
            return '支付成功,id:' . $order->id;
        } elseif ($res['code'] == 'CA0000') {
            $order->save();
            return '等待支付中...,id:' . $order->id;
        } else {
            $order->save();
            return '状态异常,id:' . $order->id . '  ' . json_encode($res);
        }

    }

}