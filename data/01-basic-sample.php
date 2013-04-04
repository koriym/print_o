<?php
require dirname(__DIR__) . '/src.php';

class FirstGraph
{
    public function __construct()
    {
        $this->message = 'Hello, Object graph !';
        $this->data = ['one', 'two', 'three'];
        $this->service = new Service;
    }
}

class Service
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

$obj = new FirstGraph;
//print_r($obj);
print_o($obj);
