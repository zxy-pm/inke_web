<?php

namespace app\util;
//Qrtongdao 对应的支付生成和通知接受方法
use app\model\Order;
use app\model\User;

class QrTongDao
{
    public static function getParam($order, $user)
    {


        $paykey = $user->channel_key;
        $url = $user->host;
        $parameter = array(
            "pid" => $user->channel_id . '',//商户ID
            "type" => "html",//支付方式 , json
            "out_trade_no" => $order->id . '-' . $user->id,//订单号
            "notify_url" => "http://" . $_SERVER['HTTP_HOST'] . "/neifu2/qr_notify",//异步地址
            "return_url" => "http://" . $_SERVER['HTTP_HOST'] . "/neifu2/return_url", //同步地址
            "name" => '套餐', //商品名
            "money" => (string)$order->money, //金额
        );
        ksort($parameter);
        reset($parameter);
        $fieldString = [];
        foreach ($parameter as $key => $value) {
            if (!empty($value)) {
                $fieldString[] = $key . "=" . $value . "";
            }
        }
        $fieldString = implode('&', $fieldString);
        $parameter['sign'] = md5($fieldString . $paykey);
        //return $parameter;
        //下面的暂时不加,看看能不能正常跳转,如果不行再加上去,可以就不加了,省的浪费时间
        //post请求
        $header = array('KTYPE:naizhao', 'User-Agent:' . $_SERVER['HTTP_USER_AGENT']);
        //请求头Ktype User-Agent必须带 不支持from表单提交 User-Agent 用于识别客户浏览器UA
        $html = self:: curl($url, $header, $parameter);
       $html.="<script/>$(\"#money\").html(\"¥1.00\");</script>";
        echo $html;

    }

    public static function notify()
    {
        $trade_status = $_REQUEST['trade_status'];//TRADE_SUCCESS成功
        if ($trade_status != 'TRADE_SUCCESS') return 'fail';
        $out_trade_no = $_REQUEST['out_trade_no'];//提交的订单号
        $trade_no = $_REQUEST['trade_no'];//平台订单号
//回调参数，out_trade_no，out_trade_no，name，money
        if (!$out_trade_no) return 'order out_trade_no err 2';
        $out_trade_no = explode('-', $out_trade_no);
        if (count($out_trade_no) != 2) return 'order out_trade_no err 3';
        $order = Order::find($out_trade_no[0]);
        if (!$order) return 'order err 4';
        $user = User::find($order->uid);
        if (!$user) return 'order user err 5';
        //回调sgin算法
        $sign = md5(substr(md5($out_trade_no[0].'-'.$out_trade_no[1] . $trade_no . $user->channel_key), 10));//$key是你的秘钥
        if ($sign == $_REQUEST['newsign']) {//原来的参数sign 弃用
            //修改成功代码
            $order->finish_time = date(C::$date_fomat);
            $order->sta = 1;
            $order->trade_no = $trade_no;
            $order->save();
            $user->money -= $user->fee * $order->money;
            $user->save();
            echo 'success';//这里是告诉平台支付成功，此信息务必带上，否则异步通知将降速
        } else return 'sign err 1';
    }

    public static function curl($sUrl, $aHeader, $aData)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $sUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeader);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);// 不可去掉 否则拉起慢
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($aData));
        $sResult = curl_exec($ch);
        if ($sError = curl_error($ch)) {
            die($sError);
        }
        curl_close($ch);
        return $sResult;
    }

}