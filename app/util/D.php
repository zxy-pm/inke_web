<?php


namespace app\util;


use app\model\Change;
use app\model\Device;
use app\model\Order;

class D
{
    public static function getDate(int $day)
    {
        return date('Y-m-d 00:00:00', strtotime($day . ' days'));
    }

    public static function getDateMinute(int $minute)
    {
        return date('Y-m-d H:i:00', strtotime($minute . ' minute'));
    }


    public static function getDateSecond(int $second)
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