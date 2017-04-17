

<?php

/* 
 Создать класс File и его наследника UploadedFile 
 * (модель массива который мы получаем при аплоаде с формы).
 *  В UploadedFile добавить методы-хелперы для проверки: 
 * является ли файл картинкой (isImage) , получить размер в Мб,
 *  сохранить на диск. Реализовать загрузку файлов с формы.
 */

class File{
    protected $name;
    protected $type;
    protected $path = null;
    protected $exists = false;
    
    public function __construct($name){
        if(!is_null($arrName = self::checkFileName($name))){
            $this->name = $name;
            $this->type = $arrName[1]; 
        }
        else
            throw new Exception ("Uncorrect filename");
    }
    
   
    public function getFullName(){
        if(!is_null($this->path))
            return $this->path.DIRECTORY_SEPARATOR.$this->name;
        else
            return $this->name;
    }
    
    //переименование с сохранением расширения
    public function rename($name){
        $new_name = $name.".".$this->type;
        if(!is_null($arr_name = self::checkFileName($new_name))){
            //проверяем не существует ли уже файла с таким именем
            if(!is_null($this->path))
                $fullname = $this->path.DIRECTORY_SEPARATOR.$new_name;
            else 
                $fullname = $new_name;
            if(file_exists($fullname)){
                //throw new Exception(" file with this name already exists");
                return false;
            }
            $this->name = $new_name;
            return true;
        }
        return false;
    }

    public function exists(){
        return $this->exists;
    }
    
    
    public function __toString() {
       return "Fullname: {$this->getFullName()}<br>"
       . "Name: $this->name<br>"
       . "Type: $this->type<br>";
    }
    
    public function fileCreate($path){
        if(!$this->exists && is_null($this->path)) {
            $file = $path.DIRECTORY_SEPARATOR.$this->name;
            $f = fopen($file, "w"); 
            //if(!$f) throw new Exception("File not create");
            if(!$f) return false;
            fwrite($f, "");
            fclose ($f);
            $this->exists = true;
            $this->path = $path;
            return true;
        }
        else 
            return false;
    }
    
    
     public static function checkFileName($name){
        $arr_name = explode('.', $name);
        $filename = $arr_name[0];
        $extension = strtolower($arr_name[1]);
        if(!preg_match("@^[a-zA-Z0-9_]{1,250}$@", $filename)) return null;
        if(!preg_match("@^[a-z]{2}[a-z0-9]{1}$@", $extension)) return null;
        return $arr_name;
    }
    
}