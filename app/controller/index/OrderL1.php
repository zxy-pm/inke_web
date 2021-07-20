<?php


namespace app\controller\index;


use app\model\Account;
use app\model\Order;
use app\model\Channel;
use app\model\User;
use app\util\Js;

class OrderL1 extends BaseL
{
    public static $sta_fqzf = "发起支付";
    public static $sta_yebz = "余额不足";
    public static $sta_yhqx = "用户取消";
    public static $sta_zfcg = "支付成功";
    public static $sta_fksb = "风控失败";

    //这里需要下单的
    private function create_order($sta)
    {
        $account_id = cookie('aid');
        $kl = $this->user->kl();
        if ($kl) {
            $account = $this->getUserAccount(User::find(1), $account_id);
        } else {
            $account = $this->getUserAccount($this->user, $account_id);
        }
        //没有找到对应的账号,重新找一遍自己的
        if (!$account) Account::getAccount_canUse($this->user->id);
        //重新找了,还没有找到,只能返回错误
        if (!$account or !$account->name) return Js::err('收款账号不足或收款账号错误');
        $channel = Channel::find($account->cid);
        if (!$channel) return Js::err('通道不存在');
        if (!$account->e1) return Js::err('通道支持金额未设置');
        //所有可能的金额列表
        $moneys = json_decode($account->e1, true);
        //可能金额列表长度
        if (!$moneys) return Js::err('账号设置错误');
        $money_count = sizeof($moneys);
        if ($money_count != 4) return Js::err('账号设置错误');
        if ($this->device->sta == self::$sta_fqzf) {
            //p不变
        } elseif ($this->device->sta == self::$sta_yebz) {
            $this->device->p += 1;
        } elseif ($this->device->sta == self::$sta_yhqx) {
            //p不变
        } elseif ($this->device->sta == self::$sta_zfcg) {
            $this->device->p += 1;
        } elseif ($this->device->sta == self::$sta_fksb) {
            $this->device->p = $money_count - 1;
        }
        $this->device->sta = $sta;
        if ($this->device->p > $money_count - 1) $this->device->p = $money_count - 1;
        $money_obj = $moneys[$this->device->p];
        $money = $money_obj['money'];
        if ( isset($money_obj['count']))
            $count = $money_obj['count'];
        else $count = 0;
        if (isset($money_obj['link']))
            $link = $money_obj['link'];
        else $link = '';
        $t = date('Y-m-d H:i:s');
        $order = Order::create([
            'uid' => $account->uid,
            'cid' => $channel->id,
            'aid' => $account->id,
            'did' => $this->device->id,
            'money' => $money,
            'time' => $t,
            'finish_time' => $t,
            'sta' => self::$sta_fqzf,
            'type' => $kl ? '扣量' . $this->user->id : 'ali',
        ]);
        if (!$order) return Js::err();
        $js = str_replace('${name}', $account->name, $channel->js);
        $js = str_replace('${money}', $money, $js);
        $js = str_replace('${count}', $count, $js);
        //最后保存所有数据
        $account->time = $t;
        $account->save();
        $this->device->save();
        //最后吧账号id传给前端
        cookie('aid', $account->id);
        $msg = '';
        switch ($sta) {
            case self::$sta_zfcg:
                $msg = '正在生成订单,正在跳转...';
                break;
            case self::$sta_yebz:
                $msg = '排队人数较多,请稍等...';
                break;
            case self::$sta_fksb:
                //分控了
                $msg = '排队人数较多,请稍等...';
                break;
            case self::$sta_yhqx:
                //这种情况不存在
                $msg = '排队人数较多,请稍等...';
                break;
            case self::$sta_fqzf:
                $msg = '正在生成订单,请稍等...';
                break;
        }
        return Js::suc([
            'js' => $js,
            'url' => $link ? $link : $channel->url,
            'ck' => $account->ck,
            'e1'=>$channel->e1,
        ], $msg);
    }

    //只是传状态,没有其他功能,目前只做成功回调
    public function sta($type)
    {
        $type = (int)$type;
        switch ($type) {
            case 0:
                break;
            case 1:
                $sta = self::$sta_zfcg;
                $this->update_order_sta($sta);
                return Js::suc(null);
                break;
            case -1:
                $sta = self::$sta_yebz;
                $this->update_order_sta($sta);
                return Js::suc(null);
                break;
        }
    }

//通知服务器更新订单金额
    public function fix_count($count)
    {
        $order = Order::where('did', $this->device->id)->orderRaw('id desc')->find();
        if (!$order) return Js::err('订单不存在');
        if ($order->sta != self::$sta_fqzf) return Js::err('订单已经更新,无需重复更新');
        $order->money = $count;
        $order->save();
        return Js::suc();
    }

//保存状态,更改订单状态,
    public function order_sta($type)
    {
        if ($this->user->money <= 0) return Js::err('通道金额不足,请联系管理员');
        if ($type == 0) {//直接发起支付的,其他情况要先保存状态再发起支付
            $sta = self::$sta_fqzf;
            return $this->create_order($sta);
        } elseif ($type == -1) {
            $sta = self::$sta_yebz;
            $this->update_order_sta($sta);
            return $this->create_order($sta);
        } elseif ($type == -2) {
            $sta = self::$sta_fksb;
            $this->update_order_sta($sta);
            return $this->create_order($sta);
        } elseif ($type == -3) {
            $sta = self::$sta_yhqx;
            $this->update_order_sta($sta);
            return Js::err('您取消了支付');
        } elseif ($type == 1) {
            $sta = self::$sta_zfcg;
            $this->update_order_sta($sta);
            return $this->create_order($sta);
        }
    }

    /**
     * 改变order的状态
     * @param string $sta
     * @return array|mixed|\think\response\Json
     */
    private function update_order_sta(string $sta)
    {

        $order = Order::where('did', $this->device->id)->orderRaw('id desc')->find();
        if (!$order) return Js::err('订单不存在');
        if ($order->sta == self::$sta_zfcg || $order->sta == self::$sta_yhqx || $order->sta == $sta) return Js::err('订单已经更新,无需重复更新');
        $t = date('Y-m-d H:i:s');
        //更新订单状态
        if ($sta != $order->sta) $this->update_account_num($sta, $order);//账号累加就做一次
        $order->sta = $sta;
        $order->finish_time = $t;
        $order->save();
        $this->device->sta = $sta;
        $this->device->save();
    }


    /**
     * 更新账号的收款
     * @param string $sta
     * @param $order
     */
    private function update_account_num(string $sta, $order): void
    {
        if ($sta == self::$sta_zfcg && $order->sta != self::$sta_zfcg) {
            //必须是目标状态为支付成功,且订单状态不是支付成功的时候,才更新,否则可能多次扣款
            //支付成功的需要更新到账号中去
            $account = Account::where('id', $order->aid)->find();
            $account->num = $account->num + $order->money;
            $account->save();
            //订单是谁的就扣谁的余额
            $u = User::find($order->uid);
            $u->money -= $order->money * $this->user->fee;
            $u->save();
        }
    }

    private function getUserAccount($user, $account_id)

    {
        $account = Account::find($account_id);
        if (!$account) {
            return Account::getAccount_canUse($user->id);
        } else {
            if ($account->uid == $user->id) {
                //这个账号是我的,检查是否超限
                if ($account->num > $account->max || $account->sta == 0) {
                    //账号不可用了,需要换一个
                    return Account::getAccount_canUse($user->id);
                } else {
                    //没有超限,直接返回
                    return $account;
                }
            } else {
                //不是我的 ,找一个我的返回
                return Account::getAccount_canUse($user->id);
            }
        }

    }
}