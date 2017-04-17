<?php

class Stack{
    //верхняя граница стека
    private $full;
    //массив для хранения данных
    private $stack_arr = [] ;
    
    public function __construct($full){
        $this->full = intval($full);
    }
    
    //добавление элемента
    public function push($val){
        if(!$this->isFull()){
            $this->stack_arr[] = $val;
        }
    }
    
    //извлечение элемента
    public function pop(){
        //последним вошел - первым вышел
        if(!$this->isEmpty()){
            //return array_pop($this->stack_arr);
            //если не использовать станд ф-цию
            $temp = [];
            $count = $this->getCount();
            $last_el = $this->stack_arr[$count-1];
            for($i = 0; $i < $count - 1; $i++){
                $temp[] = $this->stack_arr[$i]; 
            }
            $this->stack_arr = $temp;
            return  $last_el;
        }
        else return null;
    }
    
    //очистка стека
    public function clear(){
        $this->stack_arr = [];
    }
    
    //проверка существования элементов в стеке
    public function isEmpty(){
        return count($this->stack_arr) == 0;
    }
    
    //проверка на переполнение стека
    public function isFull(){
        return count($this->stack_arr) == $this->full;
    }
    
    //количество элементов в стеке
    public function getMaxCount(){
        return $this->full;
    }
    
    //текущее количество элементов в стеке
    public function getCount(){
        return count($this->stack_arr);
    }
}

