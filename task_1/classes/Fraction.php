<?php
/*
1) создать класс Fraction, реализовать метод сокращения дроби, 
вывода дроби на экран, представления в виде десятичной дроби.
Реализовать статические методы для арифметических операций 
( вида multiply(Fraction f1, Fraction f2) ) 
*/
class Fraction{
    private $numerator;
    private $denominator;
    
    public function __construct($numerator = 0 ,$denominator = 1){
        if($this->setNumerator($numerator) && $this->setDenominator($denominator)){
            //для удобства дальнейшего вывода оставляем знак в числителе
            //или если два числа отриц - сокращаем знак
            if($numerator<0 && $denominator<0 || $numerator>0 && $denominator<0){
                $this->numerator = -$this->numerator;
                $this->denominator = -$this->denominator;
            }  
        }
    }
    public function setNumerator($num){
        if(is_int($num)){
            $this->numerator = $num;
            return true;
        }
        else die("Uncorrect numerator");
    }
    
    public function getNumerator(){
        return $this->numerator;
    }
    
    public function setDenominator($num){
        if(is_int($num) && $num != 0){
            $this->denominator = $num;
            return true;
        }
        else die("Uncorrect denumerator");
    }
    
    public function getDenominator(){
        return $this->denominator;
    }
    
    public function reduction(){
        $nod = self::Euclids_algorithm(abs($this->numerator),abs($this->denominator));
        if($nod!=0){
            $this->numerator /= $nod;
            $this->denominator /= $nod;
        } 
    }
       
    public function __toString() {
        if($this->numerator == 0 || $this->denominator == 1) 
            return (string)$this->numerator;
        else 
            return $this->numerator."/".$this->denominator;
    }
    
    //вычитание - тоже сложение, только вторая дробь отрицательная
    //поэтому использую эту же ф-цию: а-в = а+(-в)
    public static function sum(Fraction $d1, Fraction $d2){
      $temp = new Fraction();
      $d1->reduction();//хотя можно и не делать
      $d2->reduction();
      $temp->numerator = $d1->numerator*$d2->denominator+$d2->numerator*$d1->denominator;
      $temp->denominator = $d1->denominator*$d2->denominator;
      $temp->reduction();
      return $temp;
    }

    
    public static function multy(Fraction $d1, Fraction $d2){
        $temp = new Fraction();
        $temp->numerator = $d1->numerator*$d2->numerator;
        $temp->denominator = $d1->denominator*$d2->denominator;
        $temp->reduction();
        return $temp;
    }
    
    public static function division(Fraction $d1, Fraction $d2){
        $temp = new Fraction();
        $temp->numerator = $d1->numerator*$d2->denominator;
        $temp->denominator = $d1->denominator*$d2->numerator;
        $temp->reduction();
        return $temp;
    }
    
    private static function Euclids_algorithm($a,$b){
        while ($a!=0 && $b!=0){
        if ($a > $b)
            $a = $a % $b;
        else
            $b = $b % $a;
        }
 
        return $a+$b;    
    }
    
    
}





/*
 Aлгоритм Евклида позволяет найти нам наибольший общий делитель чисел. 
Как это работает:
Пусть a = 18, b = 30.
Цикл: a!=0 and b!=0
Если a > b, то a = a % b, если меньше, то b = b % a,
таким образом мы сначала находим остаток деления, а потом повторяем действия.
У нас a < b, значит, ищем остаток деления b % a (30 % 18) = 12, 
присваиваем b = 12, повторяем цикл но теперь у нас уже a > b(b = 12)
значит выполняем a % b (18 % 12) = 6? 
снова переходим к циклу, теперь снова b > a, значит выполняем b % a (30 % 6),
остаток от деления 0, на этом мы прекращаем наш цикл и узнаем,
что наибольший общий делитель 18 и 30 = 6. и выводим a + b (b = 0, a = 6). 
 */