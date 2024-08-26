<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/allstarsmotorsport/SCRIPTS/Helpers/inc.php";

$sql = "SELECT * FROM "._DB_PREFIX_."ukoocompat_criterion_lang WHERE id_ukoocompat_criterion=" . $_POST['id_ukoocompat_criterion'] . " AND id_lang = 2 LIMIT 1";

$conn = getConn();
$result = $conn->query( $sql);

$id_parent = 0;
while ($row = $result->fetch_assoc()){
    $id_parent = $row['id_parent_item'];
}

echo $id_parent;