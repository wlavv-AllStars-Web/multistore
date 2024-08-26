<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/allstarsmotorsport/SCRIPTS/Helpers/inc.php";

/** Número de produtos **/
$conn = getConn();
$resultProducts = $conn->query('Select * FROM ps_product');
echo '<br>Número de produtos ' . $resultProducts->num_rows;

/** Todos os produtos que existem na tabela detalhes encomendas, ou seja que foram vendidos **/
$query = 'SELECT * FROM ps_order_detail GROUP BY product_id';

$soldProducts = '';
$result = $conn->query($query);
echo '<br>Número de produtos vendidos ' . $result->num_rows;

while ($row = $result->fetch_assoc()) $soldProducts.= $row['product_id'] . ', ';

/** Todos os produtos que ainda não foram vendidos **/
$queryNotSold = 'SELECT ps_stock_available.quantity, ps_product.id_product, ps_product_lang.name, ps_product.reference
                 FROM ps_product 
                 JOIN ps_product_lang
                 ON ps_product.id_product = ps_product_lang.id_product
                 JOIN ps_stock_available
                 ON ps_product.id_product = ps_stock_available.id_product
                 WHERE ps_product.id_product NOT IN ( ' . substr($soldProducts, 0, -2 ) . ' ) 
                 AND ps_stock_available.quantity > 0 
                 AND ps_product.active > 0 
                 AND ps_product.visibility <> "none" 
                 GROUP BY ps_product.reference
                 ORDER BY ps_product.id_product';

$resultNotSold = $conn->query($queryNotSold);
echo '<br>Número de produtos nunca vendidos: ' . $resultNotSold->num_rows;
echo '<br>';

while ($rowNotSold = $resultNotSold->fetch_assoc()) {
    echo '<br> (' . $rowNotSold['quantity'] . ') - ' . $rowNotSold['id_product'] . ' - ' . $rowNotSold['name'];

    $queryOthers = 'SELECT count(*) AS others, reference FROM ps_product WHERE reference="' . $rowNotSold['reference'] . '"';
    $conn = getConn();
    $resultOthers = $conn->query($queryOthers);

    if ($resultOthers->num_rows > 0) {
        while ($rowOthers = $resultOthers->fetch_assoc()) {
            if($rowOthers['others'] > 1) {
                echo ' - <span style="font-weight: bold;color:red;">' . $rowOthers['reference'] . '</span>';

                $queryFromOthers = 'SELECT id_product FROM ps_product WHERE reference="' . $rowNotSold['reference'] . '" AND id_product <> ' . $rowNotSold['id_product'];
                $conn = getConn();
                $resultFromOthers = $conn->query($queryFromOthers);

                if ($resultFromOthers->num_rows > 0) {
                    while ($rowFromOthers = $resultFromOthers->fetch_assoc()) {
                        echo '<br>        --------> ' . $rowFromOthers['id_product'];
                    }

                }
            }
        }
    }
}