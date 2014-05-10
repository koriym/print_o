<?php

namespace Koriym\Printo\Mock;

class Dependency
{
    public $a1 = 1;
    public $a2 = 2.1;
    public $a3 = 'hello';
    public $global;
    protected $time;
    private $server;
    private $array = ['key1' => 0];

    public function __construct()
    {
        $this->time = new \DateTime;
        $this->server = $_SERVER;
        $this->global = $GLOBALS;
        $this->array[] = ['key2' => [1, 2]];
    }
}
