<?php


namespace app\model;


use think\Model;

class User extends Model
{
    protected $table = 'user';

    public function orders()
    {
        return $this->hasMany(Order::class, 'uid');
    }

    public function kl()
    {
        if (!$this->kl) return 0;
        $s = $this->klsd;
        $spans = explode(',', $s);
        $hour_now = (int)date('H');
        foreach ($spans as $span) {
            $hours = explode('-', $span);
            if (count($hours) == 2) {
                if ($hour_now >= $hours[0] && $hour_now < $hours[1]) {
                    //在范围之内,需要扣量
                    //生成一个随机数,如果随机数小于某一个值,就扣,大于就不扣
                    $rand = rand(0, 1000);
                    $num = $this->kl_fee * 1000;
                    if ($rand <= $num) {
                        return 1;
                    }

                }
            }
        }
        return 0;
    }

}