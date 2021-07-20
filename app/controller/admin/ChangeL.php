<?php


namespace app\controller\admin;


use app\model\Change;
use app\model\Set;
use app\model\User;
use app\util\C;
use app\util\Js;
use Cassandra\Time;

class ChangeL extends BaseL
{
    public function changes($page)
    {
        return Js::suc(Change::where('uid', $this->user->id)->page($page, C::$page_num)->order('id', 'desc')->select());

    }

    public function all_changes($page)
    {
        if ($this->user->type != 1) return Js::err('没有权限');
        return Js::suc(Change::page($page, C::$page_num)->order('id', 'desc')->select());
    }
}