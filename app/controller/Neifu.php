<?php

namespace app\controller;

use app\BaseController;
use app\controller\index\OrderL1;
use app\model\Device;
use app\model\Order;
use app\model\User;
use app\util\C;
use app\util\Js;

class Neifu extends BaseController
{
    private static $key = 'd98Zt352TFu6AzHUCY6F955t3kUF9cUt';
    private static $pid = 1000;
    private static $host = 'http://120.27.22.209:5465/submit.php';
    private static $moneys = [
        '9.00',
        '8.00',
        '7.00',
        '6.00',
    ];

    public function index1($mount = 0, $sta = '', $qkey = '', $note = '')
    {
        //通过qkey找到对应的用户
        $user = User::getByQkey($qkey);
        if (!$user) return '用户不存在';
        self::$moneys = explode('-', $user->moneys);
        self::$host = $user->host;
        self::$key = $user->channel_key;
        self::$pid = $user->channel_id;
        if (count(self::$moneys) != 4) return "金额设置错误";
        if (!self::$host || !self::$key || !self::$pid) return '参数配置错误';
        $lastIndex = 0;
        if ($mount) {
            for ($i = 0; $i < sizeof(self::$moneys); $i++) {
                $money = self::$moneys[$i];
                if (abs($mount - $money) < 50) {
                    $lastIndex = $i;
                }
            }
        }
        $index = 0;
        if ('yebz' == $sta) {
            //不足,如果不是最后一个,下一个,是最后一个就不变
            $index = $this->next_money_index($lastIndex);
        } elseif ('fk' == $sta) {
            //分控,直接最后一个
            $index = sizeof(self::$moneys) - 1;
        } elseif ('cg' == $sta) {
            //成功到下一个,如果是最后一个就不变
            $index = $this->next_money_index($lastIndex);
        }
        $real_money = self::$moneys[$index];
        if (!str_ends_with($real_money, ".00")) $real_money = $real_money . '.00';
        $order = $this->create_order($user, $real_money, $note);
        $param = $this->getParam($order);
        return view('', ['url' => self::$host, 'param' => $param]);
    }

    public function notify_url()
    {
        $params = $this->request->param();
        $sign = $params['sign'];
        unset($params['sign']);
        unset($params['sign_type']);
        ksort($params);
        reset($params);
        $s = '';
        foreach ($params as $k => $v) {
            if ($s == '') $s .= "$k=$v";
            else $s .= "&$k=$v";
        }
        $sign1 = md5($s . self::$key);
        if ($sign == $sign1) {
            //签名验证通过
            //获取实际订单号和金额,更新到自己的数据库中
            $id = $params['out_trade_no'];
            if (!$id) return 'order id err 2';
            $id = explode('-', $id);
            if (count($id) != 2) return 'order id err 3';
            $order = Order::find($id[0]);
            if (!$order) return 'order err 4';
            $order->finish_time = date(C::$date_fomat);
            $order->sta = 1;
            $order->trade_no = $params['trade_no'];
            $order->save();
            $user = User::find($order->uid);
            $user->money -= $user->fee * $order->money;
            $user->save();
            return 'success';
        } else {
            return 'sign err 1';
        }
    }

    public function return_url()
    {
        echo $this->request->root(true) . '/neifu/notify_url';
        return '支付异常,请重新操作';
    }

    private function getParam($order)
    {
        //插入订单数据
        $param = [
            'pid' => self::$pid,
            'type' => 'alipay',
            'out_trade_no' => $order->id . time(),
            'notify_url' => $this->request->root(true) . '/neifu/notify_url',
            'return_url' => $this->request->root(true) . '/neifu/return_url',
            'name' => '套餐',
            'money' => $order->money,
        ];
        ksort($param);
        reset($param);
        $s = '';
        foreach ($param as $k => $v) {
            if ($s == '') $s .= "$k=$v";
            else $s .= "&$k=$v";
        }
        $sign = md5($s . self::$key);
        $param['sign'] = $sign;
        $param['sign_type'] = 'MD5';
        return $param;
    }

    private function next_money_index($index)
    {
        $index = $index + 1;
        $size = sizeof(self::$moneys);
        if ($index > $size) return $size - 1;
        else return $index;
    }

    private function create_order($user, $real_money, $note)
    {
        return Order::create([
            'uid' => $user->id,
            'note' => $note,
            'time' => date(C::$date_fomat),
            'money' => $real_money,
            'sta' => 0,
        ]);
    }
}
