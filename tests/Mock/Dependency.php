<?php
/**
 * This file is part of the koriym/printo package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Koriym\Printo\Mock;

class Dependency
{
    public $a1 = 1;
    public $a2 = 2.1;
    public $a3 = 'hello';
    protected $time;
    private $server;
    private $array = ['key1' => 0];

    public function __construct()
    {
        $this->time = new \DateTime;
        $this->server = $_SERVER;
        $this->array[] = ['key2' => [1, 2, new \stdClass()]];
    }
}
