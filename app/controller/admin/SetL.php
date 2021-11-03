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
            'kl' => Set::get(C::key_kl),
            'kl_fee' => Set::get(C::key_kl_fee),
            'account_err_times' => Set::get(C::key_account_err_times,15),
            'kl_fee1' => Set::get(C::key_kl_fee1),
            'kl_link' => Set::get(C::key_kl_link),
        ]);
    }

    public function set_set($k, $v)
    {
        if (!str_starts_with($k, 'key-')) return Js::err('参数错误');
        Set::put($k, $v);
        return Js::suc();
    }
}