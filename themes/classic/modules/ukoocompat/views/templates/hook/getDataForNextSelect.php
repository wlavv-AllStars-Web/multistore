<?php

$path = $_SERVER['DOCUMENT_ROOT'] . "/allstarsmotorsport/SCRIPTS/Helpers/inc.php";
include_once $path;
ini_set('max_execution_time', 600);

$select_1 = (int)$_POST['select_1'];
$select_2 = (int)$_POST['select_2'];
$select_3 = (int)$_POST['select_3'];
$nextSelect = (int)$_POST['nextSelect'];
$id_lang = (int)$_POST['id_lang'];

if($nextSelect == 2) $id_parent_item = $select_1;
if($nextSelect == 3) $id_parent_item = $select_2;
if($nextSelect == 4) $id_parent_item = $select_3;

$sql = "SELECT eu_ukoocompat_criterion_lang.id_ukoocompat_criterion, eu_ukoocompat_criterion_lang.value 
        FROM eu_ukoocompat_criterion 
        INNER JOIN eu_ukoocompat_criterion_lang
        ON eu_ukoocompat_criterion_lang.id_ukoocompat_criterion = eu_ukoocompat_criterion.id_ukoocompat_criterion 
        WHERE id_ukoocompat_filter = " .  $nextSelect . " AND id_lang=" . $id_lang . " AND id_parent_item=" . $id_parent_item . " GROUP BY id_ukoocompat_criterion ORDER BY eu_ukoocompat_criterion_lang.value";

$conn = getConn();

$result = $conn->query($sql);

$count = 0;

$html='<select name="id_ukoocompat_criterion_select_groups_[' . $nextSelect . ']" id="id_ukoocompat_criterion_select_groups_' . $nextSelect . '" onchange="call_ajax_fill_selects(' . $nextSelect . ')">';
$html.='<option value="0">Todas</option>';
// echo '<pre>'.print_r( $result->fetch_assoc(),1).'</pre>';
// exit;
while ($row = $result->fetch_assoc()) {
    $html.='<option value="' . $row['id_ukoocompat_criterion'] . '">' . $row['value'] . '</option>';
    $count+=1;
}
$html.='</select>';
    
if($count > 0){
    echo $html;    
}else{
    echo '<div style="padding: 7px 0;" name="id_ukoocompat_criterion_select_groups_[' . $nextSelect . ']" id="id_ukoocompat_criterion_select_groups_' . $nextSelect . '">Error loading! - ' . $select_1 . ' | ' . $select_2 . ' | ' . $select_3 . ' | ' . $nextSelect . '</div>';
}
