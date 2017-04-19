<?php

class Fracture
{
    public $numerator;
    public $denominator;
    
    public function __construct($numerator, $denominator)
    {
        $this->numerator = (int) $numerator;
        
        if ($denominator == 0) {
            throw new FractureException("Division by zero");
        }
        
        $this->denominator = (int) $denominator;
        
        //для удобства дальнейшего вывода оставляем знак в числителе
        //или если два числа отриц - сокращаем знак
        if($numerator<0 && $denominator<0 || $numerator>0 && $denominator<0){
            $this->numerator = -$this->numerator;
            $this->denominator = -$this->denominator;
        }
        
        //$this->reduction();
    }
    
    public function getDecimal()
    {
        return $this->numerator / $this->denominator;
    }
    
    public function multiplyBy($number)
    {
        $this->numerator *= $number;
        $this->denominator *= $number;   
    }
    
    public function __toString()
    {
        return "{$this->numerator}/{$this->denominator}";
    }
    
    public static function add(Fracture $f1, Fracture $f2)
    {
        $f1Temp = clone $f1;
        $f2Temp = clone $f2;
        
        $f1Temp->multiplyBy($f2->denominator);
        $f2Temp->multiplyBy($f1->denominator);
        
        $numerator = $f1Temp->numerator + $f2Temp->numerator;
        $temp =  new Fracture($numerator, $f1Temp->denominator);
        $temp->reduction();
        return $temp;
    }
    
    public function reduction(){
        $nod = Algorithm::Euclids_algorithm(abs($this->numerator),abs($this->denominator));
        if($nod!=0){
            $this->numerator /= $nod;
            $this->denominator /= $nod;
        } 
    }
    
    
    
    
}