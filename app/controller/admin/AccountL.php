<?php


namespace app\controller\admin;


use app\model\Account;
use app\model\Channel;
use app\model\Order;
use app\util\D;
use app\util\Js;
use app\util\Q;

class AccountL extends BaseL
{
    public function accounts($channel_id)
    {
        $collection = Account::
        where('uid', $this->user->id)
            ->order('sta', 'desc')
            ->order('num', 'desc');
        if ($channel_id != -1) {
            $collection = $collection->where('cid', $channel_id);
        }

        $collection = $collection->select();
        return Js::suc($collection);
    }

    public function accounts1()
    {
        $uid = $this->user->id;
        $data = Q::select('channel,account',
            "channel.id=account.cid and account.uid=$uid",
            'channel.name,account.name as aname,account.id,account.note',
            1,
            100,
            'channel.id desc'
        );
        return Js::suc($data);
    }

    public function account_sta($id)
    {
        $day0 = Order::where('uid', $this->user->id)
            ->whereDay('time')
            ->where('aid', $id)
            ->where('sta', 1)
            ->sum('money');
        $day1 = Order::where('uid', $this->user->id)
            ->whereDay('time', 'yesterday')
            ->where('aid', $id)
            ->where('sta', 1)
            ->sum('money');
        $day2 = Order::where('uid', $this->user->id)
            ->whereDay('time', D::getDate(-2))
            ->where('aid', $id)
            ->where('sta', 1)
            ->sum('money');
        return Js::suc(['num_0' => $day0, 'num_1' => $day1, 'num_2' => $day2]);
    }

    public function del_account($id)
    {
        $account = Account::field('id')->find($id);
        if ($account) {
            $account->delete();
            return Js::suc('删除成功');
        } else {
            return Js::err();
        }

    }

    public function fix_account($id, $cid, $name, $note, $money = '', $max = 0, $sta = 0, $ck = '', $e1 = '', $e2 = '', $e3 = '', $e4 = '')
    {
        if ($id) {//修改
            //查看是否存在,
            $account = Account::where('id', $id)->where('cid', $cid)
                ->where('uid', $this->user->id)->find();
            if ($account) {
                $account->name = $name;
                $account->note = $note;
                $account->max = $max;
                $account->sta = $sta;
                $account->ck = $ck;
                $account->e1 = $e1;
                $account->e2 = $e2;
                $account->e3 = $e3;
                $account->e4 = $e4;
                $account->save();
                return Js::suc('修改成功');
            } else {
                return Js::err('数据不存在');
            }
        } else {//创建
            //直接创建新的
            //查找当前用户是否存在该通道的账号,存在的话找到她的金额,新建的条目也要用同样的金额,不存在的话金额默认为空,同时提醒他设置金额
            $account1 = Account::where('uid', $this->user->id)->where('cid', $cid)->order('id', 'desc')->find();
            if ($account1) $money1 = $account1->money;
            else $money1 = 0;
            //对应的channel是否存在
            if (Channel::field('id')->find($cid)) {
                //当前备注是否存在,同一个通道下,name必须唯一
                $account = Account::field('id')->where('name', $name)->where('cid', $cid)->where('uid', $this->user->id)->find();
                if ($account) {
                    return Js::err('同一通道下,账号id不允许重复');
                } else {
                    $account = Account::create([
                        'cid' => $cid,
                        'name' => $name,
                        'uid' => $this->user->id,
                        'note' => $note,
                        'money' => $money1,
                        'max' => $max,
                        'ck' => $ck,
                        'sta' => $sta,
                        'e1' => $e1,
                        'e2' => $e2,
                        'e3' => $e3,
                        'e4' => $e4,
                    ]);
                    if ($account) return Js::suc('创建成功');
                    else return Js::err('创建失败');
                }
            } else {
                //不存在
                return Js::err('通道不存在', 1);
            }
        }
    }

    public function set_money($cid, $money)
    {
        Account::where('cid', $cid)->where('uid', $this->user->id)->save(['money' => $money]);
        return Js::suc([], '设置成功');
    }

}