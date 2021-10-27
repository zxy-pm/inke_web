<?php

namespace app\controller;

use app\BaseController;
use app\controller\admin\UserL;
use app\controller\index\OrderL1;
use app\controller\td\Xigua;
use app\model\Account;
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

class Sta extends BaseController
{
    //查询订单状态,配置再宝塔计划任务中
    public function order_sta()
    {
        //找到一个状态为0
        $order = Order::
        field('id,trade_no,note,sta,aid,cid,uid,money')
            ->where('sta', 0)
            ->whereTime('finish_time', '<', D::getDateSecondAgo(-45))
            ->order('finish_time','asc')
            ->find();
        if (!$order) return '没有需要检测的订单';
        if(!$order->trade_no) {
            $order->sta = 3;
            $order->save();
            return '用户取消支付,id:'.$order->id;
        }
        switch ($order->cid) {
            case 8:
                return Xigua::sta($order);
                break;
            default:
                return '无对应的通道';
                break;
        }
    }

}
