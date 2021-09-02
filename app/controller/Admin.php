<?php


namespace app\controller;


use app\BaseController;
use app\controller\admin\AccountL;
use app\controller\admin\ChangeL;
use app\controller\admin\ChannelL;
use app\controller\admin\OrderL;
use app\controller\admin\SetL;
use app\controller\admin\TL;
use app\controller\admin\UserL;
use app\model\Set;
use app\model\User;
use app\util\C;
use app\util\Js;
use think\facade\View;

class Admin extends BaseController
{
    protected $user;

    protected function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        if (!in_array($this->request->action(true), C::$no_login_actions)) {
            $token = cookie('token');
            if (!$token) {
                Js::logout()->send();
                exit(0);
            }
            $this->user = User::field('id,name,money,fee,type,kl,kl_fee,klsd,channel_id,channel_key,host,moneys')->getByToken($token);
            if (!$this->user) {
                Js::logout()->send();
                exit(0);
            }
        }
    }

    public function t()
    {
        dump($this->request->header());
        return 'aaa';
    }

    public function ad_in()
    {
        return View::fetch('./admin_view/index.html');
    }

    public function orders($page, $channel_id = 0)
    {
        return OrderL::create($this->user)->orders($page, $channel_id);
    }

    public function login($name, $pwd)
    {
        return UserL::create($this->user)->login($name, $pwd);
    }

    public function channels()
    {
        return ChannelL::create($this->user)->channels();
    }

    public function accounts($channel_id)
    {
        return AccountL::create($this->user)->accounts($channel_id);
    }

    public function fix_account($id, $cid, $name, $note, $money, $max, $sta, $ck, $e1, $e2, $e3, $e4)
    {
        return AccountL::create($this->user)->fix_account($id, $cid, $name, $note, $money, $max, $sta, $ck, $e1, $e2, $e3, $e4);
    }

    public
    function del_account($id)
    {
        return AccountL::create($this->user)->del_account($id);
    }

    public
    function set_money($cid, $money)
    {
        return AccountL::create($this->user)->set_money($cid, $money);
    }

    public
    function del($day)
    {
        return OrderL::create($this->user)->del($day);
    }

    public
    function sta()
    {
        return OrderL::create($this->user)->sta();
    }

    public
    function all_orders($page)
    {
        return OrderL::create($this->user)->all_orders($page);
    }

    public
    function set_get()
    {
        return SetL::create($this->user)->set_get();

    }

    public
    function set_set($k, $v)
    {
        return SetL::create($this->user)->set_set($k, $v);
    }

    public
    function user()
    {
        return UserL::create($this->user)->user();
    }

    public
    function users()
    {
        return UserL::create($this->user)->users();
    }

    public
    function add_user($name)
    {
        return UserL::create($this->user)->add_user($name);
    }

    public
    function fix_user($id, $k, $v)
    {
        return UserL::create($this->user)->fix_user($id, $k, $v);
    }

    public
    function del_user($id)
    {
        return UserL::create($this->user)->del_user($id);
    }

    public
    function logout()
    {
        return UserL::create($this->user)->logout();

    }

    public
    function changes($page)
    {
        return ChangeL::create($this->user)->changes($page);
    }

    public
    function all_changes($page)
    {
        return ChangeL::create($this->user)->all_changes($page);
    }

    public
    function all_sta()
    {
        return OrderL::create($this->user)->all_sta();
    }

    public function account_sta($id)
    {
        return AccountL::create($this->user)->account_sta($id);
    }

    public function accounts1()
    {
        return AccountL::create($this->user)->accounts1();
    }

    public function user_sta($id)
    {
        return UserL::create($this->user)->user_sta($id);
    }

    public function users1()
    {
        return UserL::create($this->user)->users1();
    }

    public function user_ch($id, $key, $moneys, $host)
    {
        return UserL::create($this->user)->user_ch($id, $key, $moneys, $host);
    }

    public function save_kl($kl, $kl_fee, $kl_fee1, $kl_link)
    {
        return UserL::create($this->user)->save_kl($kl, $kl_fee, $kl_fee1, $kl_link);
    }

}