<?php
//检测php版本,要求php版本必须在5.3以上才能使用thinkPHP框架
version_compare(PHP_VERSION,'5.3','>') or exit("php版本不符合要求");
//定义项目的根目录
//var_dump($_SERVER);
define("ROOT_PATH",dirname($_SERVER['SCRIPT_FILENAME']).'/');
//var_dump(ROOT_PATH);
//定义项目的框架目录
define("THINK_PATH",dirname(ROOT_PATH)."/ThinkPHP/");
//定义上传文件保存的路径目录
define("UPLOADS_PATH",ROOT_PATH."Uploads/");
//定义项目的应用目录
define("APP_PATH",ROOT_PATH."Application/");
//定义运行时目录
define("RUNTIME_PATH",ROOT_PATH."Runtime/");
//设置调试模式
define("APP_DEBUG",true);
//指定绑定模块,模块生成后立即关闭
//define("BIND_MODULE",'Admin');
//加载框架入口文件,加载了入口文件后不能再写入任何代码
require THINK_PATH."ThinkPHP.php";
