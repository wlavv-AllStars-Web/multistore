<?php
include_once('../simple_html_dom.php');

echo file_get_html('https://www.google.com/')->plaintext;
?>