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

// at bootstrap
Printo\Printo::init([
    'assetsPath' => 'file://' . dirname(__DIR__) .  '/gh-pages/assets/',  // cs/js files
    'showProgressive' => false,                                           // true = open one by one, false = at once
    'showSublines' => true,                                               // show 'child' line
    'timeperiod' => 15,                                                   // time
    'attract'=>0.05,
    'repulse'=>2,
    'damping'=>0.55,
    'timeperiod'=>10,
    'wallrepulse'=>10,
    'minSpeed'=>0.15,
    'maxForce'=>0.1,
]);

$obj = new FirstGraph;
//print_r($obj);
print_o($obj);
