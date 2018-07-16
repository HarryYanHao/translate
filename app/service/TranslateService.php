<?php
namespace App\Services;


class TranslateService {
    public static function translate($words,$mode=1,$word_mode = 1,$limit_words = 0){
        //选词模式1是最精确 2是单词数最短
        $words_list = [];
        foreach($words as $item){
            $item = json_decode($item,true);
            if(isset($item['basic'])){
                $explains = $item['basic']['explains'];
            }else{
                $explains = [];
            }
            if($word_mode==1){
                $words_list[] = self::filterInvalidStr(current($explains));
            }else{
                if(!empty($explains)){
                    $_temp_list = array_map(function($i){
                    return strlen($i);
                    }, $item['basic']['explains']);
                    $_pos = array_search(min($_temp_list), $_temp_list);
                    $words_list[] = self::filterInvalidStr($item['basic']['explains'][$_pos]);
                }
                
            } 
        }
        //组合模式1是方法名(驼峰) 2是参数名(下划线)
        foreach ($words_list as $index=>&$value) {
            //限制每个单词的长度
            if($limit_words != 0){
                $value = substr($value,0,$limit_words);

            }
            if($mode == 1 && $index != 0){
                //除第一个单词以外其他单词首字母大写
                $words_list[$index] = ucfirst($value);
            }
        }
        if($mode == 1){
            $split = '';
        }else{
            $split = '_';
        }
        return implode($words_list, $split);
        
    }
    private static function filterInvalidStr($words){
        $right_symbol = strrpos($words,']');
        if(!empty($right_symbol)){
            $words = trim(substr($words,$right_symbol+1));
        }
        return $words;
        
    }
      

    


}

