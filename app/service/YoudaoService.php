<?php
namespace App\Services;

use App\Models\Collect;
class YoudaoService {
    public static function generateSign($q){
        $youdaoConfig = config('youdao');
        $appId = $youdaoConfig['app_id'];
        $secret = $youdaoConfig['secret'];
        $salt = time();
        $sign = $appId.$q.$salt.$secret;
        $sign = strtoupper(md5($sign));
        return ['sign'=>$sign,'salt'=>$salt];
    }

    public static function generateKey($key){
        return 'translate:key'.$key;
    }

    public static function getTranslateRes($out_put){
        $from = 'zh-CHS';
        $to = "EN";
        $splitArr = explode(',',$out_put);
        $redis = app('redis');
        $db = app('db');
        foreach ($splitArr as  $item) {
        //查询之前DB和redis的数据，如果有不调用接口
        $key = self::generateKey(json_encode($item));
        $res = $redis->get($key);
        if(!empty($res)){
            $data[] = $res;
            continue;
        }
        $res_arr = Collect::where('query',json_encode($item))->get()->toArray();
        if(!empty($res_arr)){
            $data[] = $res_arr;
            continue;
        }

        $youdaoConfig = config('youdao');
        $resSign = YoudaoService::generateSign($item);
        $salt = $resSign['salt'];
        $sign = $resSign['sign'];
        $appId = $youdaoConfig['app_id'];
        $build_query = ['q'=>$item,'from'=>$from,'to'=>$to,'appKey'=>$appId,'salt'=>$salt,'sign'=>$sign];
        $url=$youdaoConfig['uri'].'?'.http_build_query($build_query);
        $res = RequestService::get($url);
        $res = json_decode($res,true);
        self::storeRedisTranslateRes($res);
        self::storeDBTranslateRes($res);
        $json_res = json_encode($res);
        $data[] = $json_res;
    
    }
    return $data;  
  }

  private static function storeRedisTranslateRes($res){
    //储存至redis
    $redis = app('redis');
    $key = self::generateKey(json_encode($res['query']));
    $res = json_encode($res);
    return $redis->set($key,$res);
  }
  private static function storeDBTranslateRes($res){
    //储存至DB
    $fill_data = ['web'=>json_encode($res['web']),'query'=>json_encode($res['query']),'basic'=>json_encode($res['basic'])];
    return Collect::create($fill_data);
  }
}

