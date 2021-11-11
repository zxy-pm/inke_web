<?php

namespace app\controller;

use app\BaseController;
use app\util\D;

class Info extends BaseController
{
    public function ip()
    {
        return 'var my_real_ip="' . $this->request->ip().'"';
    }

}
