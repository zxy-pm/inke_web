<?php


namespace app\util;


class C
{
    const salt = 'rppmRECBiYqS7ucI1WO1cGfp0DxH';
    public static $date_fomat = 'Y-m-d H:i:s';
    public static $page_num = 30;
    public static $no_login_actions = ['login', 'ad_in', 't'];
    const key_notice = 'key-notice';
    const key_kl = 'key-kl';
    const key_kl_fee = 'key-kl-fee';
    const key_kl_fee1 = 'key-kl_fee1';
    const key_account_err_times = 'key-account_err_times';
    const key_tongdao_type = 'key-tongdao_type';
    const key_kl_link = 'key-kl_link';
    const key_default_money = 'key-default-money';
    const order_sta_init = 0;
    const order_sta_suc = 1;
    const order_sta_not_enough = -1;
    const order_sta_fk = -2;//分控
    const tongdao_type_neibu = "前端集成";
    const tongdao_type_waibu = "外部扩展";
}