<?php

include_once "../../../../../config/settings.inc.php";

function getConn()
{
    return new mysqli(_DB_SERVER_, _DB_USER_, _DB_PASSWD_, _DB_NAME_);
}

function getAllFather($id_lang)
{
    $html = '';

    $sql = "SELECT *
        FROM "._DB_PREFIX_."category 
        INNER JOIN "._DB_PREFIX_."category_lang
        ON "._DB_PREFIX_."category_lang.id_category = "._DB_PREFIX_."category.id_category 
        WHERE "._DB_PREFIX_."category.active = 1  AND "._DB_PREFIX_."category_lang.id_lang=" . $id_lang . " AND "._DB_PREFIX_."category.id_parent=2";

    $conn = getConn();
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            $sons = getSons($id_lang, $row['id_category']);

            if( strlen($sons) > 0){
                $html .= '<optgroup style="color:red" label="' . utf8_encode($row['name']) . '">';
                $html .= $sons;
                $html .= '</optgroup>';
            }

        }
    }

    return $html;
}

function getSons($id_lang, $id_parent, $html = '')
{
    $sql = "SELECT *
        FROM "._DB_PREFIX_."category 
        INNER JOIN "._DB_PREFIX_."category_lang
        ON "._DB_PREFIX_."category_lang.id_category = "._DB_PREFIX_."category.id_category 
        INNER JOIN "._DB_PREFIX_."ukoocompat_criterion
        ON "._DB_PREFIX_."ukoocompat_criterion.idCategory = "._DB_PREFIX_."category.id_category 
        WHERE "._DB_PREFIX_."category.active = 1  AND "._DB_PREFIX_."category_lang.id_lang=" . $id_lang . " AND "._DB_PREFIX_."category.id_parent=" . $id_parent;

    $conn = getConn();
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            $sonsHTML = getSons($id_lang, $row['id_category']);

            if(strlen($sonsHTML) > 0) {
                $html .= '<optgroup label="&nbsp;&nbsp;&nbsp;' . utf8_encode($row['name']) . '">';
                $html .= $sonsHTML;
                $html .= '</optgroup>';
            }else{
                if((isset($_POST['id_category'])) && ($_POST['id_category'] == $row['id_category'])){
                    $html .= "<option value='" . $row['id_ukoocompat_criterion'] . "' selected >&nbsp;&nbsp;&nbsp;&nbsp;" . utf8_encode($row['name']) . "</option>";
                }else{
                    $html .= "<option value='" . $row['id_ukoocompat_criterion'] . "' >&nbsp;&nbsp;&nbsp;&nbsp;" . utf8_encode($row['name']) . "</option>";
                }
            }


        }
    }

    return $html;
}


ini_set('max_execution_time', 600);

$id_lang = (int)$_POST['id_lang'];

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

$html='<select name="id_ukoocompat_criterion_select_groups_[5]" id="id_ukoocompat_criterion_select_groups_5">';
$html .= getAllFather($id_lang);
$html .='</select>';

echo $html;