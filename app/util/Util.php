<?php


namespace app\util;


use think\facade\Log;

class Util
{

    public static function rand($num)
    {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle($chars), 0, $num);
    }

    public static function log($s)
    {
        if (env('app_debug')) {
            if (is_string($s))
                Log::error($s);
        }
    }
}