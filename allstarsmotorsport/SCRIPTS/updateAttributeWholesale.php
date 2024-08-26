<?php

include_once "../../config/settings.inc.php";

function getConn()
{
    return new mysqli(_DB_SERVER_, _DB_USER_, _DB_PASSWD_, _DB_NAME_);
}

$conn = getConn();
$sql = "SELECT id_product_attribute, id_product FROM ps_product_attribute WHERE wholesale_price = '0' AND wholesale_price_pound = '0' AND wholesale_price_dollar = '0'";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    
    $sql_product = "SELECT id_manufacturer, wholesale_price, wholesale_price_pound, wholesale_price_dollar FROM ps_product WHERE id_product=" . $row['id_product'] . " LIMIT 1";
    
    $result_product = $conn->query($sql_product);
    
    $row_product = $result_product->fetch_assoc();
    
    $id_manufacturer = $row_product['id_manufacturer'];
    
    if (($id_manufacturer == 17) || ($id_manufacturer == 19) || ($id_manufacturer == 65) || ($id_manufacturer == 78) || ($id_manufacturer == 91) || ($id_manufacturer == 103) || ($id_manufacturer == 110) ) {
        echo '<br>' . $update = "UPDATE ps_product_attribute SET wholesale_price_pound='" . $row_product['wholesale_price_pound'] . "' WHERE id_product_attribute=" .  $row['id_product_attribute'] . " AND wholesale_price_pound = '0.000000'";
    }elseif (($id_manufacturer == 105) || ($id_manufacturer == 115) || ($id_manufacturer == 85) || ($id_manufacturer == 111) || ($id_manufacturer == 83) || ($id_manufacturer == 114) || ($id_manufacturer == 67) || ($id_manufacturer == 76) || ($id_manufacturer == 27) || ($id_manufacturer == 74) || ($id_manufacturer == 30) || ($id_manufacturer == 86) || ($id_manufacturer == 51) || ($id_manufacturer == 116) ){
        echo '<br>' . $update = "UPDATE ps_product_attribute SET wholesale_price_dollar='" . $row_product['wholesale_price_dollar'] . "' WHERE id_product_attribute=" .  $row['id_product_attribute'] . " AND wholesale_price_dollar = '0.000000'";
    }else{
        echo '<br>' . $update = "UPDATE ps_product_attribute SET wholesale_price='" . $row_product['wholesale_price'] . "' WHERE id_product_attribute=" .  $row['id_product_attribute'] . " AND wholesale_price = '0.000000'";
    }
    
    $conn->query($update);
}

