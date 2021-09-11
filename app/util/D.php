<?php


namespace app\util;


use app\model\Change;
use app\model\Device;
use app\model\Order;

class D
{
    public static function getDate(int $day)
    {
        return date('Y-m-d', strtotime($day . ' days'));
    }public static function getDateMinute(int $minute)
    {
        return date('Y-m-d H:i', strtotime($minute . ' minute'));
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