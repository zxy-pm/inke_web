<?php


namespace app\controller\admin;


class BaseL
{
    protected $user;

    public static function create($u)
    {
        return new static($u);
    }

    public function __construct($u)
    {
        $this->user = $u;
    }

}