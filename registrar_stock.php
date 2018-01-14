<?php
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once __ROOT__ . '/carpinteria/Stock.php' ; 

$stock = new Stock();
$camposValidos = $stock->verificarCampos($stock->getAncho(), $stock->getAlto(), $stock->getTipo());
if ($camposValidos) {
	$stock->almacenar($stock);
} else {
	die("Los Datos ingresados no son validos");
}

?>