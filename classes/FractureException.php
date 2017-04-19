<?php

class FractureException extends Exception
{
    private $time;

    public function getFractureMessage(){
        $this->time = date('Y m d H:i:s');
        $mes = "Catched Fracture exception:".PHP_EOL;
        $mes .= "TIME_ERROR: ".$this->time.PHP_EOL;
        $mes .= "DESCRIPTION: ".parent::getMessage().PHP_EOL.PHP_EOL;
        return $mes;
    }
}
