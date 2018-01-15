<?php

class Stock {
	protected $ancho;
	protected $alto;
	protected $tipo;
	protected $maximo;
	protected $dbcon;

	function __construct() {
		$this->ancho = $_POST['ancho']? $_POST['ancho'] : 0;	
		$this->alto = $_POST['alto']? $_POST['alto'] : 0;
		$this->tipo =  $_POST['tipo']? $_POST['tipo'] : 'Otro...';
		$this->maximo = 9999;
	}

	function verificarCampos($ancho, $alto, $tipo) {
		return ($this->verificarMedida($ancho) && $this->verificarMedida($alto) && $tipo);
	} 

	function verificarMedida($medida) {
		return (is_numeric($medida) && $medida > 0 && $medida < $this->maximo);
	}

	function conectarDB() {
		global $servername, $username, $password, $dbname;
		require 'db_config.php' ;	
		$this->dbcon = mysqli_connect($servername, $username, $password)or die("Ocurrió un error al intentar conectar a la DB");
		mysqli_select_db($this->dbcon, $dbname)or die("Ocurrió un error al intentar seleccionar la DB");
	}
	function almacenar($stock) {
		$this->conectarDB();
		$query = 'INSERT INTO stock (id, alto, ancho, tipo, fecha_carga)
				  VALUES(NULL, ' . "$this->alto, $this->ancho, '$this->tipo', " . 'NULL)';
		mysqli_query($this->dbcon, $query);
		echo 'Se ha agregado nuevo stock exitosamente.';
	}

	function getAncho() {
		return $this->ancho;
	}

	function getAlto() {
		return $this->alto;
	}

	function getTipo() {
		return $this->tipo;
	}
}

?>