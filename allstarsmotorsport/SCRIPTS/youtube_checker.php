<?php

include_once "../../config/settings.inc.php";

function getConn()
{
    return new mysqli(_DB_SERVER_, _DB_USER_, _DB_PASSWD_, _DB_NAME_);
}

function getProducts($conn)
{
    $sql = "SELECT id_product, youtube_1, youtube_2, youtube_3 FROM ps_product where id_product > 0 ORDER BY id_product";
    $result = $conn->query($sql);

    $products = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $product = array();
            $product['id_product'] = $row['id_product'];
            $product['youtube_1'] = $row['youtube_1'];
            $product['youtube_2'] = $row['youtube_2'];
            $product['youtube_3'] = $row['youtube_3'];
            $products[] = $product;
        }
    }
    return $products;
}

function check_video($youtube_code, $product_id, $conn)
{
	if(strlen($youtube_code) > 0){
	    
	    $ch = curl_init('https://www.youtube.com/oembed?url=http://www.youtube.com/watch?v=' . $youtube_code . '&format=json');
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_TIMEOUT,10);
        $output = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

		if ($httpcode != '200') {
		    echo ' - ' . $sql_insert = "INSERT INTO `ps_asm_youtube`(`id_product`, `youtube_code`, `date`) VALUES (" . $product_id . ",'" . $youtube_code . "','" . date('Y-m-d') . "')";
	        $conn->query($sql_insert);
			echo '<div style="color:red;"> PRODUCT_ID:<a href="/fr/downpipe-cata-sport/' . $product_id . '-downpipe-avec-cata-sport-wagner-tuning-pour-honda-civic-type-r-fk2-500001021.html" target="_blank">' . $product_id . '</a> - <a target="__blank" href="https://www.youtube.com/watch?v=' . $youtube_code . '">https://www.youtube.com/watch?v=' . $youtube_code . '</a></div>';
		}
	}
	
}

ini_set('max_execution_time', 600);

$conn = getConn();
$conn->query('DELETE FROM `ps_asm_youtube` WHERE 1');

$products = getProducts($conn);

$youtube_video_code = [];
$youtube_video_code_product_id = [];
foreach ($products AS $product){

    if(!is_null($product['youtube_1']) > 0) {
		$youtube_video_code[] = $product['youtube_1'];
		$youtube_video_code_product_id[] = $product['id_product'];
	}
	
    if(!is_null($product['youtube_2']) > 0) {
		$youtube_video_code[] = $product['youtube_2'];
		$youtube_video_code_product_id[] = $product['id_product'];
	}
	
    if(!is_null($product['youtube_3']) > 0) {
		$youtube_video_code[] = $product['youtube_3'];
		$youtube_video_code_product_id[] = $product['id_product'];
	}
}

$youtube_video_code_unique = array_unique($youtube_video_code);

foreach ($youtube_video_code_unique AS $key => $video_code){
    check_video($video_code, $youtube_video_code_product_id[$key], $conn);
}

echo '<br><br><br>Terminado!';