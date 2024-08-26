<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/allstarsmotorsport/SCRIPTS/Helpers/inc.php";

$conn = getConn();

/*
$sql = '';
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) { }
*/

echo '<table>';
    echo '<tr>';
        echo '<td style="padding:5px;">DATA</td>';
        echo '<td style="padding:5px;text-align:right">TOTAL</td>';
        echo '<td style="padding:5px;">PAGAMENTO</td>';
        echo '<td style="padding:5px;text-align:center">PRODUTOS</td>';
        echo '<td style="padding:5px;">REFERENCIAS</td>';
        echo '<td style="padding:5px;">TRANSPORTADORA</td>';
    echo '</tr>';
    echo '<tr>';
        echo '<td style="padding:5px;"></td>';
        echo '<td style="padding:5px;text-align:right;"></td>';
        echo '<td style="padding:5px;"></td>';
        echo '<td style="padding:5px;text-align:center;"></td>';
        echo '<td style="padding:5px;"></td>';
        echo '<td style="padding:5px;"></td>';
    echo '</tr>';
echo '</table>';