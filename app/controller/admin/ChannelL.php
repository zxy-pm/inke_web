<?php


namespace app\controller\admin;


use app\model\Account;
use app\model\Channel;
use app\util\Js;

class ChannelL extends BaseL
{
    public function channels()
    {
        return Js::suc(Channel::withoutField('js,e1,e2,e3,e4')
            ->select());
    }


}