<?php

/**
* \HomeController
*/

use App\Services\YoudaoService;
use App\Services\RequestService;
use App\Services\TranslateService;

class HomeController extends BaseController
{
  public function translate(){
    $youdaoConfig = config('youdao');
    $appId = $youdaoConfig['app_id'];
    $request = $this->request;
    if(!isset($request['words']) || empty($request['words'])){
    	echo '缺少必要参数words';
    	return ;
    }
    $words =$request['words'];


    if(isset($request['word_mode']) && !empty($request['word_mode'])){
    	$word_mode = $request['word_mode'];
    }else{
    	$word_mode = 1;
    }

    if(isset($request['mode']) && !empty($request['mode'])){
    	$mode = $request['mode'];
    }else{
    	$mode = 1;
    }

    if(isset($request['limit_words']) && !empty($request['limit_words'])){
    	$limit_words = $request['limit_words'];
    }else{
    	$limit_words = 0;
    }
    
    $out_put = exec('PYTHONIOENCODING=utf-8 /anaconda3/bin/python ../python/trans.py '.$words.' 2>&1');

    $res = YoudaoService::getTranslateRes($out_put);
    echo (TranslateService::translate($res,$mode,$word_mode,$limit_words));
    echo PHP_EOL;
   
   
  }

}
  

