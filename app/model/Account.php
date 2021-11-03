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
        $account = Account::withoutField('e3,e1,e4')
            ->whereColumn('num', '<', 'max')
            ->where('uid', $uid)
            ->where('sta', 1)
            ->where('e2', '<=', Set::get(C::key_account_err_times, 15))//账号异常5次就不再收款
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