<?php

require "Stock.php";
use PHPUnit\Framework\TestCase;

class StockTest extends TestCase
{
    
    private $stock;

    protected function setUp()
    {
        error_reporting(~E_NOTICE);
        $this->stock = new Stock();
    }
    
    public function testCamposValidos()
    {     
        $this->assertEquals(true, $this->stock->verificarCampos(1,2,1));
    }
    
    public function testAnchoDemasiadoGrande()
    {     
        $this->assertEquals(false, $this->stock->verificarCampos(10000,2,1));   
    }

    public function testAnchoNoNumerico()
    {     
        
    }

    public function testTipoVacio()
    {     
        
    }
}
