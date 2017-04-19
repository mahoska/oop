<?php
abstract class Functions{
    
    public static function isFormValid(array $params){
        $flag = true;
        foreach ($params as $param){
            if(trim($param)==''){
                $flag = false;
                break;
            } 
        }
        return $flag;

    }

    public static function request($arr, $key, $default = null){
        return isset($arr[$key])? $arr[$key] : $default;
    }
    
    function redirect($to){
        header("Location: {$to}");
        die;
    }

}