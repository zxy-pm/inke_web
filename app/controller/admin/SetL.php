<?php


namespace app\controller\admin;


use app\model\Set;
use app\model\User;
use app\util\C;
use app\util\Js;
use Cassandra\Time;

class SetL extends BaseL
{
    public function set_get()
    {
        return Js::suc([
            'notice' => Set::get(C::key_notice),
        ]);
    }

    public function set_set($k, $v)
    {
        if (!str_starts_with($k, 'key-')) return Js::err('参数错误');
        Set::put($k, $v);
        return Js::suc();
    }
}