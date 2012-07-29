<?php
require dirname(__DIR__) . '/src.php';

class firstPrinto
{
    public function __construct()
    {
        $this->a = new stdClass;
        $this->b = new sub;
        $this->c = ['one', 'two'];
    }
}

class sub
{
    public $a1 = 1;
    public $a2 = 2.1;
    public $a3 = 'hello';
    protected $time;
    private $server;
    
    public function __construct()
    {
        $this->time = new DateTime;
        $this->server = $_SERVER;
    }
}

$obj = new firstPrinto;
print_o($obj);