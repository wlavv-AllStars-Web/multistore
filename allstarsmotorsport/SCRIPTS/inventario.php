<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/settings.inc.php';

function getConn()
{
    return new mysqli(_DB_SERVER_, _DB_USER_, _DB_PASSWD_, _DB_NAME_);
}

$sql = "SELECT ps_product_lang.id_product, ps_product_lang.name AS name, ps_product.reference AS reference, ps_product.wholesale_price AS wholesale_price, ps_stock_available.quantity AS quantity, (ps_product.wholesale_price * ps_stock_available.quantity) AS total
        FROM ps_product
        LEFT JOIN ps_product_lang
        ON ps_product.id_product = ps_product_lang.id_product AND ps_product_lang.id_lang = 1
        LEFT JOIN ps_stock_available
        ON ps_product.id_product = ps_stock_available.id_product AND ps_stock_available.id_product_attribute=0
        LEFT JOIN ps_manufacturer_lang
        ON ps_product.id_manufacturer = ps_manufacturer_lang.id_manufacturer AND ps_manufacturer_lang.id_lang=1
        WHERE ps_product.active = 1 AND ps_product.cache_is_pack = 0 AND ps_stock_available.quantity > 0
        GROUP BY ps_product.reference
        ORDER BY ps_product.wholesale_price";

$data = 'nome;reference;price;quantity;total<br>';
$conn = getConn();
$result = $conn->query( $sql );

while ($row = $result->fetch_assoc()){

    $sql_existe_variacao = "SELECT * FROM ps_stock_available WHERE id_product_attribute <> 0 AND id_product=" . $row['id_product'];
    
    $conn = getConn();
    $result_existe_variacao = $conn->query( $sql_existe_variacao );

    if (mysqli_num_rows($result_existe_variacao) > 0) {
        
        $row_existe_variacao = $result_existe_variacao->fetch_assoc();
        
        $sql_variacao = "SELECT ps_product_attribute.id_product AS id_product,  ps_product_attribute.reference AS reference, ps_product.wholesale_price AS wholesale_price, ps_stock_available.quantity AS quantity, (ps_product.wholesale_price * ps_stock_available.quantity) AS total
                        FROM ps_product_attribute
                        LEFT JOIN ps_stock_available
                        ON ps_product_attribute.id_product = ps_stock_available.id_product AND ps_stock_available.id_product_attribute=ps_product_attribute.id_product_attribute
                        LEFT JOIN ps_product
                        ON ps_product_attribute.id_product = ps_product.id_product
                        WHERE ps_product.active = 1 AND ps_stock_available.quantity > 0 AND ps_stock_available.id_product_attribute <> 0 AND ps_stock_available.id_product=" . $row['id_product'] . "
                        GROUP BY ps_product_attribute.wholesale_price";
        
        $conn = getConn();
        $result_variacao = $conn->query( $sql_variacao );

        while ($row_variacao = $result_variacao->fetch_assoc()) {
            $data .= $row['name'] . ';' . $row_variacao['reference'] . ';' . $row_variacao['wholesale_price'] . ';' . $row_variacao['quantity'] . ';' . $row_variacao['total'] . ';<br>';
        }
    }else{
        $data .= $row['name'] . ';' . $row['reference'] . ';' . $row['wholesale_price'] . ';' . $row['quantity'] . ';' . $row['total'] . ';<br>';
    }
    
}

echo '<pre>' . print_r($data, 1) . '</pre>';