<?php

class QueueRing{
    private $queue_arr = [];
    private $maxQueueLength;
    
    public function __construct($len){
       $this->maxQueueLength = intval($len);
       
    }
    
    public function push($val){
        if(!$this->isFull())
		$this->queue_arr[] = $val;
    }
    
    public function pop(){
        // Если в очереди есть элементы, 
        // то возвращаем тот, который вошел первым, сдвигаем очередь
        // забрасываем первый "вытолкнутый элемент в конец"
        if(!$this->isEmpty()){
            $first_el = $this->queue_arr[0];
            $temp = [];
            $count = $this->getQueueLength();
            for($i = 1; $i < $count; $i++)
                $temp[] = $this->queue_arr[$i];
            
            $this->queue_arr = $temp;
            $this->queue_arr[] = $first_el;
            
            return $first_el;
        }
        else return null;
            
    }
    
    public function clear(){
        $this->queue_arr = [];
    }
    
    public function isEmpty(){
        return $this->getQueueLength() == 0;
    }
    
    public function isFull(){
        return $this->getQueueLength() == $this->maxQueueLength;
    }
    
     public function getMaxCount(){
        return $this->maxQueueLength;
    }
    
    public function getQueueLength(){
        return count($this->queue_arr);
    }
    
    public function show(){
        foreach ($this->queue_arr as $val)
            echo $val." .. ";
        
        echo "<br>";
    }
}

