<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/settings.inc.php';

function getConn()
{
    return new mysqli(_DB_SERVER_, _DB_USER_, _DB_PASSWD_, _DB_NAME_);
}


$sql = "SELECT id_product_attribute, ean13, reference, COUNT(id_product_attribute) AS total FROM ps_product_attribute GROUP BY REFERENCE ORDER BY total DESC";

$conn = getConn();
$result = $conn->query( $sql );
$subs = array();

while ($row = $result->fetch_assoc()){
    if($row['total'] > 1) $subs[$row['reference']] = $row['ean13'];
}


foreach ($subs AS $k => $sub ){

    $result_2 = $conn->query( "SELECT reference, ean13 FROM ps_product_attribute WHERE reference='" . $k . "'" );

    while ($row_2 = $result_2->fetch_assoc()) echo '<br>' . $row_2['reference'] . ' -> ' . $row_2['ean13'];

    echo '<br><br>';
}

exit;