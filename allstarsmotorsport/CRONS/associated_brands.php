<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/allstarsmotorsport/SCRIPTS/Helpers/inc.php";

$conn = getConn();
$result = $conn->query( "SELECT id_product, associatedProduct FROM ps_product WHERE associatedProduct <> ''" );

while ($row = $result->fetch_assoc()){
    
    $brands = explode(';', $row['associatedProduct']);

    if(count($brands) > 1){
        
        foreach($brands AS $brand){

            if($brand !=''){
                
                $result_product = $conn->query( 'SELECT id_product FROM `ps_product` WHERE id_manufacturer = ' . $brand );
        
                while ($product = $result_product->fetch_assoc()){
                    
                    $product_acessory = $conn->query('SELECT * FROM `ps_accessory` WHERE id_product_1 = ' . $product['id_product'] . " AND id_product_2=" . $row['id_product'] );
                    $row_acessory = $product_acessory->fetch_assoc();
        
                    if(!isset($row_acessory['id_product_2'])) $conn->query( "INSERT INTO `ps_accessory`(`id_product_1`, `id_product_2`) VALUES (" . $product['id_product'] . "," . $row['id_product'] . ")" );
                }
            }
        }
    }else{
        
        $result_product = $conn->query( 'SELECT id_product FROM `ps_product` WHERE id_manufacturer = ' . $row['associatedProduct'] );

        while ($product = $result_product->fetch_assoc()){
    
            $product_acessory = $conn->query('SELECT * FROM `ps_accessory` WHERE id_product_1 = ' . $product['id_product'] . " AND id_product_2=" . $row['id_product'] );
            $row_acessory = $product_acessory->fetch_assoc();

            if(!isset($row_acessory['id_product_2'])){
            
                $conn->query( "INSERT INTO `ps_accessory`(`id_product_1`, `id_product_2`) VALUES (" . $product['id_product'] . "," . $row['id_product'] . ")" );
            }
        }
    }
}

$to      = 'bruno.fernandes.asm@gmail.com';
$subject = 'ASM - Associated brands';
$message = 'ASM - Associated brands';
$headers = 'From: webmaster@all-stars-motorsport.com' . "\r\n" .
    'Reply-To: webmaster@all-stars-motorsport.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);

echo 'Associated brands sync at: ' . date('Y-m-d h:s');
exit;