<?php

//

require "Stock.php";
use PHPUnit\Framework\TestCase;

class StockTest extends TestCase
{

    private $stock;

    protected function setUp()
    {
        $this->stock = new Stock();
    }
    
    public function testLosCamposDebenSerValidos()
    {           
        $this->assertEquals(true, $this->stock->verificarCampos(1, 2, 1));
    }
    
    public function testAnchoNoDeberiaSerDemasiadoGrande()
    {     
        $this->assertEquals(false, $this->stock->verificarCampos(10000, 2, 1));   
    }

    public function testAnchoNoDeberiaSerNoNumerico()
    {     
        $this->assertEquals(false, $this->stock->verificarCampos('a', 2, 1));   
    }

    public function testAnchoNoDeberiaSerCero()
    {
        $this->assertEquals(false, $this->stock->verificarCampos(0, 2, 1));
    }

    public function testAnchoDeberiaSerNumerico()
    {
        $this->assertEquals(true,$this->stock->verificarCampos(500, 2, 1));
    }

    public function testAnchoDeberiaSerMayorACero()
    {
        $this->assertEquals(true, $this->stock->verificarCampos(1, 2, 1));
    }

    public function testAltoNoDeberiaSerDemasiadoGrande()
    {
        $this->assertEquals(false, $this->stock->verificarCampos(1, 10000, 1));
    }

    public function testAltoNoDeberiaSerNoNumerico()
    {     
        $this->assertEquals(false, $this->stock->verificarCampos(1, 'b', 1));   
    }    

    public function testAltoNoDeberiaSerCero()
    {
        $this->assertEquals(false, $this->stock->verificarCampos(1, 0, 1));
    }

    public function testAltoDeberiaSerNumerico()
    {
        $this->assertEquals(true,$this->stock->verificarCampos(500, 2, 1));
    }    

    public function testAltoDeberiaSerMayorACero()
    {
        $this->assertEquals(true, $this->stock->verificarCampos(1, 2, 1));
    }

    public function testTipoNoDeberiaSerVacio()
    {
        $this->assertEquals(false, $this->stock->verificarCampos(1, 2,''));        
    }

    public function testTipoNoDeberiaSerNulo()
    {
        $this->assertEquals(false, $this->stock->verificarCampos(1, 2, NULL));
    }

    public function testTipoDeberiaSerNoVacio() 
    {
        $this->assertEquals(true, $this->stock->verificarCampos(1, 2, 'Otro...'));   
    }

}
