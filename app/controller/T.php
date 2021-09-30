<?php

namespace app\controller;

use app\BaseController;
use app\controller\admin\UserL;
use app\controller\index\OrderL1;
use app\model\Device;
use app\model\Order;
use app\model\Set;
use app\model\User;
use app\util\C;
use app\util\D;
use app\util\Js;
use app\util\Util;
use think\facade\Db;
use think\response\Json;

class T extends BaseController
{
    public function t()
    {
        set_time_limit(3);
        $max = 100;
        while ($max) {
            $max--;
            usleep(500000);
            print "定时$max";
        }
        exit(0);
    }

}
