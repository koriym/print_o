<?php
/**
 * This file is part of the koriym/printo package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Koriym\Printo\Mock;

class FirstGraph
{
    public $dependency;
    protected $array;
    private $message;

    public function __construct()
    {
        $this->message = 'Hello, Object graph !';
        $this->array = ['one', 'two', 'three'];
        $this->service = new Dependency;
    }
}
