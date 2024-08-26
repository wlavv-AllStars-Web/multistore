<?php

// include_once $_SERVER['DOCUMENT_ROOT'] .'/config/settings.inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] .'/allstarsmotorsport/SCRIPTS/Helpers/db_functions.php';


// function getConn() { return new mysqli(_DB_SERVER_, _DB_USER_, _DB_PASSWD_, _DB_NAME_); }

function check() { echo 123; }

function dd($data, $exit = 0) { 
    echo '<pre>' . print_r($data, 1) . '</pre>';
    if($exit == 1) exit;
}