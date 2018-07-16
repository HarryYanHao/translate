<?php

use Illuminate\Database\Capsule\Manager as Capsule;
header("Content-type:text/html;charset=utf-8");
// Autoload 自动载入
require '../vendor/autoload.php';


// Eloquent ORM

$capsule = new Capsule;

$capsule->addConnection(require '../config/database.php');

$capsule->bootEloquent();

//加载需要的使用的实例
boot();
if (PHP_SAPI === 'cli'){
   $controller = new HomeController($argv);
   $controller->translate();
}else{
    echo "请在cli下执行该脚本";
}