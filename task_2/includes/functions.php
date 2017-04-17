<?php


function requestPost($key, $default = null)
{
    return isset($_POST[$key]) ? $_POST[$key] : $default;
}

function requestGet($key, $default = null)
{
    return isset($_GET[$key]) ? $_GET[$key] : $default;
}

function isRequestPost()
{
    return (bool) $_POST;
}

function isRequestGet()
{
    return (bool) $_GET;
}


//work with database
function db_connect($host, $user, $pass, $db)
{
    $link = @mysqli_connect($host, $user, $pass, $db);

    if (mysqli_connect_errno()) {
        die(mysqli_connect_error());
    }
    
    return $link;
}

function mysqli_get_result($link, $sql)
{
    $res = mysqli_query($link, $sql);
    
    if ($res === false) {
        die(mysqli_error($link));
    }
    
    return $res;
}

//widgets
 function select_key($ar, $name, $flag, $sel) {
            echo"<select  name=$name >";
        
        if ($flag == false) {
            echo"<option selected value='null'>$sel</option>";//"--выберите производителя--";
        }
        foreach ($ar as $key => $value) {
            if ($sel == $key && $flag == true) {
                echo"<option selected value ='$key'>$value</option>";
            }
            else {
                echo"<option value ='$key'>$value</option>";
            }
        }
        echo"</select>";
    }
    
    spl_autoload_register(function($className){
    $filePath = "classes/{$className}.php";
    if(!file_exists($filePath))
        die("File {$filePath} not found!");
    require_once $filePath;
    });