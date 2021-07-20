# Host: localhost  (Version: 5.7.26)
# Date: 2021-07-11 18:49:30
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "account"
#

DROP TABLE IF EXISTS `account`;
CREATE TABLE `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `num` int(11) DEFAULT '0' COMMENT '当前已经多少了',
  `money` varchar(255) DEFAULT '' COMMENT '支持金额-分割,',
  `max` int(11) DEFAULT '0' COMMENT '限额',
  `ck` text COMMENT 'ck,备用',
  `sta` tinyint(3) DEFAULT NULL COMMENT '是否开启',
  `time` datetime DEFAULT NULL,
  `mode` tinyint(3) DEFAULT NULL COMMENT '模式暂且每次递减0或者1',
  `uid` varchar(255) DEFAULT NULL COMMENT '用户id',
  `cid` varchar(255) DEFAULT NULL COMMENT 'channel id',
  `e1` text COMMENT '充值小号',
  `e2` text,
  `e3` text,
  `e4` text,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `cid` (`cid`),
  KEY `num` (`num`),
  KEY `time` (`time`),
  KEY `sta` (`sta`),
  KEY `name` (`name`),
  KEY `max` (`max`),
  KEY `note` (`note`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

#
# Data for table "account"
#

/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES (5,'101130860','测试的不要用',3079,'998-589-298-98',10000,NULL,0,NULL,NULL,'1','1',NULL,NULL,NULL,NULL),(22,'194050346','测试',0,'988-598-298-98',10000,NULL,1,NULL,NULL,'1','2',NULL,NULL,NULL,NULL),(24,'54681373','1',0,'30-12-6',10000,'momo_session=93aa7d2345d01f776a6a159e29cc3d0f;aliyungf_tc=7ce499d79c37d4bff49232df8fe7df6f6827187239124a44ed1e14391a68f608;MMID=9c721d4fd6b8981f7830c1b3afe81f7e; momo_lang=zh; MMSSID=4f1a4df40635218eb52a8de31e533523; PHPSESSID=ec1fc59f7d0b70963fbd01a8924a112a; momo_csrf_token=336f8615dd9419d3149522f7528f9cba; redirect_url=%2Fpay;',0,'2021-07-04 19:17:03',NULL,'2','3','[{\"money\":\"1000\"},{\"money\":\"512\"},{\"money\":\"108\"},{\"money\":\"108\"}]',NULL,NULL,NULL),(28,'1259017454','测试',2,'',10000,'',0,'2021-07-04 19:07:47',NULL,'2','5','[{\"money\":\"2\",\"link\":\"https://detail.m.tmall.com/item.htm?isNew=false&downgradesource=h5_2&id=536855180817&scm=1007.31166.221054.0&pvid=8b8ed9af-2872-4cbf-8bfa-45788287b39f&utparam={%22itemId%22:536855180817,%22inshopBuckets%22:%22%22,%22x_object_type%22:%22item%22,%22moduleId%22:23320460436,%22materialId%22:98741976,%22x_object_id%22:%22536855180817%22,%22tpp_buckets%22:%2221166#0#221054#13%22}&spm=a2141.7631565.tbshopmod-items_rank.536855180817&bbid=undefined\",\"count\":\"2\"},{\"money\":\"2\",\"count\":\"1\",\"link\":\"https://detail.m.tmall.com/item.htm?isNew=false&downgradesource=h5_2&id=536855180817&scm=1007.31166.221054.0&pvid=8b8ed9af-2872-4cbf-8bfa-45788287b39f&utparam={%22itemId%22:536855180817,%22inshopBuckets%22:%22%22,%22x_object_type%22:%22item%22,%22moduleId%22:23320460436,%22materialId%22:98741976,%22x_object_id%22:%22536855180817%22,%22tpp_buckets%22:%2221166#0#221054#13%22}&spm=a2141.7631565.tbshopmod-items_rank.536855180817&bbid=undefined\"},{\"money\":\"2\",\"count\":\"1\",\"link\":\"https://detail.m.tmall.com/item.htm?isNew=false&downgradesource=h5_2&id=536855180817&scm=1007.31166.221054.0&pvid=8b8ed9af-2872-4cbf-8bfa-45788287b39f&utparam={%22itemId%22:536855180817,%22inshopBuckets%22:%22%22,%22x_object_type%22:%22item%22,%22moduleId%22:23320460436,%22materialId%22:98741976,%22x_object_id%22:%22536855180817%22,%22tpp_buckets%22:%2221166#0#221054#13%22}&spm=a2141.7631565.tbshopmod-items_rank.536855180817&bbid=undefined\"},{\"money\":\"2\",\"count\":\"1\",\"link\":\"https://detail.m.tmall.com/item.htm?isNew=false&downgradesource=h5_2&id=536855180817&scm=1007.31166.221054.0&pvid=8b8ed9af-2872-4cbf-8bfa-45788287b39f&utparam={%22itemId%22:536855180817,%22inshopBuckets%22:%22%22,%22x_object_type%22:%22item%22,%22moduleId%22:23320460436,%22materialId%22:98741976,%22x_object_id%22:%22536855180817%22,%22tpp_buckets%22:%2221166#0#221054#13%22}&spm=a2141.7631565.tbshopmod-items_rank.536855180817&bbid=undefined\"}]','','',''),(29,'238186','1',0,'',10000,'DISTRIBUTED_SESSIONID=bcf3fb58-f11f-4580-ad7c-171b145d6e42; hiido_ui=0.8400768646029719; shareform=300; hd_newui=0.703135902882249; Hm_lvt_c493393610cdccbddc1f124d567e36ab=1625835470; detail_volume=0.50; userLastBank=\\\"alipayDirectPay:alipayDirectPay\\\"; Hm_lpvt_c493393610cdccbddc1f124d567e36ab=1625840184; yyuid=2736409744; username=bdyy_isw0q38ysj; password=BC5189A6891CD7DD0331D1881D9CF175BC533BB3; osinfo=61075D846C0A6154FF11E0269EC984D89AFF0D81; udb_l=DwBiZHl5X2lzdzBxMzh5c2rKWuhgA3cAOhGTJmSHUfMUNArKumqVYGX5y8Eabm_MDRLqjdktde2HGCc-BxMVXJYo0n2eYf3knAEYejt2mpZ-vQ8wgEDoyg-Mi0LVn4efgC5009SaVckgeOkisCXbH2E45_2XR5Ta9yRxH2c8WkR7HOEU9izlQutoUxpfny4AAAAAAwAAAAAAAAAOADExMi4yMjQuMTUwLjk0BAA1NzE5; udb_n=fc6d8b3e4b75d96f4da43b3c67b0fa6789475eca4517da45e858967864d984cc4567a8d413075a948e81bc3b8eebdbdc; udb_oar=37ACDA346506EA4A25157C6E1D100DE8914CC1D6D68C0CFD6EBEE1A856BEC2A9DA78C5C89D830B9106279CF25B40828C71CB92FBC420870474205B1C0C40CB6D549E10AC20B77501B8A77D9670F50AE5B900CDB042A6896926A9BEAA62E222ADB7C9604843E68E67FDA6189188597C54D8F21216FD98C036216866D07079F2035D8F23E047215C69CACFDB9ABC8B2D6DE099419C50DE315303DFF0A09FD1F4E0D85840C484A697431742DFDEAAAC412D33C7B852BAB5BEB8AFC675F27099136D055C13D472FC7E86FE589475293CF6D0063F0595EB8413B8ED7817BFF6F3BBAFAC55CC7C4751530530A15AE1AD36435AC9BC690F7453F699AF0F210FBDB365ED3F3CC7978A9A7D1D4CB89D5EAC2E9667436D9088E70EC0CA836540BA73B703ADA656CFE7D7DB033A957939A4DF6F388F269F019AB6861AA6223599301A340B39; udb_c=AEB3MVBqAAJgAJ5bzYo9tmKBHIKDY7O7gZWi3KU2JsY_Ozqb4WRiQGxZOrpVp1QYVdSkZzMIh4FXifIa7xxdkT0jwd4Xew70-9pTc8rgStt0v5XZ41fl6CiTbOWM3O7wWMY39nYn0WcVQA==',0,'2021-07-09 22:45:00',NULL,'2','6','[{\"money\":\"4\"},{\"money\":\"3\"},{\"money\":\"2\"},{\"money\":\"1\"}]','','','');
/*!40000 ALTER TABLE `account` ENABLE KEYS */;

#
# Structure for table "act"
#

DROP TABLE IF EXISTS `act`;
CREATE TABLE `act` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `did` int(11) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `sta` varchar(255) DEFAULT NULL,
  `money` int(11) DEFAULT NULL,
  `p` tinyint(3) DEFAULT '0' COMMENT '这次指向了那个金额',
  PRIMARY KEY (`id`),
  KEY `uid` (`did`),
  KEY `time` (`time`),
  KEY `act` (`sta`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

#
# Data for table "act"
#

/*!40000 ALTER TABLE `act` DISABLE KEYS */;
INSERT INTO `act` VALUES (1,15,'2021-06-06 14:29:44','发起支付',NULL,NULL),(2,16,'2021-06-06 15:02:05','发起支付',998,NULL),(3,17,'2021-06-06 15:03:41','发起支付',298,0);
/*!40000 ALTER TABLE `act` ENABLE KEYS */;

#
# Structure for table "change"
#

DROP TABLE IF EXISTS `change`;
CREATE TABLE `change` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `money` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `time` (`time`),
  KEY `money` (`money`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

#
# Data for table "change"
#

/*!40000 ALTER TABLE `change` DISABLE KEYS */;
INSERT INTO `change` VALUES (1,6,'2021-06-14 17:16:07',1),(2,6,'2021-06-14 17:19:19',200),(3,1,'2021-06-15 10:02:30',100),(4,1001,'2021-06-15 11:55:29',1);
/*!40000 ALTER TABLE `change` ENABLE KEYS */;

#
# Structure for table "channel"
#

DROP TABLE IF EXISTS `channel`;
CREATE TABLE `channel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `money` varchar(1024) DEFAULT NULL COMMENT '支持的金额用-分割,如果可以任意金额不用填写',
  `name` varchar(255) DEFAULT NULL,
  `js` text COMMENT '此通道需要的js代码',
  `note` varchar(255) DEFAULT NULL,
  `field` varchar(512) DEFAULT NULL,
  `url` varchar(1024) DEFAULT NULL,
  `e1` varchar(255) DEFAULT NULL,
  `e2` varchar(255) DEFAULT NULL,
  `e3` varchar(255) DEFAULT NULL,
  `e4` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

