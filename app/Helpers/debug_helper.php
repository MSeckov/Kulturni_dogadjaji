<?php
/**
     * little helper for readable var_dump  
     *
    
     */

function pre_dump($object){
    echo '<pre>';
    print_r($object);
    echo '</pre>';
}
/** 
    *for console.log in php
*/ 
function console_log($output) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ')';
    $js_code = '<script>' . $js_code . '</script>';
    echo $js_code;
}