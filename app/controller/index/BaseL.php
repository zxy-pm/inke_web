<?php


namespace app\controller\index;


class BaseL
{
    protected $user;
    protected $device;

    public static function create($u, $d)
    {
        return new static($u, $d);
    }

    public function __construct($u, $d)
    {
        $this->user = $u;
        $this->device = $d;
    }


}