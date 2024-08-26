<?php

include_once "../../config/settings.inc.php";

function getConn()
{
    return new mysqli(_DB_SERVER_, _DB_USER_, _DB_PASSWD_, _DB_NAME_);
}
$conn = getConn();

$conn = getConn();
$sql = "SELECT * FROM ps_asm_orders WHERE id=" . $_POST['id'];
$result = $conn->query($sql);
$data = $result->fetch_assoc();

$update = "UPDATE ps_asm_orders SET ordered=1 WHERE id_product=" . $data['id_product'] . ' AND id_product_attribute=' . $data['id_product_attribute'];

$conn->query($update);
return 1;