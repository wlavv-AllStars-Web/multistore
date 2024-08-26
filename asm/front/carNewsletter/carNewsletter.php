<?php
include_once $_SERVER['DOCUMENT_ROOT'] .'/config/settings.inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/asm/includes/database.php';


$id_brand = $_POST['id_brand'];
$id_model = $_POST['id_model'];
$id_type = $_POST['id_type'];
$id_version = $_POST['id_version'];
$id_customer = $_POST['id_customer'];
$email = $_POST['email'];
$brand = $_POST['brand'];
$model = $_POST['model'];
$type = $_POST['type'];
$version = $_POST['version'];
$iso_code = $_POST['iso_code'];



$conn = getConn();

if($id_customer == 0){
    
    $sql_customer = "SELECT id_customer FROM "._DB_PREFIX_."customer WHERE email='".$email."'";
    $result = $conn->query( $sql_customer );
    $row = $result->fetch_assoc();
    
    $id_customer = $row['id_customer']+0;
}

$sql = "INSERT INTO "._DB_PREFIX_."ASM_ukoo_customer(`id_customer`, `id_brand`, `id_model`, `id_type`, `id_version`, `email`, `brand`, `model`, `type`, `version`, `iso_code`) VALUES (".$id_customer.",".$id_brand.",".$id_model.",".$id_type.",".$id_version.",'".$email."','".$brand."','".$model."','".$type."','".$version."','".$iso_code."')";

$result = $conn->query( $sql );

echo 1;