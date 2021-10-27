<?php


namespace app\util;


use app\model\Change;
use app\model\Device;
use app\model\Order;

class D
{
    //获取n天后的日期值,时分秒都是0
    public static function getDate(int $day)
    {
        return date('Y-m-d 00:00:00', strtotime($day . ' days'));
    }

//获取n天的时间值
    public static function getDateAgo(int $day)
    {
        return date('Y-m-d H:i:s', strtotime($day . ' days'));
    }

//获取n分钟后的时间值
    public static function getDateMinuteAgo(int $minute)
    {
        return date('Y-m-d H:i:s', strtotime($minute . ' minute'));
    }

//获取n秒后的时间值
    public static function getDateSecondAgo(int $second)
    {
        return date('Y-m-d H:i:s', strtotime($second . ' second'));
    }

    public static function clearOrderChange()
    {
        try {
            Order::whereTime('time', '<', D::getDate(-3))->delete();
            Change::whereTime('time', '<', D::getDate(-3))->delete();
            Device::whereTime('time', '<', D::getDate(-6))->delete();
        } catch (\Exception $e) {
        }

    }

}