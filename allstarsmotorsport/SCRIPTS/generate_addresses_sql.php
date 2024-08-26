<?php

echo '<span style="color: red;">Reserved area!</span>';
exit;

include_once $_SERVER['DOCUMENT_ROOT'] . '/config/settings.inc.php';

function getConn()
{
    return new mysqli(_DB_SERVER_, _DB_USER_, _DB_PASSWD_, _DB_NAME_);
}

$conn = getConn();
$result = $conn->query( "SELECT ps_address.* FROM ps_customer JOIN ps_address ON ps_customer.id_customer = ps_address.id_customer WHERE ps_customer.id_default_group > 4 and ps_customer.deleted = 0" );

$basic = "INSERT INTO `psnz_address` (`id_address`, `id_country`, `id_state`, `id_customer`, `id_manufacturer`, `id_supplier`, `id_warehouse`, `alias`, `company`, `lastname`, `firstname`, `address1`, `address2`, `postcode`, `city`, `other`, `phone`, `phone_mobile`, `vat_number`, `dni`, `date_add`, `date_upd`, `active`, `deleted`) VALUES ";
while ($row = $result->fetch_assoc()){

    $terms = $row['id_address'] . ', ';
    $terms .= $row['id_country'] . ', ';
    $terms .= $row['id_state'] . ', ';
    $terms .= $row['id_customer'] . ', ';
    $terms .= $row['id_manufacturer'] . ', ';
    $terms .= $row['id_supplier'] . ', ';
    $terms .= $row['id_warehouse'] . ', ';
    
    $terms .= ' "' . utf8_encode($row['alias']) . '", ';
    $terms .= ' "' . utf8_encode($row['company']) . '", ';
    $terms .= ' "' . utf8_encode($row['lastname']) . '", ';
    $terms .= ' "' . utf8_encode($row['firstname']) . '", ';
    $terms .= ' "' . utf8_encode($row['address1']) . '", ';
    $terms .= ' "' . utf8_encode($row['address2']) . '", ';
    $terms .= ' "' . utf8_encode($row['postcode']) . '", ';
    $terms .= ' "' . utf8_encode($row['city']) . '", ';
    $terms .= ' "' . utf8_encode($row['other']) . '", ';
    $terms .= ' "' . utf8_encode($row['phone']) . '", ';
    $terms .= ' "' . utf8_encode($row['phone_mobile']) . '", ';
    $terms .= ' "' . utf8_encode($row['vat_number']) . '", ';
    $terms .= ' "' . utf8_encode($row['dni']) . '", ';
    $terms .= ' "' . utf8_encode($row['date_add']) . '", ';
    $terms .= ' "' . utf8_encode($row['date_upd']) . '", ';
    
    
    $terms .= $row['active'] . ', ';
    $terms .= $row['deleted'];
    
    echo '<br>' . $sql_query = $basic . '(' . $terms . ');';
}