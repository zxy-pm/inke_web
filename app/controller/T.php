<?php

namespace app\controller;

use app\BaseController;
use app\util\D;

class T extends BaseController
{
    public function t()
    {
        $encode = Com::encode("10023");
        echo $encode;
        echo '<br>';
        echo  Com::decode($encode,1)[0];
    }

    public function t1()
    {
        cache('a', 2);
    }

}
