<?php

/* 
Создать класс Request, который моделирует HTTP запрос - урл, заголовки, тело. 
Отображать данные запроса на странице
 */
class Request{
private $url;    
private $version; 
private $method;
private $headers;
private $body;

public function __construct($url, $method, array  $headers = [], $body = null)
{   
    $this->setUrl($url); 
    $this->version = "1.1";
    $this->setMethod(strtoupper($method));
    $this->headers = $headers;
    $this->body = $body;  
    
}

public function addHeader($name, $value)
{
    if($name !="" && !is_null($value)){
        $this->headers[$name] = $value;
    }
}

public function setMethod($recMethod){
    $methods = ['GET','POST','HEAD','PUT','DELETE','CONNECT','OPTIONS','TRACE'];
    foreach ($methods as $method){
        if($method == $recMethod){
            $this->method = $recMethod;
            return;
        }
    }
    throw new Exception("Uncorrect method");
}

public function setUrl($url){
    if (preg_match('|^http(s)?://([a-z0-9-]+)(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url)){  
          $this->url = $url;  
    }
    else  throw new Exception('URL not valid');
}

public function getMethod()
{
    return $this->method;
}

public function getUrl()
{
    return $this->url;
}

public function getBody()
{
    return $this->body;
}

public function getHeader($key)
{
    if (isset($this->headers[$key])) {
        return $this->headers[$key];
    }
        
    return null;
}



public function __toString() {
    $str = "URL: {$this->url};<br> 
    VERSION: {$this->version};<br>
    METHOD: {$this->method};<br>
    HEADERS:";
    if(!empty($this->headers)){
        foreach($this->headers as $name=>$val){
            $str.= "<br>".$name.": ".$val; 
        }
    }
    else $str.= "null";
    $str .= "<br>BODY: ".(is_null($this->body)? "null" :$this->body).";<br>";  
    return $str;
}

}