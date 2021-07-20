<?php


namespace app\model;


use think\Model;

class Set extends Model
{
    protected $table = 'set';

    public static function put($k, $v)
    {
        $set = Set::getByK($k);
        if ($set) {
            $set->v = $v;
            $set->save();
        } else {
            Set::create(['k' => $k, 'v' => $v]);
        }
    }

    public static function get($k, $default = '')
    {
        $set = Set::getByK($k);
        if ($set) return $set->v;
        else return $default;
    }


}