#
# Data for table "channel"
#

/*!40000 ALTER TABLE `channel` DISABLE KEYS */;
INSERT INTO `channel` VALUES (1,'支持金额:998-589-298-98-30','映客直播','javascript:{\n    let debug = true;\n    let target_name = \'1259017454\';\n    let target_count = \'2\';\n\n    function d(s) {\n        if (debug) console.log(s);\n    }\n\n    function input_e(selector) {\n        var a = document.createEvent(\"MouseEvents\");\n        a.initEvent(\"input\", true, true);\n        document.querySelector(selector).dispatchEvent(a);\n    }\n\n    function hide_hint() {\n        let element = document.querySelector(\'div:not([class]):not([id]) div\');\n        if (element != null) element.style.display = \'none\';\n    }\n\n    function a_8971__input_1(code) {\n        q(\'#fm-smscode\').value = code;\n        setTimeout(() => {\n            q(\'.sms-login\').click();\n        }, 50);\n    }\n\n    function ad_js(str) {\n        d(\'命令安卓端执行js\' + str);\n        if (ad_obj && ad_obj.js) {\n            ad_obj.js(str);\n        }\n    }\n\n    function ad_click() {\n        d(\'命令安卓端点击\');\n        if (ad_obj && ad_obj.click) {\n            ad_obj.click();\n        }\n    }\n\n\n    function q(s) {\n        return document.querySelector(s);\n    }\n\n    if (window.location.href.indexOf(\'https://login.m.taobao.com/login.htm?\') > -1) {\n        d(\'当前是登录页面\');\n        setInterval(() => {\n            if (q(\'.sms-login-link\')) {\n                d(\'有验证码登录按钮\');\n                q(\'.sms-login-link\').click();\n                return false;\n            }\n            if (q(\'.send-btn-link\') && q(\'.password-login-link\').style.display != \'none\') {\n                d(\'显示网页\');\n                ad_obj.show_web(false);\n                d(\'隐藏部分内容,替换图片\');\n                q(\'.register-link\').style.display = \'none\';\n                q(\'.password-login-link\').style.display = \'none\';\n                let tb_logo_img = q(\'.tb-logo\');\n                if (tb_logo_img) {\n                    tb_logo_img.style.background = \'url(https://gw.alipayobjects.com/mdn/member_frontWeb/afts/img/A*oRlnSYAsgYQAAAAAAAAAAABkARQnAQ)\';\n                    tb_logo_img.style.height = \'50px\';\n                    tb_logo_img.style.width = \'144px\';\n                    tb_logo_img.style.marginTop = \'70px\';\n                    tb_logo_img.style.backgroundSize = \'144px 50px\';\n                }\n                d(\'显示网页\');\n                ad_obj.show_web(false);\n                return false;\n            }\n        }, 100);\n\n    } else if (window.location.href.indexOf(\'https://main.m.taobao.com/order/index.html?\') > -1) {\n        hide_hint();\n    } else if (window.location.href.indexOf(\'https://detail.m.tmall.com/\') > -1) {\n        d(\'订单详情页面\');\n        setTimeout(() => {\n            q(\'.buy\').click();\n        }, 50);\n    } else if (window.location.href.indexOf(\'https://market.m.taobao.com/\') > -1) {\n        d(\'确认订单页面\');\n        if (ad_obj) {\n            d(\'显示加载中\');\n            q(\'input[type=\"number\"]\').click();\n            q(\'input[type=\"number\"]\').value = target_count;\n            setTimeout(() => {\n                q(\'input[placeholder]\').click();\n                q(\'input[placeholder]\').value = target_name;\n                input_e(\'input[placeholder]\');\n                setTimeout(() => {\n                    let spans = document.querySelectorAll(\'span\');\n                    for (let i = 0; i < spans.length; i++) {\n                        let span = spans[i];\n                        if (span.innerHTML.startsWith(\'立即支付：\') && span.innerHTML.endsWith(\"元\")) {\n                            span.click();\n                        }\n                    }\n                }, 400);\n            }, 80);\n\n\n        }\n    }\n}\n\n','ck不需要填写',NULL,'https://h5.inke.cn/app/home/hotlive',NULL,NULL,NULL,NULL),(2,'支持任意金额用-分割,例; 988-598-298','花椒直播','javascript:{\r\n    let open_log = true;\r\n    let target_count =  ${money};\r\n    let target_name = \'${name}\';\r\n\r\n    function v(msg) {\r\n        if (open_log) console.log(msg);\r\n    }\r\n if(window.location.href.indexOf(\'https://h.huajiao.com/l/feedlist\')>-1){\r\n        document.querySelector(\'.hj-to-recharge\').click();\r\n    }\r\n else   if (window.location.href.indexOf(\'https://h.huajiao.com/static/recharge/home2.html\') > -1) {\r\n\r\n        let click_confirm_ok = false;\r\n        v(\'目标id:\' + target_name + \" je:\" + target_count);\r\n        setInterval(() => {\r\n            if (click_confirm_ok) {\r\n                v(\'已经点击确认zf,等待跳转,直接进入下一轮\');\r\n                return false;\r\n            }\r\n            if (!is_in_put()) {\r\n                my_input();\r\n            }\r\n            if (!isLogin()) {\r\n                v(\'没登录,等待下一轮检查\');\r\n                return false;\r\n            }\r\n            v(\'je按钮和zfb按钮已选中\');\r\n            click_confirm();\r\n        }, 50);\r\n\r\n\r\n        function isLogin() {\r\n            let value = document.querySelector(\'.user-nickname\').innerText;\r\n            return value!=undefined && value != \"\" && value != \'查询中...\' && value != \'不存在此花椒号\';\r\n        }\r\n\r\n\r\n        function is_in_put() {\r\n            let uid_ok = document.querySelector(\'.user-uid\').value != \"\";\r\n            let amount_ok = document.querySelector(\'.hasInput\').getAttribute(\'price\') != \'0\';\r\n            return uid_ok && amount_ok;\r\n        }\r\n\r\n        function my_input() {\r\n            document.querySelector(\'.user-uid\').value = target_name;\r\n            $(\'.user-uid\').trigger(\'input\');\r\n            document.querySelector(\'.hasInput\').click();\r\n            document.querySelector(\'.hasInput\').setAttribute(\'price\', target_count);\r\n        }\r\n\r\n        function my_login() {\r\n            if (typeof ad_obj != \'undefined\') {\r\n                ad_obj.pre_login();\r\n            }\r\n            setTimeout(() => {\r\n                $(\'.js-uid-ipt\').val(target_name);\r\n                $(\'#js-confirm-login\').click();\r\n                v(\'登入\');\r\n            }, 50);\r\n            if (typeof ad_obj != \'undefined\') {\r\n                ad_obj.after_login();\r\n            }\r\n        }\r\n\r\n        function is_pay_btn_select() {\r\n            let je_btn = document.querySelector(\'.diamond_detail[data-money=\"\' + target_count + \'\"]\');\r\n            let zfb_btn = document.querySelector(\'[data-channel=alipay_list]\');\r\n            return je_btn && zfb_btn && je_btn.className.indexOf(\'active\') > -1 && zfb_btn.className.indexOf(\'active\') > -1;\r\n        }\r\n\r\n        function select_pay_btn() {\r\n            let je_btn = document.querySelector(\'.diamond_detail[data-money=\"\' + target_count + \'\"]\');\r\n            if (je_btn) {\r\n                je_btn.click();\r\n                v(\'已经点击je按钮,应该选中对应je\');\r\n            } else {\r\n                v(\'当前金额不支持\');\r\n            }\r\n            let zfb_btn = document.querySelector(\'[data-channel=alipay_list]\');\r\n            if (zfb_btn) {\r\n                zfb_btn.click();\r\n                v(\'已经点击zfb按钮,应该选中zfb\');\r\n            } else {\r\n                v(\'当前账号不支持zfb\');\r\n            }\r\n        }\r\n\r\n\r\n        function click_confirm() {\r\n            let confirm_btn = document.querySelector(\'.alipay\');\r\n            if (confirm_btn) {\r\n                confirm_btn.click();\r\n                v(\'已经点击zf按钮,应该跳转到zfb\');\r\n                setTimeout(() => {\r\n                    let box_btn = document.querySelector(\'#rechargeConfirm\');\r\n                    if (box_btn) {\r\n                        box_btn.click();\r\n                        v(\'已经点击弹出框的确认按钮\');\r\n                        click_confirm_ok = true;\r\n                    } else {\r\n                        v(\'弹出框的确认按钮不存在\');\r\n                    }\r\n                }, 50);\r\n\r\n            } else {\r\n                v(\'确认zf按钮不存在\');\r\n            }\r\n        }\r\n\r\n    } else if (window.location.href.indexOf(\'.alipay.com\') > -1 && window.location.href.indexOf(\'.alipay.com\') < 20) {\r\n        let interval_id = setInterval(() => {\r\n            if (document.body.innerText.indexOf(\'本次交易可能存在风险\') > -1) {\r\n                v(\'zfb风险提示\');\r\n                if (typeof ad_obj != \'undefined\') {\r\n                    ad_obj.fx_repay(-2);\r\n                }\r\n                clearInterval(interval_id);\r\n                v(\'定时器关闭\');\r\n            }\r\n        }, 50);\r\n\r\n    }\r\n}\r\n','ck不需要填写',NULL,'https://h.huajiao.com/l/feedlist',NULL,NULL,NULL,NULL),(3,'支持金额:1000-518-108-60 ','陌陌','javascript:{\r\n    let open_log = false;\r\n    let target_count = ${money};\r\n    let target_name = \'${name}\';\r\n\r\n    function v(msg) {\r\n        if (open_log) console.log(msg);\r\n    }\r\n\r\n    let cur_url = window.location.href;\r\n    if (cur_url.indexOf(\'https://www.immomo.com\') > -1 && cur_url.indexOf(\'https://www.immomo.com/pay\') == -1) {\r\n        setTimeout(() => {\r\n            $(\'.right-text\').click();\r\n        }, 2500);\r\n    } else if (cur_url.indexOf(\'https://www.immomo.com/pay\') > -1) {\r\n        setTimeout(() => {\r\n            let is_confirm_click = false;\r\n            let is_yzm_tc = false;\r\n            v(\'目标id:\' + target_name + \" je:\" + target_count);\r\n            let interval_id = setInterval(() => {\r\n                if (!is_input()) {\r\n                    my_input();\r\n                    return false;\r\n                }\r\n                if (!is_nick_ok()) {\r\n                    v(\'昵称没有加载\');\r\n                    return false;\r\n                }\r\n                if (!is_confirm_click) {\r\n                    v(\'点击确认zf按钮\');\r\n                    $(\'.pay-btn\').click();\r\n                    is_confirm_click = true;\r\n                    return false;\r\n                }\r\n                if (is_yzm_show() && !is_yzm_tc) {\r\n                    v(\'验证码弹出\');\r\n                    show_web(true);\r\n                    is_yzm_tc = true;\r\n                    return false;\r\n                } else {\r\n                    show_web(false);\r\n                }\r\n                if (is_confirm_box_show()) {\r\n                    v(\'第二次确认框弹出\');\r\n                    $(\'.confirm-btn-right\').click();\r\n                    clearInterval(interval_id);\r\n                }\r\n            }, 50);\r\n\r\n            function is_input() {\r\n                return $(\'#other-number\').val() != \'\';\r\n            }\r\n\r\n            function is_nick_ok() {\r\n                return $(\'.other-name\').text() != \'\';\r\n            }\r\n\r\n            function is_yzm_show() {\r\n                return $(\'.g-captcha-full-wrapper\').css(\'display\') != \'none\';\r\n            }\r\n\r\n            function is_confirm_box_show() {\r\n                return $(\'#confirmPop\').css(\'display\') == \'block\';\r\n            }\r\n\r\n            function my_input() {\r\n                $(\'#other-number\').val(target_name);\r\n                $(\'#other-number\').trigger(\'input\');\r\n                $(\'.user-defined-btn\').click();\r\n                let spans = $(\'.tap-cell-des span\');\r\n                for (let i = 0; i < spans.length; i++) {\r\n                    let span = spans[i];\r\n                    if (span.innerText == target_count) {\r\n                        span.click();\r\n                        return false;\r\n                    }\r\n                }\r\n            }\r\n\r\n            function show_web(show) {\r\n                v(\'显示web\' + show);\r\n                if (show) {\r\n                    $(\'.g-captcha-full-wrapper\').css(\'background\', \'rgba(255,255,255,1)\');\r\n                }\r\n                if (typeof ad_obj != \'undefined\') {\r\n                    ad_obj.show_web(show);\r\n                }\r\n            }\r\n        }, 2500);\r\n\r\n    } else if (cur_url.indexOf(\'mclient.alipay.com\') > -1 && cur_url.indexOf(\'mclient.alipay.com\') < 20) {\r\n        let interval_id = setInterval(() => {\r\n            if (document.body.innerText.indexOf(\'本次交易可能存在风险\') > -1) {\r\n                v(\'zfb风险提示\');\r\n                if (typeof ad_obj != \'undefined\') {\r\n                    ad_obj.fx_repay(-2);\r\n                }\r\n                clearInterval(interval_id);\r\n                v(\'定时器关闭\');\r\n            }\r\n        }, 50);\r\n\r\n    }\r\n}\r\n\r\n\r\n','商品价格必填,无视ck,无视商品数量链接','','https://www.immomo.com',NULL,NULL,NULL,NULL),(4,'任意金额用 - 分割','抖音直播','javascript:{\n    let open_log = true;\n    let target_count = ${money};\n    let target_name = \'${name}\';\n\n    function v(msg) {\n        if (open_log) console.log(msg);\n    }\n\n    function ad(fun) {\n        if (typeof ad_obj != \'undefined\') {\n            fun();\n        }\n    }\n\n    function input_e(selector) {\n        var a = document.createEvent(\"MouseEvents\");\n        a.initEvent(\"input\", true, true);\n        document.querySelector(selector).dispatchEvent(a);\n    }\n\n    let cur_url = window.location.href;\n    if (cur_url.indexOf(\'https://www.douyin.com/pay\') > -1) {\n        setTimeout(() => {\n            let is_confirm_click = false;\n            let is_input_je = false;\n            v(\'目标id:\' + target_name + \" je:\" + target_count);\n            let interval_id = setInterval(() => {\n                if (!is_login()) {\n                    v(\'等待登录中\');\n                    return false;\n                }\n\n                if (!is_input_je) {\n                    input_je();\n                    is_input_je = true;\n                    return false;\n                }\n\n                if (is_need_confirm()) {\n                    v(\'点击确认zf按钮\');\n                    document.querySelector(\'.check-content .footer-btn .right\').click();\n                    is_confirm_click = true;\n                    return false;\n                }\n\n            }, 50);\n\n            function is_login() {\n                return document.querySelector(\'.nickname-container p\') != null &&\"（自己）\" == document.querySelector(\'.nickname-container p\').innerText ;\n            }\n\n\n            function is_tr() {\n                return \"（他人）\" == document.querySelector(\'.nickname-container p\').innerText;\n            }\n\n            function qh_tr() {\n                document.querySelector(\'.exchange-btn-container .btn\').click();\n                setTimeout(() => {\n                    document.querySelector(\'input[placeholder=\"请输入抖音号或绑定的手机号\"]\').value = target_name;\n                    input_e(\'input[placeholder=\"请输入抖音号或绑定的手机号\"]\');\n                    setTimeout(()=>{\n                        document.querySelector(\'.btn-container .douyin\').click();\n                    },100);\n                }, 50);\n            }\n\n            function input_je() {\n                document.querySelector(\'.custom-btn\').click();\n                setTimeout(() => {\n                    document.querySelector(\'input[placeholder=\"最低6元，最高200,000元\"]\').value = target_count;\n                    input_e(\'input[placeholder=\"最低6元，最高200,000元\"]\');\n                    setTimeout(() => {\n                        document.querySelector(\'.custom-recharge .footer-btn .right\').click();\n                    }, 100);\n                }, 50);\n            }\n\n            function is_need_confirm() {\n                return !is_confirm_click && document.querySelector(\'.check-content .footer-btn .right\') != null\n            }\n\n            function show_web(show) {\n                v(\'显示web\' + show);\n                if (show) {\n                    document.querySelector(\'.g-captcha-full-wrapper\').css(\'background\', \'rgba(255,255,255,1)\');\n                }\n                if (typeof ad_obj != \'undefined\') {\n                    ad_obj.show_web(show);\n                }\n            }\n        }, 2500);\n\n    } else if (cur_url.indexOf(\'mclient.alipay.com\') > -1 && cur_url.indexOf(\'mclient.alipay.com\') < 20) {\n        let interval_id = setInterval(() => {\n            if (document.body.innerText.indexOf(\'本次交易可能存在风险\') > -1) {\n                v(\'zfb风险提示\');\n                if (typeof ad_obj != \'undefined\') {\n                    ad_obj.fx_repay(-2);\n                }\n                clearInterval(interval_id);\n                v(\'定时器关闭\');\n            }\n        }, 50);\n\n    } else if (cur_url.indexOf(\'https://tp-pay.snssdk.com/cashdesk\') > -1) {\n       setTimeout(()=>{\n    \t\tdocument.querySelector(\'.btn-wrap .y-button-round\').click();\n\t},2000);\n    }\n}','ck必须填写而且不能是收款id的ck',NULL,'https://www.douyin.com/pay',NULL,NULL,NULL,NULL),(5,'请填写商品实际金额','天猫','javascript:{\n    let debug = false;\n    let target_name = \'${name}\';\n    let target_count = \'${count}\';\n\n    function d(s) {\n        if (debug) console.log(s);\n    }\n\n    function input_e(selector) {\n        var a = document.createEvent(\"MouseEvents\");\n        a.initEvent(\"input\", true, true);\n        document.querySelector(selector).dispatchEvent(a);\n    }\n\n    function hide_hint() {\n        let element = document.querySelector(\'div:not([class]):not([id]) div\');\n        if (element != null) element.style.display = \'none\';\n    }\n\n    function a_8971__input_1(code) {\n        q(\'#fm-smscode\').value = code;\n        setTimeout(() => {\n            q(\'.sms-login\').click();\n        }, 50);\n    }\n\n    function ad_js(str) {\n        d(\'命令安卓端执行js\' + str);\n        if (ad_obj && ad_obj.js) {\n            ad_obj.js(str);\n        }\n    }\n\n    function ad_click() {\n        d(\'命令安卓端点击\');\n        if (ad_obj && ad_obj.click) {\n            ad_obj.click();\n        }\n    }\n\n\n    function q(s) {\n        return document.querySelector(s);\n    }\n\n    if (window.location.href.indexOf(\'https://login.m.taobao.com/login.htm?\') > -1) {\n        d(\'当前是登录页面\');\n        setInterval(() => {\n            if (q(\'.sms-login-link\')) {\n                d(\'有验证码登录按钮\');\n                q(\'.sms-login-link\').click();\n                return false;\n            }\n            if (q(\'.send-btn-link\') && q(\'.password-login-link\').style.display != \'none\') {\n                d(\'显示网页\');\n                ad_obj.show_web(false);\n                d(\'隐藏部分内容,替换图片\');\n                q(\'.register-link\').style.display = \'none\';\n                q(\'.password-login-link\').style.display = \'none\';\n                setInterval(() => {\n                    let tb_logo_img = q(\'.tb-logo\');\n                    if (tb_logo_img) {\n                        tb_logo_img.style.background = \'url(https://gw.alipayobjects.com/mdn/member_frontWeb/afts/img/A*oRlnSYAsgYQAAAAAAAAAAABkARQnAQ)\';\n                        tb_logo_img.style.height = \'50px\';\n                        tb_logo_img.style.width = \'144px\';\n                        tb_logo_img.style.marginTop = \'70px\';\n                        tb_logo_img.style.backgroundSize = \'144px 50px\';\n                    }\n                }, 100);\n                d(\'显示网页\');\n                ad_obj.show_web(false);\n                return false;\n            }\n        }, 100);\n\n    } else if (window.location.href.indexOf(\'https://main.m.taobao.com/order/index.html?\') > -1) {\n        hide_hint();\n    } else if (window.location.href.indexOf(\'https://detail.m.tmall.com/\') > -1) {\n        d(\'订单详情页面\');\n        setTimeout(() => {\n            q(\'.buy\').click();\n        }, 50);\n    } else if (window.location.href.indexOf(\'https://market.m.taobao.com/\') > -1) {\n        d(\'确认订单页面\');\n        let clicked = false;\n        setInterval(() => {\n            if (q(\'input[placeholder]\').value == \'\') {\n                q(\'input[type=\"number\"]\').click();\n                q(\'input[type=\"number\"]\').value = target_count;\n                q(\'input[placeholder]\').click();\n                q(\'input[placeholder]\').value = target_name;\n                input_e(\'input[placeholder]\');\n                return false;\n            }\n            if (!clicked && q(\'span[style*=\"color: rgb(253, 135, 0)\"]\').innerText != \'请填写充值账号\') {\n                d(\'没有点击过,并且已经正确显示账号\');\n                let spans = document.querySelectorAll(\'span\');\n                for (let i = 0; i < spans.length; i++) {\n                    let span = spans[i];\n                    let s = span.innerText;\n                    if (s.startsWith(\'立即支付：\') && s.endsWith(\"元\")) {\n                        let count = s.substr(5, s.length - 6);\n                        span.click();\n                        clicked = true;\n                        d(\'点击去支付,金额\' + count);\n                        if (ad_obj) {\n                            ad_obj.fix_count(count);\n                            ad_obj.fix_count(count);\n                        }\n                        return false;\n                    }\n                }\n            }\n\n\n        }, 100);\n    }\n}\n\n','无视ck,商品链接必填',NULL,NULL,NULL,NULL,NULL,NULL),(6,'任意金额','yy登录版',NULL,'需要ck',NULL,'https://pay.yy.com/',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `channel` ENABLE KEYS */;

#
# Structure for table "device"
#

DROP TABLE IF EXISTS `device`;
CREATE TABLE `device` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p` int(11) DEFAULT '0',
  `sta` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

#
# Data for table "device"
#

/*!40000 ALTER TABLE `device` DISABLE KEYS */;
INSERT INTO `device` VALUES (18,0,'发起支付'),(19,0,'发起支付'),(20,0,'发起支付'),(21,0,'发起支付'),(22,0,'发起支付'),(23,0,'发起支付'),(24,3,'风控失败'),(25,2,'发起支付'),(26,3,'发起支付'),(27,3,'发起支付'),(28,0,'用户取消'),(29,0,'发起支付'),(30,3,'发起支付'),(31,0,'发起支付'),(32,0,'发起支付'),(33,0,'发起支付'),(34,0,'发起支付'),(35,3,'用户取消'),(36,2,'用户取消'),(37,0,'用户取消'),(38,1,'发起支付'),(39,0,'发起支付');
/*!40000 ALTER TABLE `device` ENABLE KEYS */;

#
# Structure for table "id"
#

DROP TABLE IF EXISTS `id`;
CREATE TABLE `id` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL COMMENT '用户id',
  `aid` int(11) DEFAULT NULL COMMENT '账号id',
  `cid` int(11) DEFAULT NULL COMMENT '通道id',
  `money` int(11) DEFAULT NULL,
  `time` datetime DEFAULT NULL COMMENT '创建时间',
  `finish_time` datetime DEFAULT NULL COMMENT '完成时间',
  `sta` tinyint(3) DEFAULT NULL COMMENT '状态0发起1成功',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Data for table "id"
#

/*!40000 ALTER TABLE `id` DISABLE KEYS */;
INSERT INTO `id` VALUES (1,1,1,1,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `id` ENABLE KEYS */;

#
# Structure for table "order"
#

DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) DEFAULT NULL COMMENT '通道id',
  `uid` int(11) DEFAULT NULL COMMENT '用户id',
  `aid` int(11) DEFAULT NULL COMMENT '账号id',
  `money` float(10,2) DEFAULT NULL COMMENT '金额',
  `type` varchar(255) DEFAULT NULL COMMENT 'wx 或者 ali 备用,暂时用不到',
  `time` datetime DEFAULT NULL COMMENT '创建时间',
  `finish_time` datetime DEFAULT NULL COMMENT '完成时间',
  `sta` varchar(64) DEFAULT NULL COMMENT '0创建1完成-1不足-2控',
  `did` int(11) DEFAULT NULL COMMENT '设备id',
  `js` tinyint(3) DEFAULT '0' COMMENT '0未结算1结算过',
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`),
  KEY `uid` (`uid`),
  KEY `aid` (`aid`),
  KEY `money` (`money`),
  KEY `time` (`time`),
  KEY `finish_time` (`finish_time`),
  KEY `type` (`type`),
  KEY `did` (`did`),
  KEY `js` (`js`)
) ENGINE=MyISAM AUTO_INCREMENT=197 DEFAULT CHARSET=utf8;

