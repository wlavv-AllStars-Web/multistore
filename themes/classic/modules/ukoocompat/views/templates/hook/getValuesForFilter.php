<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/allstarsmotorsport/SCRIPTS/Helpers/inc.php";

$sql = "SELECT * FROM eu_ukoocompat_criterion_lang WHERE id_filter=" . ( $_POST['id_filter'] - 1 ) . " AND id_lang = 2";



$conn = getConn();
$result = $conn->query( $sql);


$html = '<select name="id_parent_item" class=" fixed-width-xl" id="id_parent_item">';
while ($row = $result->fetch_assoc()){
    $html .='<option value="' . $row['id_ukoocompat_criterion'] . '">' . $row['value'] . '</option>';
}

$html .= '</select>';


echo $html;