<?php

spl_autoload_register(function($className){
    $filePath = "classes/{$className}.php";
    if(!file_exists($filePath))
        die("File {$filePath} not found!");
    require_once $filePath;
});

try{
$rec = new Request("http://www.w3.org:80/pub/WWW/Project.html", "post");
echo $rec;
$time = date('Y m d H:i:s');
$rec->addHeader("Date", $time);
echo $rec;
echo"<hr>";

$rec1 = new Request("http://domain.test","post",["ContentType"=>"text/plain"],"Testing...");
echo $rec1->getHeader("ContentType"),"<br>";
echo $rec1;
echo"<hr>";

$rec2 = new Request("httpt://domain.test","post");
echo $rec2;

}
catch(Exception $e){
    echo $e->getMessage();
    die();
}