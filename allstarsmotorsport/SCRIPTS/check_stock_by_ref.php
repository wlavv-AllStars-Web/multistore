<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/allstarsmotorsport/SCRIPTS/Helpers/inc.php";

$conn = getConn();
$sql = 'Select count(reference) AS total, reference, id_product FROM ps_product GROUP BY reference ORDER BY id_product';
$result = $conn->query($sql);

$references = [];
while ($row = $result->fetch_assoc()) {
    if($row['total'] > 1) $references[] = '"' .$row['reference'] . '"';
}

$sql = 'Select id_product, reference, housing FROM ps_product WHERE reference IN (' . implode(',', $references) . ') ORDER BY reference';
$result = $conn->query($sql);

$reference = '';
while ($row = $result->fetch_assoc()) {

    if(($row['reference'] != $reference) && (strlen($row['housing']) > 1))echo '<br>';

    $sql_quantity = 'Select * FROM ps_stock_available WHERE id_product =' . $row['id_product'] . ' ORDER BY id_product';
    $result_quantity = $conn->query($sql_quantity);

    while ($row_quantity = $result_quantity->fetch_assoc()) {
        if($row_quantity['id_product_attribute'] == 0) {

            if(strlen($row['housing']) > 1) {
                echo '<br><b>' . $row['housing'] . ' | ' . $row['reference'] . ' | ' . $row_quantity['id_product'] . ': ' . $row_quantity['quantity'] . '</b>';
            }
        }else{
            echo '<br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp' . $row['reference'] . ' | ' . $row_quantity['id_product'] . ' | ' . $row_quantity['id_product_attribute'] . ': ' . $row_quantity['quantity'];
        }
    }

    $reference = $row['reference'];
}
