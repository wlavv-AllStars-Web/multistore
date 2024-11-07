<?php

function pre($array) {
    echo '<pre>' . print_r($array, true) . '</pre>';
    exit;
}