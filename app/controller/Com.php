<?php

namespace app\controller;

use app\BaseController;
use app\controller\admin\UserL;
use app\controller\index\OrderL1;
use app\model\Device;
use app\model\Order;
use app\model\User;
use app\util\D;
use app\util\Js;
use app\util\Q;
use think\Db;

class Com extends BaseController
{
    public function reg()
    {
        return view();
    }

    public function reg_data($uid, $uname, $page)
    {
        if ($uid > 2000 || strlen($uname) > 12 || strlen($uname) < 6 || !is_numeric($page) || !is_numeric($uid)) {
            return Js::err();
        }
        $user = User::where('id', $uid)->where('name', $uname)->find();
        if (!$user) return Js::err('参数错误');
        $data = Order::field('did,min(time) as time')
            ->where('uid', $uid)
            ->order('time', 'desc')
            ->group('did')
            ->page($page, 40)
            ->select();
        return Js::suc($data, '', 0, Order::field('id')
            ->where('uid', $uid)
            ->count('id'));
    }

    public function reg_tj($uid, $uname)
    {
        if ($uid > 2000 || strlen($uname) > 12 || strlen($uname) < 6 || !is_numeric($uid)) {
            return Js::err();
        }
        $user = User::where('id', $uid)->where('name', $uname)->find();
        if (!$user) return Js::err('参数错误');
        $day0 = $this->getCount($uid, 0);
        $day1 = $this->getCount($uid, -1);
        $day2 = $this->getCount($uid, -2);
        return Js::suc(['num_0' => $day0, 'num_1' => $day1, 'num_2' => $day2], "今天注册:$day0,昨天注册:$day1,前天注册:$day2");
    }

    /**
     * @param $uid
     * @return int
     */
    private function getCount($uid, $day = 0): int
    {
        $stat = D::getDate($day).' 00:00:00';
        $end = D::getDate($day).' 23:59:59';
        return \think\facade\Db::
        table("( SELECT `did`,MIN(`time`) AS time FROM `order` where uid=$uid and time BETWEEN '$stat' and '$end' GROUP BY `did`) as t")
            ->field('count(did) as count')
            // ->fetchSql(true)
            ->count('did');
    }
}