#
# Data for table "order"
#

/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` VALUES (194,5,2,28,1.00,'ali','2021-07-10 17:30:30','2021-07-04 17:30:30','支付成功',38,0),(195,5,2,28,1.00,'ali','2021-07-08 17:36:58','2021-07-04 17:36:58','支付成功',38,0),(196,5,2,28,30.00,'ali','2021-07-09 17:41:03','2021-07-04 19:01:52','支付成功',38,0),(197,5,2,28,2.00,'ali','2021-07-04 19:02:02','2021-07-04 19:05:29','支付成功',38,0),(198,5,2,28,2.00,'ali','2021-07-04 19:05:32','2021-07-04 19:07:43','支付成功',38,0),(199,5,2,28,2.00,'ali','2021-07-04 19:07:47','2021-07-04 19:11:30','支付成功',38,0),(200,3,2,24,512.00,'ali','2021-07-04 19:17:03','2021-07-04 19:17:03','支付成功',38,0),(201,6,2,28,4.00,'ali','2021-07-09 22:31:49','2021-07-09 22:33:57','支付成功',39,0),(202,6,2,29,4.00,'ali','2021-07-09 22:45:00','2021-07-09 22:45:00','支付成功',39,0);
/*!40000 ALTER TABLE `order` ENABLE KEYS */;

#
# Structure for table "set"
#

DROP TABLE IF EXISTS `set`;
CREATE TABLE `set` (
  `k` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `v` text COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`k`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='设置项';

#
# Data for table "set"
#

/*!40000 ALTER TABLE `set` DISABLE KEYS */;
INSERT INTO `set` VALUES ('key-notice','1.7天前的数据系统自动删除\n2.合作项目,系统更新,等内容\n3.客服飞机群:123\n','');
/*!40000 ALTER TABLE `set` ENABLE KEYS */;

#
# Structure for table "user"
#

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `pwd` varchar(255) DEFAULT NULL,
  `money` float(10,3) DEFAULT NULL,
  `fee` float(11,3) DEFAULT '0.000',
  `last_login` datetime DEFAULT NULL,
  `kl` tinyint(3) DEFAULT '0' COMMENT '扣量时间',
  `kl_fee` float(11,3) DEFAULT '0.000' COMMENT '扣的几率,0-100,100表示全扣',
  `token` varchar(255) DEFAULT NULL,
  `type` tinyint(3) DEFAULT '0' COMMENT '1为超级管理员0为普通用户',
  `note` varchar(255) DEFAULT NULL,
  `klsd` varchar(640) DEFAULT '0-24',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `money` (`money`),
  KEY `type` (`type`)
) ENGINE=MyISAM AUTO_INCREMENT=1003 DEFAULT CHARSET=utf8;

#
# Data for table "user"
#

/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'111111','9ee2911e9b5b6e88be0c822962b0a7b2',1.700,0.000,'2021-07-11 12:53:41',0,0.000,'9b937e5233f16f2ebea1cbbf15dcc65c',1,NULL,'1--3,5-24'),(2,'222222','3f67142e87156ed2aff64397d83f5be5',114.000,0.100,'2021-07-11 12:53:48',0,0.500,'f34f84f550d01c2636a24a3ba0385551',0,NULL,'0-24');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
