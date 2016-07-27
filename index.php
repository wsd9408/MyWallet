<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用入口文件

// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',FALSE);

// 定义应用目录
define('APP_PATH','./Application/');
//定义后台CSS IMG 以及JS文件路径
define("SITE_URL",'http://127.0.0.1:8080/MyWallet/');
define("PUBLIC_URL",SITE_URL."Public/"); //public目录
define('CSS_URL',SITE_URL.'Public/Admin/css/');
define('IMG_URL',SITE_URL.'Public/Admin/img/');
define('JS_URL',SITE_URL.'Public/Admin/js/');
//定义前台CSS IMG 以及JS文件路径

define("HOME_CSS_URL",SITE_URL."Public/Home/css/"); //前台css目录
define("HOME_IMG_URL",SITE_URL."Public/Home/img/"); //前台img目录
define("HOME_JS_URL",SITE_URL."Public/Home/js/"); //前台js目录
define("HOME_BOOTSTRAP_URL",SITE_URL."Public/Home/bootstrap-dist/"); //前台js目录
define("HOME_EMAIL_URL",SITE_URL."Public/Home/email_templates/"); //前台js目录
define("HOME_FONT_AWESOME_URL",SITE_URL."Public/Home/font-awesome/"); //前台js目录
define("HOME_FRONTEND_URL",SITE_URL."Public/Home/frontend_theme/"); //前台js目录
// 引入ThinkPHP入口文件
require './ThinkPHP/ThinkPHP.php';

// 亲^_^ 后面不需要任何代码了 就是如此简单