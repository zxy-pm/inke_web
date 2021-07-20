<?php


namespace app\model;


use think\facade\Db;
use think\Model;

class Account extends Model
{
    protected $table = 'account';

    public static function getAccount_canUse($uid)
    {
        $account = Account::
        whereColumn('num', '<', 'max')
            ->where('uid', $uid)->where('sta', 1)
            ->where('sta', 1)
            ->order('time', 'asc')->find();
        if ($account) return $account;
        return null;

    }

}