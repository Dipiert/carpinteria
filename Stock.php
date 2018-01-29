<?php

$stock = new Stock(null, null, 'Otro...', 9999);
try {
    $stock->validarPost();  
} catch (RuntimeException $e) {
    echo $e->getMessage();
}

class Stock {
    protected $codigo;
    protected $ancho;
    protected $alto;
    protected $tipo;
    protected $maximo;
    protected $dbcon;

    function __construct($ancho, $alto, $tipo, $maximo) {
        $this->codigo = array_key_exists('codigo', $_POST)? $_POST['codigo'] : null;
        $this->ancho = array_key_exists('ancho', $_POST)? $_POST['ancho'] : $ancho;   
        $this->alto = array_key_exists('alto', $_POST)? $_POST['alto'] : $alto;
        $this->tipo =  array_key_exists('tipo', $_POST)? $_POST['tipo'] : $tipo;
        $this->maximo = $maximo;
    }

    function validarPost() {
        $this->verificarCampos();
            if ($this->almacenar($this)){
                echo PHP_EOL . 'Se ha agregado nuevo stock exitosamente.' . PHP_EOL;    
            } else {
                echo PHP_EOL . 'Ha ocurrido un error al insertar un nuevo Stock.' . PHP_EOL;
            }
    }

    function verificarCampos() {
        $camposValidos = true;
        //var_dump($this);
        if (! $this->verificarMedida($this->ancho)) {
            echo "El ancho ingresado no es válido.\n";
            $camposValidos = false;
        }
        if (! $this->verificarMedida($this->alto)) {
            echo "El alto ingresado no es válido.\n";
            $camposValidos = false;   
        }
        if (! $this->tipo) {
            echo "El tipo ingresado no es válido.\n";
            $camposValidos = false;
        }
        if ($this->codigo && $this->codigo < 0) {
            echo "El código debe ser mayor a cero.\n";
            $camposValidos = false;
        }
        return $camposValidos;
    } 

    function verificarMedida($medida) {
        return (is_numeric($medida) && $medida > 0 && $medida < $this->maximo);
    }

    function conectarDB() {
        global $servername, $username, $password;
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
        if (! $this->codigo) $this->codigo = 'NULL';
        if (!$this->dbcon) throw new RuntimeException("Ocurrió un error al intentar conectar la DB");
        if (!$this->seleccionarDB()) throw new RuntimeException("Ocurrió un error al intentar seleccionar la DB");          
        $query = 'INSERT INTO stock (id, alto, ancho, tipo, fecha_carga)
                  VALUES(' . "$this->codigo" . ',
                         ' . "$this->alto" . ',
                         ' . "$this->ancho" . ', 
                         ' . "'$this->tipo'" . ',
                         NULL)';
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

    function setMaximo($maximo) {
        $this->maximo = $maximo;
    }

    function setAncho($ancho) {
        $this->ancho = $ancho;
    }

    function setAlto($alto) {
        $this->alto = $alto;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

}

?>