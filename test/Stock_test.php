<?php

require "Stock.php";
use PHPUnit\Framework\TestCase;

class StockTest extends TestCase
{

    private $stock;
    private $min;
    private $max;

    protected function setUp() {
        $this->setRandomGenerationRange();
        $this->inicializarStockValido();        
    }

    private function setRandomGenerationRange() {
        $this->min = 1;
        $this->max = 9998;
    }

    private function inicializarStockValido() {
        $_POST['codigo'] = intval(rand($this->min, $this->max));
        $ancho = intval(rand($this->min, $this->max));
        $alto = intval(rand($this->min, $this->max));
        $tipo = 'Otro..';
        $maximo = max([$ancho, $alto]) + 1;        
        $this->stock = new Stock($ancho, $alto, $tipo, $maximo);
    }

    private function areValidos($are) {
        $this->assertEquals($are, $this->stock->verificarCampos());
    }
    
    public function testLosCamposDebenSerValidos()
    {           
        //$this->markTestSkipped();
        $this->areValidos(true);
    }
    
    public function testAnchoNoDeberiaSerDemasiadoGrande()
    {   
        //$this->markTestSkipped();
        $this->stock->setMaximo($this->stock->getAncho());
        $this->areValidos(false);
        $this->inicializarStockValido();           
    }

    public function testAnchoNoDeberiaSerNoNumerico()
    {   
        //$this->markTestSkipped();
        $this->stock->setAncho('a');
        $this->areValidos(false); 
        $this->inicializarStockValido();
    }

    public function testAnchoNoDeberiaSerCero()
    {
        //$this->markTestSkipped();
        $this->stock->setAncho(0);
        $this->areValidos(false);
        $this->inicializarStockValido();        
    }

    public function testAltoNoDeberiaSerDemasiadoGrande()
    {
        //$this->markTestSkipped();
        $this->stock->setMaximo($this->stock->getAlto());
        $this->areValidos(false);
        $this->inicializarStockValido();        
    }

    public function testAltoNoDeberiaSerNoNumerico()
    {     
        //$this->markTestSkipped();
        $this->stock->setAlto('b');
        $this->areValidos(false);
        $this->inicializarStockValido();
    }    

    public function testAltoNoDeberiaSerCero()
    {
        //$this->markTestSkipped();
        $this->stock->setAlto(0);
        $this->areValidos(false);        
        $this->inicializarStockValido();
    }

    public function testTipoNoDeberiaSerVacio()
    {
        //$this->markTestSkipped();
        $this->stock->setTipo('');
        $this->areValidos(false);
        $this->inicializarStockValido();                
    }

    public function testTipoNoDeberiaSerNulo()
    {
        //$this->markTestSkipped();
        $this->stock->setTipo(NULL);     
        $this->areValidos(false);  
        $this->inicializarStockValido();      
    }

    public function testDeberíaConectarseALaDB()
    {        
        //$this->markTestSkipped();
        $this->stock->conectarDB();
        $this->assertNotNull($this->stock->getDBCon());
        $this->assertEquals(true, $this->stock->seleccionarDB());
    }

    public function testDeberiaTratarElFormRegistroStock() { 
        //$this->markTestSkipped();       
        $exception = null;
        $exception = $this->stock->validarPost();
        $this->assertEquals(null, $exception);   
    }

    public function testCodigoDebeSerMayorACero() {
        //$this->markTestSkipped();
        $this->stock->setCodigo(-1);
        $this->areValidos(false);
        $this->inicializarStockValido();
    }
    public function testNoDeberiaAlmacenarStocksErroneos() {
        //$this->markTestSkipped();
        $this->stock->setCodigo(-2);  
        try {
            $this->stock->validarPost();
            $this->assertTrue(false);
        }
        catch(RuntimeException $e) {
            $this->assertTrue(true);
        }
    }

}
