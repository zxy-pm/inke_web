<?php


namespace app\controller\admin;


use app\model\Change;
use app\model\Order;
use app\model\Set;
use app\model\User;
use app\util\C;
use app\util\D;
use app\util\Js;

class UserL extends BaseL
{
    public function login($name, $pwd)
    {
        if (!$name || !$pwd || strlen($name) < 6 || strlen($pwd) < 6) {
            return Js::err('账号和密码长度至少6位');
        }
        $time = cookie('last_login');
        $now = \time();
        cookie('last_login', $now . '');
        if ($time > $now - 5) {
            return Js::err('操作过于频繁,请5秒钟后再次操作');
        }
        $user = User::field('name,id,token')->where('name', $name)->where('pwd', md5($name . $pwd . C::salt))->find();
        if ($user) {
            $token = md5($user->name . C::salt . \time());
            $user->token = $token;
            $user->last_login = date(C::$date_fomat);
            $user->save();
            D::clearOrderChange();
            cookie('token', $token);
            return Js::suc('登录成功');
        } else {
            return Js::err('账号或密码错误');
        }
    }

    public function logout()
    {
        cookie('token', '0');
        return Js::suc();
    }

    public function user()
    {
        $this->user->last_login = \date(C::$date_fomat);
        $this->user->save();
        return Js::suc(['type' => $this->user->type]);
    }

    public function users()
    {
        if ($this->user->type != 1) return Js::err('没有权限');
        return Js::suc(
            [
                'users' => User::order('last_login', 'desc')->select(),
                'ye' => round(User::sum('money'), 2)
            ],
            'ok',
            0,
            User::count('id')
        );
    }

    public function users1()
    {
        if ($this->user->type == 0) return Js::err('没有权限');
        return Js::suc(User::field('id,name')->order('last_login', 'desc')->select());
    }

    public function user_sta($id)
    {
        if ($this->user->type == 0) return Js::err('没有权限');
        $day0 = Order::whereDay('time')
            ->where('uid', $id)
            ->where('sta', 1)
            ->sum('money');
        $day1 = Order::whereDay('time', 'yesterday')
            ->where('uid', $id)
            ->where('sta', 1)
            ->sum('money');
        $day2 = Order::whereDay('time', D::getDate(-2))
            ->where('uid', $id)
            ->where('sta', 1)
            ->sum('money');
        return Js::suc(['num_0' => $day0, 'num_1' => $day1, 'num_2' => $day2]);
    }

    public function add_user($name)
    {
        if ($this->user->type != 1) return Js::err('没有权限');

        $user = User::getByName($name);
        if ($user) {
            return Js::err('用户名已经存在');
        }
        $user = User::create([
            'name' => $name,
            'last_login' => \date(C::$date_fomat),
            'type' => 0,
            'money' => 0
        ]);
        return Js::suc([], '新增成功: ' . $user->name);
    }

    public function del_user($id)
    {
        if ($id == 1) return Js::err('没有权限');
        if ($this->user->type != 1) return Js::err('没有权限');
        $user = User::find($id);
        if ($user) $user->where('id', $user->id)->delete();
        else return Js::err(null, '删除失败,账号不存在');
        $user->save();
        return Js::suc(null, '删除成功');
    }

    public function fix_user($id, $k, $v)
    {
        if ($this->user->type != 1) return Js::err('没有权限');
        $user = User::find($id);
        if (!$user) return Js::err('修改失败,账号不存在');
        if ($k == 'money') {
            //充值,生成充值记录,同时给用户充值
            $change = Change::create(['uid' => $user->id, 'money' => $v, 'time' => \date(C::$date_fomat)]);
            if (!$change) return Js::err('生成充值记录失败,请重试');
            $user->money += $v;
        } else if ($k == 'pwd') {
            //修改密码,要加盐再保存
            $user->pwd = md5($user->name . $v . C::salt);
        } else if ($k == 'qkey') {
            //修改密码,要加盐再保存
            $user->qkey = md5($user->name . $user->id . C::salt . time());
        } else {
            $user[$k] = $v;
        }
        $user->save();
        return Js::suc(null, '修改成功');
    }

    //用户自己的信息(通道id,通道key)
    public function user_ch($id, $key, $moneys, $host, $tongdao_type)
    {
        //不是指定的参数直接返回错误
        $this->user->channel_id = $id;
        $this->user->channel_key = $key;
        $this->user->moneys = $moneys;
        $this->user->host = $host;
        $this->user->tongdao_type = $tongdao_type;
        $this->user->save();
        //正常修改完成,返回成功
        return Js::suc();
    }

    public function save_kl($kl, $kl_fee, $kl_fee1, $kl_link, $account_err_times)
    {
        if ($this->user->type != 1) return Js::err('失败');
        Set::put(C::key_kl, $kl);
        Set::put(C::key_kl_fee, $kl_fee);
        Set::put(C::key_kl_fee1, $kl_fee1);
        Set::put(C::key_account_err_times, $account_err_times);
        Set::put(C::key_kl_link, $kl_link);
        return Js::suc();
    }
}