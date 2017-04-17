<?php

function getRecords($link, $table_name){
    $sql = "SELECT * FROM $table_name";
    $res = mysqli_query($link, $sql);
    $records = [];
    while($row =  mysqli_fetch_assoc($res)){
        $records[] = $row;
    }

    return $records;
}
