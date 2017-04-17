<?php

spl_autoload_register(function($className){
    $filePath = "classes/{$className}.php";
    if(!file_exists($filePath))
        die("File {$filePath} not found!");
    require_once $filePath;
});

function requestGet($key, $default = null){
    return isset($_GET[$key])? $_GET[$key] : $default;
}

function read_files_from_directory($fullDirPath,$dirPath,&$to){
    // Открываем директорию 
    $dir = opendir($fullDirPath); 
    if(!$dir) 
        echo "не удалось найти каталог";
    else{
      // В цикле считываем её содержимое 
      while(($filename = readdir($dir)) !== false) 
      { 
        // Если текущий объект является файлом - 
        if(!is_dir($filename)) $to[] = $dirPath.$filename; 
      } 
      // Закрываем директорию 
      closedir($dir); 
  }
}


