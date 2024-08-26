<?php

function dd($data, $exit = 0){
    echo '<pre>' . print_r($data, true) . '</pre>';
    if($exit) exit;
}