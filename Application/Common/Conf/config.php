<?php
return array(
	/* 模块相关配置 */
	'DEFAULT_MODULE'     => 'Home',
    'MODULE_DENY_LIST'   => array('Common', 'Api'),
    'MODULE_ALLOW_LIST'  => array('Home','Admin','Mobile'),

    /* 系统数据加密设置 */
    'DATA_AUTH_KEY' => 'ab+GMpX2Y)0:J,/tk*uqL8De.WV-SjIfx{3}7Us^', //默认数据加密KEY


    /* 调试配置 */
    'SHOW_PAGE_TRACE' => true,

        /* URL配置 */
    'URL_CASE_INSENSITIVE' => true, //默认false 表示URL区分大小写 true则表示不区分大小写
    'URL_MODEL'            => 3, //URL模式
    'VAR_URL_PARAMS'       => '', // PATHINFO URL参数变量
    'URL_PATHINFO_DEPR'    => '/', //PATHINFO URL分割符

    /* 全局过滤配置 */
    'DEFAULT_FILTER' => '', //全局过滤函数

    /* 数据库配置 */
    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => '127.0.0.1', // 服务器地址
    'DB_NAME'   => 'parents', // 数据库名
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => 'root',  // 密码
    'DB_PORT'   => '3306', // 端口
    'DB_PREFIX' => 'parent_', // 数据库表前缀
);