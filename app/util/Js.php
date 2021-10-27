<?php


namespace app\util;


class Js
{
    public static function js($msg = 'ok', $code = 0, $data = null, $count = 0)
    {
        return json(['code' => $code, 'msg' => $msg, 'data' => $data, 'count' => $count]);
    }

    public static function suc($data = [], $msg = 'ok', $code = 0, $count = 0)
    {
        return self::js($msg, $code, $data, $count);
    } public static function sucMsg( $msg = 'ok',$data = [], $code = 0, $count = 0)
    {
        return self::js($msg, $code, $data, $count);
    }

    public static function err($msg = '请求错误', $code = 1, $data = null, $count = 0)
    {
        return self::js($msg, $code, $data, $count);
    }

    public static function logout($msg = '登录过期', $code = -1, $data = null, $count = 0)
    {
        return self::js($msg, $code, $data, $count);
    }

    public static function b64suc($data)
    {
        //todo 后期考虑加密传输
    }
}