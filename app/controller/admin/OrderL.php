<?php


namespace app\controller\admin;

//管理订单相关的问题
use app\model\Change;
use app\model\Order;
use app\model\Set;
use app\model\User;
use app\util\C;
use app\util\D;
use app\util\Js;
use app\util\Q;

class OrderL extends BaseL
{


    public function orders_1($page, $channel_id)
    {
        $data = Q::select('order,channel', 'order.cid=channel.id and order.uid=' . $this->user->id,
            'order.*,channel.name,channel.id as ccid', $page, C::$page_num, 'id desc')->toArray();
        $count = Q::count('order,channel', 'order.cid=channel.id and order.uid=' . $this->user->id);
        return Js::suc($data, 'ok', 0, $count);

    }

    public function orders($page)
    {
        $data = Order::where('uid', $this->user->id)->order('time', 'desc')->page($page, C::$page_num)->select();
        $count = Order::where('uid', $this->user->id)->count();
        return Js::suc($data, 'ok', 0, $count);

    }

    public function all_orders($page)
    {
        if ($this->user->type == 0) return Js::err('没有权限访问');
        $data = Order::order('time', 'desc')->page($page, C::$page_num)->select();
        $count = Order::count();
        return Js::suc($data, 'ok', 0, $count);

    }

    public function del($day)
    {
        if ($day < 5) return Js::err('参数错误');
        Order::where('uid', $this->user->id)
            ->whereTime('time', '<', date(C::$date_fomat, strtotime('-' . $day . ' day')))
            ->delete();
        return Js::suc();
    }

    public function sta()
    {
        //统计今天成功总额,昨天总成功额,所有总成功额,
        $day0 = Order::where('uid', $this->user->id)
            ->whereDay('time')
            ->where('sta', \app\controller\index\OrderL::$sta_zfcg)
            ->sum('money');
        $day1 = Order::where('uid', $this->user->id)
            ->whereDay('time', 'yesterday')
            ->where('sta', \app\controller\index\OrderL::$sta_zfcg)
            ->sum('money');
        $day2 = Order::where('uid', $this->user->id)
            ->whereDay('time', D::getDate(-2))
            ->where('sta', \app\controller\index\OrderL::$sta_zfcg)
            ->sum('money');
        $day3 = Order::where('uid', $this->user->id)
            ->whereDay('time', D::getDate(-3))
            ->where('sta', \app\controller\index\OrderL::$sta_zfcg)
            ->sum('money');
        $all = Order::where('uid', $this->user->id)
            ->where('sta', \app\controller\index\OrderL::$sta_zfcg)
            ->sum('money');
        return Js::suc([
            'day0' => $day0,
            'day1' => $day1,
            'day2' => $day2,
            'day3' => $day3,
            'all' => $all,
            'name' => $this->user->name,
            'type' => $this->user->type,
            'money' => $this->user->money,
            'fee' => $this->user->fee,
            'notice' => Set::get(C::key_notice),
            'channel_id' => $this->user->channel_id,
            'channel_key' => $this->user->channel_key,
            'moneys' => $this->user->moneys,
            'host' => $this->user->host,
            'tongdao_type' => $this->user->tongdao_type,
        ]);
    }

    public function all_sta()
    {
        //统计今天成功总额,昨天总成功额,所有总成功额,
        $day0 = Order::whereDay('time')
            ->where('sta', \app\controller\index\OrderL::$sta_zfcg)
            ->sum('money');
        $day1 = Order::whereDay('time', 'yesterday')
            ->where('sta', \app\controller\index\OrderL::$sta_zfcg)
            ->sum('money');
        $day2 = Order::whereDay('time', D::getDate(-2))
            ->where('sta', \app\controller\index\OrderL::$sta_zfcg)
            ->sum('money');
        $day3 = Order::whereDay('time', D::getDate(-3))
            ->where('sta', \app\controller\index\OrderL::$sta_zfcg)
            ->sum('money');
        $kl0 = Order::whereDay('time')
            ->where('sta', \app\controller\index\OrderL::$sta_zfcg)
            ->whereLike('type', '扣量%')
            ->sum('money');
        $kl1 = Order::whereDay('time', 'yesterday')
            ->where('sta', \app\controller\index\OrderL::$sta_zfcg)
            ->whereLike('type', '扣量%')
            ->sum('money');
        $kl2 = Order::whereDay('time', D::getDate(-2))
            ->where('sta', \app\controller\index\OrderL::$sta_zfcg)
            ->whereLike('type', '扣量%')
            ->sum('money');
        $kl3 = Order::whereDay('time', D::getDate(-3))
            ->where('sta', \app\controller\index\OrderL::$sta_zfcg)
            ->whereLike('type', '扣量%')
            ->sum('money');
        $all = Order::where('sta', \app\controller\index\OrderL::$sta_zfcg)
            ->sum('money');
        $kl_all = Order::where('sta', \app\controller\index\OrderL::$sta_zfcg)
            ->whereLike('type', '扣量%')
            ->sum('money');
        $change0 = Change::whereDay('time')
            ->sum('money');
        $change1 = Change::whereDay('time', 'yesterday')
            ->sum('money');
        $change2 = Change::whereDay('time', D::getDate(-2))
            ->sum('money');
        $change3 = Change::whereDay('time', D::getDate(-3))
            ->sum('money');
        $change = Change::sum('money');
        return Js::suc([
            'day0' => $day0,
            'day1' => $day1,
            'day2' => $day2,
            'day3' => $day3,
            'kl0' => $kl0,
            'kl1' => $kl1,
            'kl2' => $kl2,
            'kl3' => $kl3,
            'kl_all' => $kl_all,
            'all' => $all,
            'change0' => $change0,
            'change1' => $change1,
            'change2' => $change2,
            'change3' => $change3,
            'change' => $change,
        ]);
    }
}