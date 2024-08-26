<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/allstarsmotorsport/SCRIPTS/Helpers/inc.php";

$conn = getConn();
$query_delivery = 'SELECT id_country FROM ps_address WHERE id_address=' . $_POST['id_address_delivery'];
$query_invoice = 'SELECT id_country FROM ps_address WHERE id_address=' . $_POST['id_address_invoice'];

$result_delivery = $conn->query($query_delivery);
$result_invoice = $conn->query($query_invoice);
$delivery_data = $result_delivery->fetch_assoc();
$invoice_data = $result_invoice->fetch_assoc();

if( ( ($delivery_data['id_country'] == $invoice_data['id_country']) && ($invoice_data['id_country'] == 8) ) || ( ($_POST['isTheSame']) && ($delivery_data['id_country'] == 8))){
    echo 1;
}else{
    if( ( ($delivery_data['id_country'] == $invoice_data['id_country']) && ($invoice_data['id_country'] == 246) ) || ( ($_POST['isTheSame']) && ($delivery_data['id_country'] == 246))){
        echo 1;
    }else{
        echo 0;
    }
}
