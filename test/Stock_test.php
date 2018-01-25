<?php

require "Stock.php";
use PHPUnit\Framework\TestCase;

class StockTest extends TestCase
{

    private $stock;
    private $codigo;
    private $ancho;
    private $alto;
    private $tipo;
    private $maximo;
    private $min;
    private $max;

    protected function setUp() {
        $this->min = 1;
        $this->max = 9998;
    }

    private function areValidos($are) {
        $this->stock = new Stock($this->codigo, $this->ancho, $this->alto, $this->tipo, $this->maximo);
        $this->assertEquals($are, $this->stock->verificarCampos());
    }
    
    public function testLosCamposDebenSerValidos()
    {           
        //$this->markTestSkipped();
        $this->codigo = intval(rand($this->min, $this->max));
        $this->ancho = intval(rand($this->min, $this->max));
        $this->alto = intval(rand($this->min, $this->max));
        $this->tipo = 'Otro...';
        $this->maximo = max([$this->ancho, $this->alto]) + 1;
        $this->areValidos(true);
    }
    
    public function testAnchoNoDeberiaSerDemasiadoGrande()
    {   
        //$this->markTestSkipped();
        $this->codigo = intval(rand($this->min, $this->max));
        $this->ancho = intval(rand($this->min, $this->max));
        $this->alto = intval(rand($this->min, $this->max));
        $this->tipo = 'Otro...';
        $this->maximo = $this->ancho;
        $this->areValidos(false);           
    }

    public function testAnchoNoDeberiaSerNoNumerico()
    {   
        //$this->markTestSkipped();  
        $this->codigo = intval(rand($this->min, $this->max));
        $this->ancho = 'a';
        $this->alto = intval(rand($this->min, $this->max));
        $this->tipo = 'Otro...';
        $this->maximo = max([$this->ancho, $this->alto]) + 1;
        $this->areValidos(false); 
    }

    public function testAnchoNoDeberiaSerCero()
    {
        //$this->markTestSkipped();
        $this->codigo = intval(rand($this->min, $this->max));
        $this->ancho = 0;
        $this->alto = intval(rand($this->min, $this->max));
        $this->tipo = 'Otro...';
        $this->maximo = $this->alto + 1;
        $this->areValidos(false);
    }

    public function testAnchoDeberiaSerNumerico()
    {
        //$this->markTestSkipped();
        $this->codigo = intval(rand($this->min, $this->max));
        $this->ancho = intval(rand($this->min, $this->max));
        $this->alto = intval(rand($this->min, $this->max));
        $this->tipo = 'Otro...';
        $this->maximo = max([$this->ancho, $this->alto]) + 1;
        $this->areValidos(true);        
    }

    public function testAnchoDeberiaSerMayorACero()
    {
        //$this->markTestSkipped();
        $this->codigo = intval(rand($this->min, $this->max));
        $this->ancho = intval(rand($this->min, $this->max));
        $this->alto = intval(rand($this->min, $this->max));
        $this->tipo = 'Otro...';
        $this->maximo = max([$this->ancho, $this->alto]) + 1;
        $this->areValidos(true);
    }

    public function testAltoNoDeberiaSerDemasiadoGrande()
    {
        //$this->markTestSkipped();
        $this->codigo = intval(rand($this->min, $this->max));
        $this->ancho = intval(rand($this->min, $this->max));
        $this->alto = intval(rand($this->min, $this->max));
        $this->tipo = 'Otro...';
        $this->maximo = $this->alto;
        $this->areValidos(false);        
    }

    public function testAltoNoDeberiaSerNoNumerico()
    {     
        //$this->markTestSkipped();
        $this->codigo = intval(rand($this->min, $this->max));
        $this->ancho = intval(rand($this->min, $this->max));
        $this->alto = 'b';
        $this->tipo = 'Otro...';
        $this->maximo = max([$this->ancho, $this->alto]) + 1;
        $this->areValidos(false);
    }    

