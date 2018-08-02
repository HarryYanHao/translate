<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
/**
* BaseController
*/
class BaseController
{
  protected $log;
  protected $request;
  public function __construct($argv=null)
  {
  	date_default_timezone_set('PRC');
    //判断是命令行模式还是web模式
    if(php_sapi_name() === 'cli'){
      $this->request = $this->parseArgs($argv);
    }else{
      $this->request = Request::createFromGlobals();
    }
    
  }
  public function method($method){
      if($method == 'GET'){
          return $this->isGet();
      }else if($method == 'POST'){
          return $this->isPost();
      }
  }
  public function isGet(){
      return $_SERVER['REQUEST_METHOD'] == 'GET' ? true : false;
  }
  public function isPost(){
      return ($_SERVER['REQUEST_METHOD'] == 'POST' &&(empty($_SERVER['HTTP_REFERER']) || preg_replace("~https?:\/\/([^\:\/]+).*~i", "\\1", $_SERVER['HTTP_REFERER']) == preg_replace("~([^\:]+).*~", "\\1", $_SERVER['HTTP_HOST']))) ? true : false;
  }
  public function _outPut($res_data){
    $response = new Response();
    $response->setContent($res_data);
    $response->setMaxAge(10);
    $response->send();
  }
  public function parseArgs($argv){
    array_shift($argv);
    $out = array();
    foreach ($argv as $arg){
      if (substr($arg,0,2) == '--'){
        $eqPos = strpos($arg,'=');
        if ($eqPos === false){
        $key = substr($arg,2);
        $out[$key] = isset($out[$key]) ? $out[$key] : true;
        } else {
        $key = substr($arg,2,$eqPos-2);
        $out[$key] = substr($arg,$eqPos+1);
        }
      }else if (substr($arg,0,1) == '-'){
        if (substr($arg,2,1) == '='){
          $key = substr($arg,1,1);
          $out[$key] = substr($arg,3);
        } else {
          $chars = str_split(substr($arg,1));
          foreach ($chars as $char){
            $key = $char;
            $out[$key] = isset($out[$key]) ? $out[$key] : true;
          }
        }
      }else {
        $out[] = $arg;
      }
    }
  return $out;
  }

}