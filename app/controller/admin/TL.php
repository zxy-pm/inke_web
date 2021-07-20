<?php


namespace app\controller\admin;


use app\model\Set;
use app\model\User;
use app\util\C;
use app\util\D;
use app\util\Js;
use Cassandra\Time;

/**
 * Class TL 用来测试的类
 * @package app\controller\admin
 */
class TL extends BaseL
{

    public function t()
    {
        D::clearOrderChange();
        return 'ok';
    }
}