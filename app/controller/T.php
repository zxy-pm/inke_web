<?php

namespace app\controller;

use app\BaseController;
use app\util\D;

class T extends BaseController
{
    public function t()
    {
        return D::getDate(-1) < D::getDateMinuteAgo(-1)?"小于":'大于';
    }

    public function t1()
    {
        cache('a', 2);
    }

}
