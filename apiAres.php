<?php
header("Content-Type: application/json; charset=UTF-8");
define('ARES','https://ares.gov.cz/ekonomicke-subjekty-v-be/rest/ekonomicke-subjekty/');
$ico = intval($_REQUEST['ico']);
$file = @file_get_contents(ARES.$ico);

$array = array();
if ($file) {
  $json = json_decode($file);
 
 if (strval($json->ico) == $ico) {
  $array['ico'] 	= strval($json->ico);
  $array['dic'] 	= strval($json->dic);
  $array['firma'] 	= strval($json->obchodniJmeno);
  $array['ulice']	= strval($json->sidlo->nazevUlice).' '.strval($json->sidlo->cisloDomovni);
  $array['mesto']	= strval($json->sidlo->nazevObce);
  $array['psc']	= strval($json->sidlo->psc);
  $array['stat']	= strval($json->sidlo->nazevStatu);
  $array['typ']     = strval($json->pravniForma);
  $array['stav'] 	= 'ok';
 } else
  $array['stav'] 	= 'IČO firmy nebylo nalezeno';
} else
 $array['stav'] 	= 'Databáze ARES není dostupná';
echo json_encode($array);
?>