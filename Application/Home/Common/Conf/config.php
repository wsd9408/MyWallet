<?php
return array(
	//'配置项'=>'配置值'

    'DEFAULT_MODULE'     => 'Index', //默认模块
    'URL_MODEL'          => '1', //URL模式
    'SESSION_AUTO_START' => true, //是否开启session

    //默认模块
    'DEFAULT_MODULE' => 'Home',

    'MODULE_ALLOW_LIST'  => array('Home','Admin'),
    
    //url地址大小写敏感设置
    'URL_CASE_INSENSITIVE'  =>  true,

    //数据库连接配置
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'mywallet',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  '',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'wallet_',    // 数据库表前缀
    'DB_FIELDTYPE_CHECK'    =>  false,       // 是否进行字段类型检查
    //以下字段缓存没有其作用
    //① 如果是调试模式就不起作用
    //② false  也是不起作用
    'DB_FIELDS_CACHE'       =>  true,        // 启用字段缓存
    'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8


    	// 配置邮件发送服务器
    'MAIL_SMTP'                     =>TRUE, //开启SMTP
    'MAIL_HOST'                     =>'smtp.163.com', //邮件服务器
    'MAIL_SMTPAUTH'                 =>TRUE,
    'MAIL_ADDRESS'                  =>'HericYoung@163.com', // 邮箱地址
    'MAIL_LOGINNAME'                =>'HericYoung', // 邮箱登录帐号
    'MAIL_USERNAME'                 =>'HericYoung@163.com', //服务器账户名
    'MAIL_PASSWORD'                 =>'Thisismyhouse3',	//密码
    //'MAIL_SECURE'                   =>'tls',	//安全协议
    'MAIL_CHARSET'                  =>'utf-8',	//格式编码
    //'FROM_NAME'                     => 'MyWallet', //发件人名称
    'MAIL_ISHTML'                   =>TRUE,		//开启html形式
    'MAIL_PORT'						=>25,		//端口


    'LOAD_EXT_FILE'       =>  'common',
);
