<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/settings.inc.php';

function getConn(){ return new mysqli(_DB_SERVER_, _DB_USER_, _DB_PASSWD_, _DB_NAME_); }

$all = $_POST['all'];
$reference = $_POST['reference'];
$reference_attribute = $_POST['reference_attribute'];

if (empty($all)) $all = 0;

if($all == 'asmGetall'){
    $data = getAllStock();
}else{
    $data = getStockOf($reference, $reference_attribute); 
}

echo json_encode($data);

function getAllStock(){

    $sql = "SELECT ps_product.reference AS reference, ps_product.stock_arrive AS p_stock_arrive, ps_product_attribute.reference AS attribute_reference, ps_product_attribute.stock_arrivepa AS a_stock_arrive, ps_stock_available.quantity AS quantity
            FROM ps_stock_available 
            LEFT JOIN ps_product
            ON ps_stock_available.id_product = ps_product.id_product
            LEFT JOIN ps_product_attribute
            ON ps_stock_available.id_product = ps_product_attribute.id_product AND ps_stock_available.id_product_attribute = ps_product_attribute.id_product_attribute
            WHERE ps_stock_available.id_stock_available > 0";
           
    $conn = getConn();
    $result = $conn->query($sql);

    $rows = array();
    while ($row = $result->fetch_assoc()){
        $rows[] = $row;
    }

    $data['status'] = 'OK';
    $data['data'] = $rows;
    
    return $data;
}

function getStockOf($reference, $reference_attribute){
    
    if($reference_attribute != ''){
        $sql = "SELECT id_product, id_product_attribute FROM ps_product_attribute WHERE reference='" . $reference_attribute . "' GROUP BY reference";
    }else if($reference != ''){
        $sql = "SELECT id_product, 0 AS id_product_attribute FROM ps_product WHERE reference='" . $reference . "'";
    }else{
        return json_encode(['status' => 'INVALID']);
    }

    $conn = getConn();
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    
    $result_stock = $conn->query('SELECT quantity FROM ps_stock_available WHERE id_product = ' . $row['id_product'] . ' AND id_product_attribute = ' . $row['id_product_attribute']);
    $row_stock = $result_stock->fetch_assoc();
    
    $data['status'] = 'OK';
    $data['reference'] = $reference;
    $data['reference_attribute'] = $reference_attribute;
    $data['quantity'] = $row_stock['quantity'];
    
    return $data;
}