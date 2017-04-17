<?php
/* Очереди с приоритетным исключением - элемент добавляется в конец очереди, 
а при извлечении осуществляется самого приоритетного элемента,
который впоследствии удаляется из очереди. 
 */
/*можно создать и ассоц массив - где приоритеты это ключи,
 * но тогда мы не сможем работать с элементами с один приоритетом
 */
class QueuePriority{
    private $queue_arr = [];
    private $prior_arr = [];
    private $maxQueueLength;
    
    public function __construct($len){
       $this->maxQueueLength = intval($len);
       
    }
    
    public function push($val, $pr){
        if(!$this->isFull()){
		$this->queue_arr[] = $val;
                $this->prior_arr[] = $pr;
        }
    }
    
    public function pop(){
       if(!$this->isEmpty()){
            $max_pri = $this->prior_arr[0];
            $pos_pri = 0;
            $count = $this->getQueueLength();
            for($i = 1; $i < $count; $i++)
                if($this->prior_arr[$i]>$max_pri){
                    $max_pri = $this->prior_arr[$i];
                    $pos_pri = $i;
                }
            
            $extruct_el = $this->queue_arr[$pos_pri];
            $temp = [];
            $temp_pri = [];
            for($i = 0; $i < $count; $i++){
                if($i==$pos_pri) continue;
                $temp[] = $this->queue_arr[$i];
                $temp_pri[] = $this->prior_arr[$i];
            }
            $this->queue_arr = $temp;
            $this->prior_arr = $temp_pri;
            
            return $extruct_el;
        }
        else return null;
            
    }
    
    public function clear(){
        $this->queue_arr = [];
        $this->prior_arr = [];
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
        $count = $this->getQueueLength();
        for ($i = 0; $i < $count; $i++)
            echo $this->queue_arr[$i]." - ".$this->prior_arr[$i]."<br>";
        
        echo "<br>";
    }
}

