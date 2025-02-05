<?php

include('../../config/config.inc.php');
include('../../init.php');
include_once _PS_MODULE_DIR_ . "/nacex/nacexWS.php";

$cp = $_POST['cp'];
$shopCodSelected = $_POST['shopCod'];
$nWS = new nacexWS();

$shop_latlong = $nWS->get_Agencia3($cp);
$shop_latlong = $nWS->treatmentXML($shop_latlong, "getAgencia3");
$shop_codigo = $shop_latlong[0];
$shop_lat = $shop_latlong[9];
$shop_lon = $shop_latlong[10];
$agencia = true;
$select_tiendas = $nWS->getSelectShopsValues($shop_codigo, $shop_lat, $shop_lon, $agencia, $shopCodSelected);

$response = '<select id="cpPointsChoices" name="cpPointsChoices">';
$response .= $select_tiendas;
$response .= '</select>';

echo $response;

?>
