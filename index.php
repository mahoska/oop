<?php
/*
 * 1) вывести список логов(данные из таблицы в бд)
 * 2) под списком форма для двух дробей
 * 3) отправляем форму - проверка, создаем объекты Fraction, складываем
 * 4) сохраняем в базу, редирект на ту же страницу
 * 5) используем Fracture, FractureException, FractureForm
 */
error_reporting(E_ALL);
require_once  "config.php";

spl_autoload_register(function($className) {
    $filePath = "classes/{$className}.php";
    
    if (!file_exists($filePath)) {
        die("file {$filePath} not found");
    }
    
    require_once($filePath);   
});



try {
    $pdo=FractureForm::getInstance();
    // all records
    $log_db = $pdo->selectAll("log");
    $log = [];
    $i = 0;
    foreach ($log_db as $rec){
        $fr1_arr = explode("/",$rec["fracture_1"]);
        $fr1 = new Fracture($fr1_arr[0],$fr1_arr[1]);

        $fr2_arr = explode("/",$rec["fracture_2"]);
        $fr2 = new Fracture($fr2_arr[0],$fr2_arr[1]);

        $sum_arr = explode("/",$rec["summ"]);
        $summ = new Fracture($sum_arr[0],$sum_arr[1]);

        $log[$i++] = ["fracture_1"=>$fr1,"fracture_2"=>$fr2,"summ"=>$summ];
    }
    
    
    //work with form
    $flashMessage = Functions::request($_GET,'flash');
    if($_POST){
        $fr1_n = Functions::request($_POST,'f1_numerator');
        $fr1_d = Functions::request($_POST,'f1_denominator');
        $fr2_n = Functions::request($_POST,'f2_numerator');
        $fr2_d = Functions::request($_POST,'f2_denominator');
        
        if(Functions::isFormValid([$fr1_n,$fr1_d,$fr2_n,$fr2_d])){
            $flashMessage  = "Your request was send";
            $f1_numerator = (int)$fr1_n;
            $f1_denominator = (int)$fr1_d;
            $f2_numerator = (int)$fr2_n;
            $f2_denominator = (int)$fr2_d;
            $f1 = new Fracture($f1_numerator,$f1_denominator);
            $f2 = new Fracture($f2_numerator,$f2_denominator);
            $summ = Fracture::add($f1, $f2);
            $id = $pdo->insert("log",["fracture_1","fracture_2","summ"],["fracture_1"=>$f1,"fracture_2"=>$f2,"summ"=>$summ] );
            if(!$id)
                    throw new PDOException("insert error");
                Functions::redirect("index.php?flash={$flashMessage}");
        }
        else{
            $flashMessage = "Fill the fields";
        }
    }
    
} catch(PDOException $e) {
    $time = date('Y m d H:i:s');
    file_put_contents("errors",  "Connect error($time): ".PHP_EOL.$e->getMessage().PHP_EOL.PHP_EOL, FILE_APPEND);
} catch(FractureException $e) {
    file_put_contents("errors", $e->getFractureMessage(), FILE_APPEND);
} catch(Exception $e) {
    $time = date('Y m d H:i:s');
    file_put_contents("errors", "ERROR_TIME:$time".PHP_EOL.$e->getMessage().PHP_EOL.PHP_EOL, FILE_APPEND);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Fractures</title>
        <link rel="stylesheet" href="styles/main.css">
    </head>
    <body>
    <main>
        
        <h2>Information from database:</h2>
        <?php if(!empty($log)):?>
        <table class="info_table">
            <tr>
		<th>fracture_1</th>
		<th>+</th>
		<th>fracture_2</th>
		<th>=</th>
		<th>summ</th>
            </tr>
            <?php for($i=0,$count=count($log);$i<$count; $i++):?>
            <tr>
                    <td><?=$log[$i]["fracture_1"];?></td>
                    <td>+</td>
                    <td><?=$log[$i]["fracture_2"];?></td>
                    <td>=</td>
                    <td><?=$log[$i]["summ"];?></td>
            </tr>
            <?php endfor;?>
        </table>
        <?php else:?>
            <h4>no records</h4>
        <?php endif;?>
        <br>
        <h3>Enter fractures and count the summa:</h3>
        <b><?=$flashMessage;?></b>
        <form method="post">
            <table class="form_table">
                
		<tr>
			<th></th>
			<th>fracture_1</th>
			<th>fracture_2</th>
		</tr>
		<tr>
			<td>numerator</td>
                        <td>
                            <input type="number" step="1" name="f1_numerator" value="<?=Functions::request($_POST,'f1_numerator');?>"/>
                        </td>
			<td>
                            <input type="number" step="1" name="f2_numerator"value="<?=Functions::request($_POST,'f2_numerator');?>"/>
                        </td>
		</tr>
		<tr>
			<td>denominator</td>
			<td>
                            <input type="number" step="1" min="1" name="f1_denominator" value="<?=Functions::request($_POST,'f1_denominator');?>"/>
                        </td>
			<td>
                            <input type="number" step="1" min="1" name="f2_denominator" value="<?=Functions::request($_POST,'f2_denominator');?>"/>
                        </td>
		</tr>
		<tr>
			<td></td>
                        <td colspan="2"><button>summ</button></td>
		</tr>
        </form>
    </main>
    </body>
</html>
