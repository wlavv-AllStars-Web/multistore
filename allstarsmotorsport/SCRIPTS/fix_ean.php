<?php/**
include_once $_SERVER['DOCUMENT_ROOT'] . "/allstarsmotorsport/SCRIPTS/Helpers/inc.php";
$conn = getConn();$query = 'SELECT reference, ean13 FROM ps_product_attribute WHERE LENGTH(ean13) = 12 ';$result = $conn->query($query);
echo '<br>Número de produtos vendidos ' . $result->num_rows;
while ($row = $result->fetch_assoc()) {		$ean = substr($row['ean13'], 0, 12);	if(strlen($ean) == 12){		$even = true;		$esum = 0;		$osum = 0;		for ($i = strlen($ean) - 1; $i >= 0; $i--) {			if ($even) {				$esum += $ean[$i];			} else {				$osum += $ean[$i];			}			$even = !$even;		}		$ean .= (10 - ((3 * $esum + $osum) % 10)) % 10;	}			$update = "UPDATE ps_product_attribute SET ean13 = " . $ean . " WHERE reference='" . $row['reference'] . "'";    $conn->query($update);}**/