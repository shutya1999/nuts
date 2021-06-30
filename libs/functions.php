<?php
function debug($data, $die = false){
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    if ($die){
        die;
    }
}