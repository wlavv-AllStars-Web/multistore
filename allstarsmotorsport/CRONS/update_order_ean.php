<?php

include_once "/home/allstar1/public_html/allstarsmotorsport/SCRIPTS/Helpers/inc.php";

$sql="
    SELECT ps_order_detail.id_order, ps_order_detail.product_id, ps_order_detail.product_attribute_id, ps_order_detail.product_ean13 AS order_ean13, ps_product.ean13 AS current_product_ean, ps_product_attribute.ean13 AS current_product_attribute_ean, ps_order_detail.product_attribute_id, ps_product_attribute.id_product
    FROM ps_order_detail 
    LEFT JOIN ps_orders
    ON ps_orders.id_order = ps_order_detail.id_order
    LEFT JOIN ps_product
    ON ps_order_detail.product_id = ps_product.id_product
    LEFT JOIN ps_product_attribute
    ON ps_order_detail.product_id = ps_product_attribute.id_product AND ps_order_detail.product_attribute_id = ps_product_attribute.id_product_attribute
    WHERE ps_orders.date_add > DATE_SUB(NOW(), INTERVAL 100 DAY)";

$conn = getConn();
$result = $conn->query( $sql);

while ($row = $result->fetch_assoc()){

    if($row['product_attribute_id'] != 0){
        if($row['order_ean13'] != $row['current_product_attribute_ean']){
            $update = "UPDATE `ps_order_detail` SET `product_ean13`='" . $row['current_product_attribute_ean'] . "' WHERE id_order=" . $row['id_order'] . " AND product_id=" . $row['product_id'] . " AND product_attribute_id=" . $row['product_attribute_id'];
            $conn->query($update);
        }  
    }else{

        if($row['order_ean13'] != $row['current_product_ean']){
            $update = "UPDATE `ps_order_detail` SET `product_ean13`='" . $row['current_product_ean'] . "' WHERE id_order=" . $row['id_order'] . " AND product_id=" . $row['product_id'] . " AND product_attribute_id=0";
            $conn->query($update);
        }        
    }
}

$to      = 'bruno.fernandes.asm@gmail.com';
$subject = 'ASM - UPDATE order EAN';
$message = 'ASM - UPDATE order EAN';
$headers = 'From: webmaster@all-stars-motorsport.com' . "\r\n" .
    'Reply-To: webmaster@all-stars-motorsport.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);