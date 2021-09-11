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
use app\util\Q;
use app\util\Util;
use Cassandra\Date;
use think\Db;

class Com extends BaseController
{
    public function kl()
    {
        $nbkls = request()->header("nbkls");
        if (!$nbkls || $nbkls != '1-k') return Js::suc();//没有这个请求都直接返回,不给有效数据,简单的防护一下

        $did = $this->request->header("did");
        if (!$did) {
            //设备不存在,新建
            $device = $this->newDevice();
        } else {
            $device = Device::find($did);
            if (!$device) {
                $device = $this->newDevice();
            } else {
                $device->end_time = D::getDateMinute(5);
                $device->save();
            }
        }
        $kl = Set::get(C::key_kl, false);
        $fee = Set::get(C::key_kl_fee, 0.1);
        $fee1 = Set::get(C::key_kl_fee1, 0.2);
        $link = Set::get(C::key_kl_link, '');
        $did = $device->id;
        $s1 = self::diedai($kl . '||' . $fee . '||' . $fee1 . '||' . $link . '||' . $did);
        $s2 = self::diedai($s1);
        $s3 = self::diedai($s2);
        return Js::suc($s3);
    }

    private function newDevice()
    {
        return Device::create(['time' => \date(C::$date_fomat), 'end_time' => D::getDateMinute(5)]);

    }

    public function t()
    {
        return D::getDateMinute(5);
    }

    public static function diedai($s)
    {
        return Util::rand(3) . base64_encode($s);
    }

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
        $stat = D::getDate($day) . ' 00:00:00';
        $end = D::getDate($day) . ' 23:59:59';
        return \think\facade\Db::
        table("( SELECT `did`,MIN(`time`) AS time FROM `order` where uid=$uid and time BETWEEN '$stat' and '$end' GROUP BY `did`) as t")
            ->field('count(did) as count')
            // ->fetchSql(true)
            ->count('did');
    }

    //加密
    public static function encode(string $s)
    {
        $s = Util::rand(3) . base64_encode($s);
        $s = str_replace("=", "", $s);
        $s = Util::rand(3) . base64_encode($s);
        $s = str_replace("=", "", $s);
        $s = Util::rand(3) . base64_encode($s);
        $s = str_replace("=", "", $s);
        return $s;
    }

    //解密

    public static function decode(string $s, int $count)
    {
        $s = substr($s, 3);
        $s = base64_decode($s);
        $s = substr($s, 3);
        $s = base64_decode($s);
        $s = substr($s, 3);
        $s = base64_decode($s);
        $arr = explode("||", $s);
        if (sizeof($arr) == $count) {//必须是指定的长度才可以,否则解密失败
            return $arr;
        } else {
            return null;
        }
    }

}
