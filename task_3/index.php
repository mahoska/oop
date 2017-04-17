<?php

require_once 'functions.php';
define("br", "<br>");

try{
//testing class File
//    
//    $f = new File("test_1.txt");
//    echo $f;
//
//    if($f->fileCreate("c:\users\user\desktop"))
//        echo "file create",br;
//    else 
//        echo "file exists",br;
//    
/////////////////////////////////////////////////////////////
//    $f2 = new File("test.jpg");
//    echo $f2;
//    if($f2->fileCreate("c:\users\user\desktop"))
//        echo "file create",br;
//    else 
//        echo "file exists",br;
//    
//        if($f2->exists())
//        echo "file exists",br;
//    else 
//        echo "file not exists",br;
//    
/////////////////////////////////////////////////////////////       
//    $f1 = new File("1.jpg");
//    echo $f1;
//    if($f1->exists())
//        echo "file exists",br;
//    else 
//        echo "file not exists",br;
//    
//    if($f1->rename("temp"))
//        echo "file rename",br;
//    else 
//        echo "file not rename",br; 
//    echo $f1;
    

$flashMessage = requestGet('flash');
$fullDirPath = __DIR__. DIRECTORY_SEPARATOR ."pictures";
$dirPath = "pictures/";
read_files_from_directory($fullDirPath,$dirPath,$pictures);
//var_dump($pictures);
if($_FILES){
    if(!empty($_FILES['data'])){
        $uplFiles =   $_FILES['data'];
        $count = count($uplFiles['tmp_name']);
        $uplCount = 0;
        for($i = 0 ; $i < $count; $i++){
            $file = new UploadedFile($uplFiles['name'][$i],$uplFiles['tmp_name'][$i],$uplFiles['size'][$i]);
            if($file->isImage()){
                if($file->saveUploadedFile($fullDirPath))$uplCount++;
                
            }
        }
    }
    $flashMessage  = ($uplCount==$count)?"Загрузка всех файлов прошла успешно":"Возникли ошибки загрузки";
    header("Location: index.php?flash={$flashMessage}");
}

    
}
catch(Exception $e){
    die($e->getMessage());
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>task 3</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/main.css">
    </head>
    <body>
        <div id="container">
            <b><?=$flashMessage;?></b>
            <h2>Загрузить файлы:</h2>
            <form method="post" enctype="multipart/form-data">
                <input type="file" name="data[]" required multiple/><br>
                <button>Добавить файлы</button>
            </form>


            <?php if(!empty($pictures)):?>
            <table>
                <?php 
                    $i = 0;
                    foreach($pictures as $pic):
                        if ($i % 4 == 0 || $i == 0)echo"<tr>";
                ?>            
                    <td>
                        <div class='pic' style='
                             background:url(<?=$pic;?>) no-repeat;
                             background-size:cover;
                             background-position: center;'
                        ></div></td>
                <?php        
                        $i++;
                        if ($i % 4 == 0) echo"</tr>"; 
                    endforeach;
                ?>
            </table>
            <?php endif;?>
        </div> 
        <br> 
    </body>
</html>