<?php

require "Stock.php";

class StockTest extends PHPUnit_Framework_TestCase
{
    private $stock;    

    public function testNoMatches()
    {     
        $stock = new Stock();
        echo $stock;
        //$this->assertEquals([], detectAnagrams('diaper', ['hello', 'world', 'zombies', 'pants']));
    }
    
}
