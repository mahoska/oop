<?php
/*
 5**) Почитать про стек, дек, очередь, список, бинарное дерево, дерево и граф.
 *  Как минимум стек, очередь и список. Попытаться реализовать на пхп 
 */

spl_autoload_register(function($className){
    $filePath = "classes/{$className}.php";
    if(!file_exists($filePath))
        die("File {$filePath} not found!");
    require_once $filePath;
});
define("br", "<br>");

//Stack
echo "Testing Stack:<br>";
$st = new Stack(10);
// пока стек не заполнится
while(!$st->isFull()){
    $val = rand(1,100);
    $st->push($val);
}

echo"<pre>";
print_r($st);
echo"</pre>";

echo"<hr>";

// пока стек не освободится
while($val = $st->pop()){
        echo $val,br;
}

echo"<hr>";
echo br,br;

//Simple Queue
echo "Testing simple Queue:<br>";
$sq = new QueueSimple(10);				
for($i = 0; $i < 5; $i++){       
     $sq->push(rand(-5,20));
}
$sq->show();					
echo "Extruct element: ".$sq->pop(),br;				
$sq->show();

echo"<hr>";
echo br,br;

//Ring Queue
echo "Testing ring Queue:<br>";
$rq = new QueueRing(10);				
for($i = 0; $i < 5; $i++){       
     $rq->push(rand(5,100));
}
$rq->show();					
echo "Extruct element: ".$rq->pop(),br;				
$rq->show();

echo"<hr>";
echo br,br;

//Priority Queue
echo "Testing priority Queue:<br>";
$pq = new QueuePriority(10);				
for($i = 0; $i < 5; $i++){       
     $pq->push(rand(15,50),rand(1,100));
}
$pq->show();					
echo "Extruct element: ".$pq->pop(),br;				
$pq->show();

echo"<hr>";
echo br,br;

//Simple List
echo "Testing Simple List:<br>";
$lst = new SimpleList();
$str ="Hello World!";

$len=strlen($str);
for($i=0; $i<$len; $i++){
	$lst->add($str[$i]);
}
echo $lst,"<br><br>";
$lst->dell();
echo $lst,"<br><br>";


$poz = $lst->search('r');
$lst->insert($poz,222);
echo $lst,"<br><br>";

echo $lst->getCount(),"<br><br>";

$lst->dellPoz($poz);
echo $lst,"<br><br>";

$lst->dellAll();
echo $lst,"<br><br>";