<?php

$stock = new Stock(null, null, 'Otro...', 9999);
try {
    $stock->validarPost();  
} catch (RuntimeException $e) {
    echo $e->getMessage();
}

class Stock {
    protected $ancho;
    protected $alto;
    protected $tipo;
    protected $maximo;
    protected $dbcon;

    function __construct($ancho, $alto, $tipo, $maximo) {
        $this->ancho = $_POST['ancho']? $_POST['ancho'] : $ancho;   
        $this->alto = $_POST['alto']? $_POST['alto'] : $alto;
        $this->tipo =  $_POST['tipo']? $_POST['tipo'] : $tipo;//'Otro...';
        $this->maximo = $maximo;
    }

    function validarPost() {
        $camposValidos = $this->verificarCampos($this->getAncho(),
            $this->getAlto(),
            $this->getTipo()
        );
        if ($camposValidos) {
            if ($this->almacenar($this)){
                echo 'Se ha agregado nuevo stock exitosamente.';    
            } else {
                echo 'Ha ocurrido un error al insertar un nuevo Stock';
            }
        } else {
            throw new RuntimeException("Los Datos ingresados no son validos");
        }
    }

    function verificarCampos($ancho, $alto, $tipo) {
        return ($this->verificarMedida($ancho) && $this->verificarMedida($alto) && $tipo);
    } 

    function verificarMedida($medida) {
        return (is_numeric($medida) && $medida > 0 && $medida < $this->maximo);
    }

    function conectarDB() {
        global $servername, $username, $password;// $dbname;
        require 'db_config.php';    
        $this->dbcon = mysqli_connect($servername, $username, $password);
    }
     
    function seleccionarDB() {
        global $dbname;
        require 'db_config.php';
        return mysqli_select_db($this->dbcon, $dbname);
    } 
        
    function almacenar($stock) {        
        $this->conectarDB();
        if (!$this->dbcon) throw new RuntimeException("Ocurrió un error al intentar conectar la DB");
        if (!$this->seleccionarDB()) throw new RuntimeException("Ocurrió un error al intentar seleccionar la DB");          
        $query = 'INSERT INTO stock (id, alto, ancho, tipo, fecha_carga)
                  VALUES(NULL, ' . "$this->alto, $this->ancho, '$this->tipo', " . 'NULL)';
        return mysqli_query($this->dbcon, $query);      
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

    function getDBCon() {
        return $this->dbcon;
    }
}

?>