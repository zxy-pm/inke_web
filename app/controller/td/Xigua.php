<?php


namespace app\controller\td;


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
            $order['sta'] = 3;
            $order->save();
            return '订单过期未支付,id:' . $order->id;
        } elseif ($res['code'] == 'CA3001') {
            //交易成功了
            $order['sta'] = 1;
            $order->save();
            return '支付成功,id:' . $order->id;
        } else {
            dump($res);
        }
    }

}