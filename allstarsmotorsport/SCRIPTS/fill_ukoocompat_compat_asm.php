<?php

echo 'Sem permissões';
exit;

include_once $_SERVER['DOCUMENT_ROOT'] . "/allstarsmotorsport/SCRIPTS/Helpers/inc.php";

$ids_compats = sql_select_data_to_object("SELECT * FROM ps_ukoocompat_compat GROUP BY id_ukoocompat_compat");

$conn = getConn();

foreach ($ids_compats AS $id_ukoocompat) {

    $compat = array();
    $result = $conn->query( "SELECT * FROM ps_ukoocompat_compat_criterion WHERE id_ukoocompat_compat=" . $id_ukoocompat );

    while ($row = $result->fetch_assoc()){
        $compat['id_filter_value_' . $row['id_ukoocompat_filter']] = $row['id_ukoocompat_criterion'];
        $compat['id_ukoocompat_criterion'] = $row['id_ukoocompat_criterion'];
    }

    if( (isset($compat['id_filter_value_1'])) && (isset($compat['id_filter_value_2'])) && (isset($compat['id_filter_value_3'])) && (isset($compat['id_filter_value_4']))) {
        $conn->query( "INSERT INTO ps_ukoocompat_compat_asm (id_ukoocompat_compat, id_filter_value_1, id_filter_value_2, id_filter_value_3, id_filter_value_4)
                   VALUES (" . $id_ukoocompat . ", " . $compat['id_filter_value_1'] . ", " . $compat['id_filter_value_2'] . ", " . $compat['id_filter_value_3'] . ", " . $compat['id_filter_value_4'] . ");");
    }

    $compat['id_filter_value_1'] = 0;
    $compat['id_filter_value_2'] = 0;
    $compat['id_filter_value_3'] = 0;
    $compat['id_filter_value_4'] = 0;

}