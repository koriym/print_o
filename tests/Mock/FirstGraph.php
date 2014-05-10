<?php

namespace Koriym\Printo\Mock;

class FirstGraph
{
    private $message;
    protected $array;
    public $dependency;

    public function __construct()
    {
        $this->message = 'Hello, Object graph !';
        $this->array = ['one', 'two', 'three'];
        $this->service = new Dependency;
    }
}
