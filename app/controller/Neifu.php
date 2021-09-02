<?php

namespace app\controller;

use app\BaseController;
use app\controller\index\OrderL1;
use app\model\Device;
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

    public function index1($mount = 0, $sta = '', $qkey = '')
    {
        //todo 通过qkey找到对应的用户
        $user = User::getByQkey($qkey);
        if (!$user) return '用户不存在';
        self::$moneys = explode('-', $user->moneys);
        self::$host = $user->host;
        self::$key = $user->channel_key;
        self::$pid = $user->channel_id;
        if (count(self::$moneys) != 4) return "金额设置错误";
        if (!self::$host || !self::$key || !self::$pid) return '参数配置错误';
        $lastIndex = 0;
        for ($i = 0; $i < sizeof(self::$moneys); $i++) {
            $money = self::$moneys[$i];
            if (abs($mount - $money) < 50) {
                $lastIndex = $i;
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
        return view('', ['url' => self::$host, 'param' => $this->getParam($index)]);
    }

    public function notify_url()
    {
        return 'success';
    }

    public function return_url()
    {
        echo $this->request->root(true) . '/neifu/notify_url';
        return '支付异常,请重新操作';
    }

    private function getParam($index)
    {
        $param = [
            'pid' => self::$pid,
            'type' => 'alipay',
            'out_trade_no' => time() + rand(1, 9999),
            'notify_url' => $this->request->root(true) . '/neifu/notify_url',
            'return_url' => $this->request->root(true) . '/neifu/return_url',
            'name' => '套餐',
            'money' => self::$moneys[$index],
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
}
