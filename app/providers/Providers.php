<?php
namespace App\Providers;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
    class Log
    {
        public static function bootLog()
        {
            $log = new Logger('controller');
            $log->pushHandler(new StreamHandler('../storage/log/' . date('Y-m-d') . '.log', Logger::WARNING));
            return $log;
        }
    }
    class DB{
	    public static function bootDB(){
	        $pdo = '';
		    $dbConfig = config('database');
        	$dsn ="{$dbConfig['driver']}:host={$dbConfig['host']};dbname={$dbConfig['database']}";
        	try{
           		$pdo = new \PDO($dsn,$dbConfig['username'],$dbConfig['password']);
       		}catch(\PDOException $e){
        	    dump($e->getMessage());
            	//app('log')->error('DB_ERROR:'.$e->getMessage());
       		}
       	return $pdo;
    
        }
    }
    class Redis{
        public static function bootRedis(){
            try{
                $redis = '';
                $redisConfig = config('redis');
                $redis = new \Redis();
                $redis->connect($redisConfig['host'],$redisConfig['port']);
                return $redis;
            }catch (\RedisException $e){
                app('log')->error('REDIS_ERROR:'.$e->getMessage());
            }

        }
    }
