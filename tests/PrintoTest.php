<?php

namespace Printo;

use DateTime;

class Sample
{
    public $a = 1;
    protected $b;
    private $c;
    
    public function __construct()
    {
        $this->b = new DateTime;
        $this->c = new SampleSub;
    }
    
}

class SampleSub
{
    public $sub1;
    public $sub2;
    public function __construct()
    {
        $this->b = new DateTime;
    }
}

/**
 * Test class for Printo.
 */
class PrintoTest extends \PHPUnit_Framework_TestCase
{
    protected $Printo;

    protected function setUp()
    {
        parent::setUp();
        $this->printo = new Printo(new Sample);
    }

    public function test_New()
    {
        $actual = $this->printo;
        $this->assertInstanceOf('\Printo\Printo', $this->printo);
    }
    
    public function test_toString()
    {
        $actual = (string) $this->printo;
        $this->assertInternalType('string', $actual);
    }
    
}