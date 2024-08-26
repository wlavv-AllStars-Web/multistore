<?php

include_once "../../config/settings.inc.php";

$year = $_GET['year'];
$month = $_GET['month'];
$periodo = $year.$month;

function getConn()
{
    return new mysqli(_DB_SERVER_, _DB_USER_, _DB_PASSWD_, _DB_NAME_);
}

function getProducts($year, $month)
{
    $conn = getConn();
    $sql = "SELECT ps_product.reference AS reference, ps_product.weight AS weight, ps_product.wholesale_price AS price, ps_bms_procurement_purchase_order_reception_product.qty AS qty, ps_manufacturer.country_code AS country_code, ps_category.nc AS nc  FROM ps_bms_procurement_purchase_order_reception 
    LEFT JOIN ps_bms_procurement_purchase_order_reception_product
    ON ps_bms_procurement_purchase_order_reception.id_bms_procurement_purchase_order_reception  = ps_bms_procurement_purchase_order_reception_product.reception_id  
    LEFT JOIN ps_product
    ON ps_bms_procurement_purchase_order_reception_product.product_id  = ps_product.id_product   
    LEFT JOIN ps_product_attribute
    ON ps_bms_procurement_purchase_order_reception_product.product_attribute_id  = ps_product_attribute.id_product_attribute 
    LEFT JOIN ps_manufacturer
    ON ps_product.id_manufacturer = ps_manufacturer.id_manufacturer 
    LEFT JOIN ps_category
    ON ps_product.id_category_default = ps_category.id_category 
    WHERE ps_bms_procurement_purchase_order_reception.date_add LIKE '" . $year . "-" . $month . "%' AND ps_manufacturer.intrastat = 1";
    $result = $conn->query($sql);

    $products = array();
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    return $products;
}

$products = getProducts($year, $month);

echo 'FLUXO;PERIODO;NIF;REF;NC;PAIS;PORIGEM;REGIAO;CODENT;NATTRA;MODTRA;AERPOR;MASSA;UNSUP;VALEFAC;VALEST;ADQNIF';
    
foreach($products AS $product){
    echo '<br>INTRA-CH;' . $periodo . ';513881387;' . $product['reference'] . ';' . $product['nc'] . ';' . $product['country_code'] . ';' . $product['country_code'] . ';10;EXW;11;3;;' . $product['weight'] . ';' . $product['qty'] . ';' . ($product['price']*$product['qty']) . ';;';
}

