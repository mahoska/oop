<?php

class UploadedFile extends File{
    private $size;
    private $tmp_name;
    private static $count = 0;//для формирования уникального имени ф-ла
    
    public function __construct($name, $tmp_name, $size) {
        //проверяем загружен ли файл
        if(!is_uploaded_file($tmp_name))
            throw new Exception("данный файл не загружен при помощи HTTP POST");
        
        parent::__construct($name);
        $this->size = $size;
        $this->tmp_name = $tmp_name;
        self::$count++;
    }
    
    
    
    public function getSize(){
        //если этот файл не существует
       if(!$this->exists) return 0;
       //bite
       $this->size = filesize($this->getFullName());
       //Mb
       $this->size /= pow(1024,2);
       $this->size = round($this->size,1);  
    }
    
    public function isImage(){
        $filePermissibleType = ['jpg','png','gif','bmp']; 
        $flagIsImage = false;
        foreach($filePermissibleType as $imgtype){
            //echo $imgtype;
            if(strcasecmp($imgtype, $this->type)== 0) {
                $flagIsImage = true;
                break;
            }
        }
        return $flagIsImage;
    }
    
    public function saveUploadedFile($pathTo){
        $is_upl = false;
        //файл успешно загружен, перемещаем его в текущий каталог
        $new_file_name = $pathTo.DIRECTORY_SEPARATOR."pic".time().self::$count .".".$this->type;
        echo $new_file_name,"<br>";
        if(move_uploaded_file($this->tmp_name, $new_file_name )){
            echo "Файл {$new_file_name} успешно загружен<br>";
            $is_upl = true;
        }
        else 
            echo "Файл не удалось загрузить<br>";
        
        return $is_upl;
    }
    
    public function __toString() {
       $about = parent::__toString();
       return $about."Size: {$this->size} Mb<br>";
    }
    
    public function __clone() {
        self::$count++;
    }
    
    public function __destruct() {
        //self::$count--;
    }
}

