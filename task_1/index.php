<?php
spl_autoload_register(function($className){
    $filePath = "classes/{$className}.php";
    if(!file_exists($filePath))
        die("File {$filePath} not found!");
    require_once $filePath;
});

define("br", "<br>");

echo "Testing class Fraction",br;
//проба некорректных данных
//$d1 = new Fraction(-222,44.6);
//$d1 = new Fraction(-222,0);
//echo $d1;

//сокращение двоби
$d2 = new Fraction(121,-11);
echo $d2.br;
$d2->reduction();
echo $d2.br;

//суммирование
$d3 = new Fraction(1,2);
$d4 = new Fraction(2,5);
echo Fraction::sum($d3,$d4).br;

//своего рода -разность
$d5 = new Fraction(2,-3);
echo Fraction::sum($d3,$d5).br;

//произведение
echo Fraction::multy($d3,$d4).br;

//деление
echo Fraction::division($d3,$d4).br;

?>



