<?php
return array(
    /* 数据库设置 */
    'DB_TYPE'                => 'mysql', // 数据库类型
    'DB_HOST'                => '127.0.0.1', // 服务器地址
    'DB_NAME'                => 'php1009', // 数据库名
    'DB_USER'                => 'root', // 用户名
    'DB_PWD'                 => 'wangying', // 密码
    'DB_PORT'                => '', // 端口
    'DB_PREFIX'              => '', // 数据库表前缀
//    'DB_PARAMS'              => array(), // 数据库连接参数
    'DB_DEBUG'               => true, // 数据库调试模式 开启后可以记录SQL日志
    'DB_PARAMS'    =>    array(\PDO::ATTR_CASE => \PDO::CASE_NATURAL),

    'PAGE_SIZE'=>2,

);