<?php

include_once "../../config/settings.inc.php";

function getConn()
{
    return new mysqli(_DB_SERVER_, _DB_USER_, _DB_PASSWD_, _DB_NAME_);
}

function getProducts()
{
    $conn = getConn();
    $sql = "SELECT ps_order_detail.id_order, ps_order_detail.product_id, ps_order_detail.product_reference, sum(ps_order_detail.product_quantity) AS quantity_ordered, ps_stock_available.quantity AS stock
        FROM ps_orders 
        LEFT JOIN ps_order_detail
        ON ps_orders.id_order= ps_order_detail.id_order
        LEFT JOIN ps_product
        ON ps_order_detail.product_id= ps_product.id_product
        LEFT JOIN ps_stock_available
        ON ps_order_detail.product_id= ps_stock_available.id_product AND ps_order_detail.product_attribute_id= ps_stock_available.id_product_attribute
        WHERE ps_orders.current_state = 15 AND id_manufacturer = " . $_GET['id_manufacturer'] . " AND ps_stock_available.quantity < 0
        GROUP BY ps_order_detail.product_reference";
        
    $result = $conn->query($sql);

    $products = array();
    
    $html = '<style>table, tr, td{ border: 1px solid #333; padding: 10px;}</style>';
    $html .= '<table style="text-align:center">';
        $html .= '<tr>';
            $html .= '<td>ID Order</td>';
            $html .= '<td>ID Producto</td>';
            $html .= '<td>Referencia</td>';
            $html .= '<td>Encomendada</td>';
            $html .= '<td>Stock</td>';
        $html .= '</tr>';
    if ($result->num_rows > 0) {
        
        while ($row = $result->fetch_assoc()) {
            
            $html .= '<tr>';
                $html .= '<td>' . $row['id_order'] . '</td>';
                $html .= '<td>' . $row['product_id'] . '</td>';
                $html .= '<td>' . $row['product_reference'] . '</td>';
                $html .= '<td>' . $row['quantity_ordered'] . '</td>';
                $html .= '<td>' . $row['stock'] . '</td>';
            $html .= '</tr>';
        }
    }
    
    echo $html .= '</table>';
}

ini_set('max_execution_time', 600);

getProducts($conn);
