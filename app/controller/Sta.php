<?php

namespace app\controller;

use app\BaseController;
use app\controller\td\Xigua;
use app\model\Order;
use app\util\D;

class Sta extends BaseController
{
    //查询订单状态,配置再宝塔计划任务中
    public function order_sta()
    {
        //找到一个状态为0
        $order = Order::
        field('id,trade_no,note,sta,aid,cid,uid,money')
            ->whereIn('sta', '0,-1,-2')
            ->whereTime('finish_time', '<', D::getDateSecondAgo(-45))
            ->order('finish_time', 'asc')
            ->find();
        if (!$order) return '没有需要检测的订单';
        if (!$order->cid || !$order->aid) {
            $order->sta = 5;
            $order->save();
            return '外部订单不需要处理,id:' . $order->id;
        }
        if (!$order->trade_no) {
            $order->sta = 3;
            $order->save();
            return '用户取消支付,id:' . $order->id;
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
