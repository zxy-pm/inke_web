<?php


namespace app\model;


use app\util\C;
use think\facade\Db;
use think\Model;

class Account extends Model
{
    protected $table = 'account';

    public static function getAccount_canUse($uid)
    {
        $account = Account::
        whereColumn('num', '<', 'max')
            ->where('uid', $uid)
            ->where('sta', 1)
            ->order('time', 'asc')
            ->find();

        if ($account) {
            $account->time = date(C::$date_fomat);
            $account->save();//记录时间,实现轮询
            return $account;
        }
        return null;

    }

}