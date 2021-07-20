<?php


namespace app\model;


use think\Model;

class Channel extends Model
{
    protected $table = 'channel';

    public function accounts()
    {
        return $this->hasMany(Account::class, 'cid');
    }


}