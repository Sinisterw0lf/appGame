<?php
function debug_array($arr)
{
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
}

function clear_xss($var) {
   return trim(htmlspecialchars($var));
}

function clear_xss_array($arrs){
    return $assAR=[];
    foreach ($arrs as $arr) {
        $assAR = htmlspecialchars($arr);
    }
}