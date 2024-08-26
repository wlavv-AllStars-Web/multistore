<?php

include_once "../../../../../config/settings.inc.php";

function getConn()
{
    return new mysqli(_DB_SERVER_, _DB_USER_, _DB_PASSWD_, _DB_NAME_);
}

function getAllCriterionsOf($idCriterion)
{
    $query = 'SELECT id_ukoocompat_compat FROM ps_ukoocompat_compat_criterion WHERE id_ukoocompat_criterion = ' . $idCriterion;

    $conn = getConn();
    $result = $conn->query($query);

    $ids = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) $ids[] = $row['id_ukoocompat_compat'];
    }

    return $ids;
}

function getAllCategoriesOfCriterion($ids)
{
   $query = 'SELECT id_ukoocompat_criterion FROM ps_ukoocompat_compat_criterion WHERE id_ukoocompat_filter=5 AND id_ukoocompat_compat IN (' . implode(',',$ids) . ')';

    $conn = getConn();
    $result = $conn->query($query);

    $idsCategories = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) $idsCategories[] = $row['id_ukoocompat_criterion'];
    }

    return array_unique($idsCategories);
}

function getSons($idFather, $id_lang, $level, $idsCategories, $selected_category){

    $html = '';

    $query = 'SELECT * FROM ps_ukoocompat_criterion 
                INNER JOIN ps_category_lang
                ON ps_category_lang.id_category = ps_ukoocompat_criterion.idCategory
                WHERE id_ukoocompat_filter = 5 AND idCategoryFather = ' . $idFather . '
                AND ps_category_lang.id_lang = ' . $id_lang . '
                ORDER BY name ASC';
    $conn = getConn();
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {

        if($level){
            $sonsHTML = getSons($row['idCategory'], $id_lang, false, $idsCategories, $selected_category);

            if(strlen($sonsHTML) > 0) {
                $html .= '<optgroup label="&nbsp;&nbsp;&nbsp;' . utf8_encode($row['name']) . '">';
                $html .= $sonsHTML;
                $html .= '</optgroup>';
            }
        }else{
            if(in_array($row['id_ukoocompat_criterion'], $idsCategories)) {
                if($row['id_ukoocompat_criterion'] == $selected_category){
                    $html .= "<option selected='selected' value='" . $row['id_ukoocompat_criterion'] . "' >" . utf8_encode($row['name']) . "</option>";
                }else{
                    $html .= "<option value='" . $row['id_ukoocompat_criterion'] . "' >&nbsp;&nbsp;&nbsp;&nbsp;" . utf8_encode($row['name']) . "</option>";
                }
            }
        }
    }

    return $html;
}

ini_set('max_execution_time', 600);

$id_lang = $_POST['id_lang'];
$select_1 = $_POST['select_1'];
$select_2 = $_POST['select_2'];
$select_3 = $_POST['select_3'];
$select_4 = $_POST['select_4'];
$selected_category = $_POST['select_10'];

$ids_select_1 = getAllCriterionsOf($select_1);
$ids_select_2 = getAllCriterionsOf($select_2);
$ids_select_3 = getAllCriterionsOf($select_3);
$ids_select_4 = getAllCriterionsOf($select_4);

$idsSelects =  array_intersect($ids_select_1, $ids_select_2, $ids_select_3, $ids_select_4);

$idsCategories = getAllCategoriesOfCriterion($idsSelects);

$transAll = 'See all';
$transCat = 'Category';

if ($id_lang == 4) {
    $transAll = 'Ver Todo';
    $transCat = 'Categoría';
}

if ($id_lang == 5) {
    $transAll = 'Tout voir';
    $transCat = 'Catégorie';
}

$html=  '<div class="ukoocompat_search_block_filter_filter">';
$html.= '<select id="ukoocompat_select_10" name="filters10" data-filter-id="10" class="form-control-2 dynamic_criteria">';
$html.= '<option style="font-weight: bold;color: white; background: #dd170e" value="all" selected="selected">' . $transAll . '</option>';
$html.= '<option value=""></option>';

$queryFather = 'SELECT * FROM ps_ukoocompat_criterion 
                INNER JOIN ps_category_lang
                ON ps_category_lang.id_category = ps_ukoocompat_criterion.idCategory
                WHERE id_ukoocompat_filter = 5 
                AND idCategoryFather = 2
                AND ps_category_lang.id_lang = ' . $id_lang . '
                ORDER BY name ASC';

$conn = getConn();
$resultFather = $conn->query($queryFather);

while ($rowFathers = $resultFather->fetch_assoc()) {

    $sonsHTML = getSons($rowFathers['idCategory'], $id_lang, true, $idsCategories, $selected_category);
    if(strlen($sonsHTML) > 0) {
        $html .= '<optgroup style="color:red" label="' . utf8_encode($rowFathers['name']) . '">';
        $html .= $sonsHTML;
        $html .= '</optgroup>';
    }
}

echo $html .='</select></div>';