    public function testAltoNoDeberiaSerCero()
    {
        //$this->markTestSkipped();
        $this->codigo = intval(rand($this->min, $this->max)); 
        $this->ancho = intval(rand($this->min, $this->max));
        $this->alto = 0;
        $this->tipo = 'Otro...';
        $this->maximo = max([$this->ancho, $this->alto]) + 1;
        $this->areValidos(false);        
    }

    public function testAltoDeberiaSerNumerico()
    {
        //$this->markTestSkipped();
        $this->codigo = intval(rand($this->min, $this->max));
        $this->ancho = intval(rand($this->min, $this->max));
        $this->alto = intval(rand($this->min, $this->max));
        $this->tipo = 'Otro...';
        $this->maximo = max([$this->ancho, $this->alto]) + 1;
        $this->areValidos(true);
    }    

    public function testAltoDeberiaSerMayorACero()
    {
        //$this->markTestSkipped();
        $this->codigo = intval(rand($this->min, $this->max));
        $this->ancho = intval(rand($this->min, $this->max));
        $this->alto = intval(rand($this->min, $this->max));
        $this->tipo = 'Otro...';
        $this->maximo = max([$this->ancho, $this->alto]) + 1;
        $this->areValidos(true);        
    }

    public function testTipoNoDeberiaSerVacio()
    {
        //$this->markTestSkipped();
        $this->codigo = 1;
        $this->ancho = 1;
        $this->alto = 1;
        $this->tipo = '';
        $this->maximo = 2;
        $this->areValidos(false);                
    }

    public function testTipoNoDeberiaSerNulo()
    {
        //$this->markTestSkipped();
        $this->codigo = 1;
        $this->ancho = 1;
        $this->alto = 1;
        $this->tipo = NULL;
        $this->maximo = 2;
        $this->areValidos(false);        
    }

    public function testTipoDeberiaSerNoVacio() 
    {
        //$this->markTestSkipped();
        $this->codigo = 1;
        $this->ancho = 1;
        $this->alto = 2;
        $this->tipo = 'Otro...';
        $this->maximo = 3;
        $this->areValidos(true);        
    }

    public function testGetters() 
    {
        //$this->markTestSkipped();
        $codigo = 1;
        $ancho = 1;
        $alto = 1;
        $tipo = 'Otro...';
        $maximo = 1;
        $this->stock = new Stock($codigo, $ancho, $alto, $tipo, $maximo);
        $this->assertNotNull($this->stock->getAncho());
        $this->assertNotNull($this->stock->getAlto());
        $this->assertNotNull($this->stock->getTipo());
    }

    public function testDeberíaConectarseALaDB()
    {
        //$this->markTestSkipped();
        $codigo = 1;
        $ancho = 1;
        $alto = 1;
        $tipo = 'Otro...';
        $maximo = 1;
        $this->stock = new Stock($codigo, $ancho, $alto, $tipo, $maximo);
        $this->stock->conectarDB();
        $this->assertNotNull($this->stock->getDBCon());
        $this->assertEquals(true, $this->stock->seleccionarDB());
    }

    public function testDeberiaAlmacenarNuevoStock()
    {
        //$this->markTestSkipped();
        $this->codigo = 1;
        $this->ancho = 1;
        $this->alto = 1;
        $this->tipo = 'Otro...';
        $this->maximo = 2;
        $this->areValidos(true);
    }

    public function testDeberiaTratarElFormRegistroStock() {
        $codigo = 1;
        $ancho = 1;
        $alto = 1;
        $tipo = 'Otro...';
        $maximo = 2;
        $this->stock = new Stock($codigo, $ancho, $alto, $tipo, $maximo);
        $exception = null;
        $exception = $this->stock->validarPost();
        $this->assertEquals(null, $exception);   
    }

    public function testNoDeberiaAlmacenarStocksErroneos() {
        //$this->markTestSkipped();
        $codigo = -1;
        $ancho = 0;
        $alto = 0;
        $tipo = 'Otro...';
        $maximo = 1;
        $stock = new Stock($codigo, $ancho, $alto, $tipo, $maximo);        
        try {
            $stock->validarPost();
        }
        catch(RuntimeException $e) {
            $this->assertTrue(true);
        }
    }

}
