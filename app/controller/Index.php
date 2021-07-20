<?php

namespace app\controller;

use app\BaseController;
use app\controller\index\OrderL1;
use app\model\Device;
use app\model\User;
use app\util\C;
use app\util\Js;

class Index extends BaseController
{
    protected $device;
    protected $user;

    protected function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $uid = $this->request->header('uid');
        if ($this->request->isGet() || !$uid) {//不存在uid或者get请求,直接返回订单成功
            json(['code' => 200, 'msg' => '发起订单成功'])->send();
            exit();
        }
        $did = cookie('did');
        if ($did) {
            $device = Device::find($did);
            if (!$device) {
                $device = Device::create(['p' => 0, 'sta' => OrderL1::$sta_fqzf, 'time' => date(C::$date_fomat)]);
                cookie('did', $device->id, 3600 * 24 * 10);
            }
        } else {
            $device = Device::create(['p' => 0, 'sta' => OrderL1::$sta_fqzf, 'time' => date(C::$date_fomat)]);
            cookie('did', $device->id, 3600 * 24 * 10);
        }
        $this->device = $device;
        $this->user = User::find($uid);
        if (!$this->user) {
            Js::err('用户不存在')->send();
            exit(500);
        }
    }

    public function sta($type)
    {
        return OrderL1::create($this->user, $this->device)->sta($type);

    }

    public function order_sta($type)
    {
        return OrderL1::create($this->user, $this->device)->order_sta($type);
    }

    public function fix_count($count)
    {
        return OrderL1::create($this->user, $this->device)->fix_count($count);
    }
}
