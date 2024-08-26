<?php

include_once "../../config/settings.inc.php";

$id_product = $_POST['id_product'];
$id_attribute = $_POST['id_attribute'];
$link = $_POST['link'];
$imgId = $_POST['imgId'];
// echo $imgId;


if($id_attribute > 0) {
    $conn = new mysqli(_DB_SERVER_, _DB_USER_, _DB_PASSWD_, _DB_NAME_);
    $sql = "SELECT id_product_attribute FROM ps_product_attribute where id_product =" . $id_product;
    $result = $conn->query($sql);
    

    $ids_product_attribute = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            $sql_2 = "SELECT id_product_attribute FROM ps_product_attribute_combination where id_product_attribute =" . $row['id_product_attribute'] . " AND id_attribute=" . $id_attribute;
            $result_2 = $conn->query($sql_2);

            if ($result_2->num_rows > 0) {
                while ($row_2 = $result_2->fetch_assoc()) {
                    $ids_product_attribute[] = $row['id_product_attribute'];
                }
            }

        }
    }

    $ids_product_image = array();
    foreach ($ids_product_attribute AS $id_product_attribute){
        $sql_product_images = "SELECT id_image FROM ps_product_attribute_image where id_product_attribute =" . $id_product_attribute;
        $result_product_images = $conn->query($sql_product_images);
        
        if ($result_product_images->num_rows > 0) {
            while ($row_product_images = $result_product_images->fetch_assoc()) {
                $ids_product_image[] = $row_product_images['id_image'];
            }
        }
    }

    $images = array();
    foreach (array_unique($ids_product_image) AS $id_product_image){
        $sql_images = "SELECT id_image FROM ps_image where id_image =" . $id_product_image . ' ORDER BY position DESC';
        $result_images = $conn->query($sql_images);
        
        if ($result_images->num_rows > 0) {
            while ($row_images = $result_images->fetch_assoc()) {
                $images[$row_images['id_image']] = '/' . $row_images['id_image'] . '-' . $link;
                // echo var_dump($images[$row_images['id_image']]);
            }
        }
    }

    $display = '';

    $html = '<div id="slider_product_images" style="border-top:1px solid #bbb;border-bottom:1px solid #bbb;background-color: #FFFFFF;">';
        $html .= '<ul id="bxslider_images" class="bxslider">';
                $selected = 0;
            // echo var_dump($images);
            
            $selected_image = 0;
            foreach ($images AS $k => $image) {
                
                 $selected = 0;
                if($imgId == $k) $selected_image = $k;
                
                $html .= ' <li id="thumbnail_' . $k . '">';
                $html .= '<img id="thumb_' . $k . '" class="img-fluid product_image ' . $display . '" image_id="' . $k . '" itemprop="image" src="' . $image . '" title="" alt=""/>';
                $html .= '</li>';

                $display = 'display-none';

            }
        $html .= '</ul>';
    $html .= '</div>';
    
    $array = [
        'html' => $html,
        'selected_image' => $imgId,
        'index' => $selected_image
    ];
    
    echo json_encode($array);
}