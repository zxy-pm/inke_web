<?php


namespace app\model;


use app\util\C;
use think\Model;

class Act extends Model
{
    protected $table = 'act';

    public static function create_one($did, $sta)
    {
        Act::create(['did' => $did, 'p' => 0, 'sta' => $sta, 'time' => date(C::$date_fomat)]);
    }
}