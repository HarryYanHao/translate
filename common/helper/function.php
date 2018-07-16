<?php
function get_version(){
    return 'v1.0.0';
}
function config($param){
    if(empty($param)){
        return [];
    }
    $strPos = strpos($param,'.');
    if($strPos != false){
        $param = explode('.',$param);
        $file = $param[0];
        $attr = $param[1];
    }else{
        $file = $param;
    }
    if(!file_exists("../config/{$file}.php")){
        return [];
    }
    $config = include("../config/{$file}.php");
    if($strPos !=false){
        return isset($config[$attr])?$config[$attr]:[];
    }else{
        return $config;
    }
    
    
}
function app($param){
    //
    $app = Di::getInstance();
    return $app[$param];

}
function boot(){
    $di = new Di();
    $di->setShared('log',\App\Providers\Log::bootLog());
    $di->setShared('db',\App\Providers\DB::bootDB());
    $di->setShared('redis',\App\Providers\Redis::bootRedis());
    return $di;
}
function json($param){
    echo json_encode(['code'=>$param[0],'msg'=>$param[1],'data'=>$param[2]]);
}