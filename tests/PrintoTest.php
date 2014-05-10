<?php

namespace Koriym\Printo;

class PrintoTest extends \PHPUnit_Framework_TestCase
{
    protected $Printo;

    protected function setUp()
    {
        parent::setUp();
        $this->printo = new Printo(new Mock\FirstGraph);
    }

    public function testNew()
    {
        $this->assertInstanceOf('\Koriym\Printo\Printo', $this->printo);
    }

    public function testString()
    {
        $actual = (string) $this->printo;
        $this->assertInternalType('string', $actual);
    }

    public function testSetRange()
    {
        $html = (string) (new Printo(new Mock\FirstGraph));
        $htmlArray = (string) (new Printo(new Mock\FirstGraph))->setRange(Printo::RANGE_ALL);
        $this->assertTrue(strlen($htmlArray) > strlen($html));
    }

    public function testSetLinkDistance()
    {
        $html = (string) (new Printo(new Mock\FirstGraph))->setLinkDistance(999);
        $this->assertContains('.linkDistance(999)', $html);
    }

    public function testSetCharge()
    {
        $html = (string) (new Printo(new Mock\FirstGraph))->setCharge(999);
        $this->assertContains('.charge(999)', $html);
    }

    public function testRangeNoArray()
    {
        $html = (string) (new Printo(new Mock\FirstGraph));
        $htmlZero = (string) (new Printo(new Mock\FirstGraph))->setRange(Printo::RANGE_PROPERTY);
        $this->assertTrue(strlen($htmlZero) < strlen($html));
    }

    public function testRangeNonProperty()
    {
        $html = (string) (new Printo(new Mock\FirstGraph));
        $htmlObjectOnly = (string) (new Printo(new Mock\FirstGraph))->setRange(Printo::RANGE_OBJECT_ONLY);
        $this->assertTrue(strlen($htmlObjectOnly) < strlen($html));
    }

    public function testInputArray()
    {
        $html = (string) (new Printo(['a' => ['b' => [1, 2, 3]]]));
        $this->assertContains('"nodes":[{"key":"a","name":"array"},{"key":"b","name":"array"},{"key":0,"name":1},{"key":1,"name":2},{"key":2,"name":3}]', $html);
    }

    public function testFunction()
    {
        $this->assertTrue(function_exists('print_o'));
        ob_start();
        print_o($_SERVER);
        $ob = ob_get_clean();
        $this->assertInternalType('string', $ob);
    }
}
