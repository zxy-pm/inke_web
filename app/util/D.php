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
    }

    public static function clearOrderChange()
    {
        try {
             Order::whereTime('time', '<', D::getDate(-3))->delete();
             Change::whereTime('time', '<', D::getDate(-3))->delete();
             Device::whereTime('time', '<', D::getDate(-5))->delete();
        } catch (\Exception $e) {
        }

    }

}