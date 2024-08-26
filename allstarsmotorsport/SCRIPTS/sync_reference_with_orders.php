<?php

include_once "../../config/settings.inc.php";

function getConn()
{
    return new mysqli(_DB_SERVER_, _DB_USER_, _DB_PASSWD_, _DB_NAME_);
}
function getOrders()
{
    $conn = getConn();
    $sql = "SELECT product_id, product_attribute_id FROM ps_bms_procurement_purchase_order_product where LENGTH(wmean13) < 2 ORDER BY product_id ASC";
    $result = $conn->query($sql);
    $refs = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $refs[] = $row;
        }
    }	
    return $refs;
}
function getEANFromIDs($ids)
{
    $eans = array();
	$conn = getConn();
    foreach ($ids AS $item) {	
        if($item['product_attribute_id'] > 0){						$result = $conn->query("SELECT ean13 FROM ps_product_attribute where id_product_attribute = '" . $item['product_attribute_id'] . "'");            $row = $result->fetch_assoc();
        		}else{			            $result = $conn->query("SELECT ean13 FROM ps_product where id_product = '" . $item['product_id'] . "'");
			$row = $result->fetch_assoc();
        		}		$data = ['product_id' => $item['product_id'], 'product_attribute_id' => $item['product_attribute_id'], 'ean13' => $row['ean13'] ];		$eans[] = $data;    }
    return $eans;
}
function updateOrders($groups)
{
    $conn = getConn();
    foreach ($groups AS $group){
            $update = "UPDATE ps_bms_procurement_purchase_order_product SET wmean13='" . $group['ean13'] . "' WHERE product_id=" . $group['product_id'] . " AND product_attribute_id=" . $group['product_attribute_id'];			$conn->query($update);
    }    return 1;
}
$ids = getOrders();
$eans = getEANFromIDs($ids);
$refs = updateOrders($eans);
