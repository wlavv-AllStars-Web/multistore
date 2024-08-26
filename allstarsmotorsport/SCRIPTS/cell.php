<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/config/settings.inc.php';

function getConn()
{
    return new mysqli(_DB_SERVER_, _DB_USER_, _DB_PASSWD_, _DB_NAME_);
}

$cell = $_GET['cell'];

$sql = "SELECT ps_product.reference AS REFERENCE, ps_product_attribute.reference AS sub_reference, ps_product.housing AS housing, ps_product_attribute.location AS location 
FROM ps_product
LEFT JOIN ps_product_attribute
ON ps_product.id_product = ps_product_attribute.id_product
WHERE ps_product_attribute.location = '" . $cell . "' OR ps_product.housing = '" . $cell . "'";

$conn = getConn();
$result = $conn->query( $sql );

$html= '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>';
$html .= '<table>
<thead>
<tr style="font-weight: bold;padding: 5px 10px;">
<th style="padding: 5px; border: 1px solid lightgrey;">REFERENCE</th>
<th style="padding: 5px; border: 1px solid lightgrey">SUB REFERENCE</th>
<th style="padding: 5px; border: 1px solid lightgrey">HOUSING</th>
<th style="padding: 5px; border: 1px solid lightgrey">LOCATION</th>
</tr>
</thead>
<tbody>';

while ($row = $result->fetch_assoc()){

    /*if( ($row['housing'] != $cell) && ($row['housing'] != '') || ($row['location'] != $cell) && ($row['location'] != '') ){

    }else{*/


        $housing = ($row['location'] == '') ? $row['housing'] : '';

        if(strlen($row['sub_reference']) > 0 && strlen($row['location']) < 1){
            $html .= '<tr onclick="$(this).css(\'background-color\', \'LightGreen\')" style="padding: 5px 10px; background-color: lightgoldenrodyellow;">';
        }else{
            $html .= '<tr onclick="$(this).css(\'background-color\', \'LightGreen\')" style="padding: 5px 10px;">';
        }

        $html .= '<td style="padding: 5px; border: 1px solid lightgrey">' . $row['REFERENCE'] . '</td>';
        $html .= '<td style="padding: 5px; border: 1px solid lightgrey">' . $row['sub_reference'] . '</td>';
        $html .= '<td style="padding: 5px; border: 1px solid lightgrey">' . $housing . '</td>';
        $html .= '<td style="padding: 5px; border: 1px solid lightgrey">' . $row['location'] . '</td>';
        $html .= '</tr>';

    //}
}

echo $html .= '</tbody></table>';
