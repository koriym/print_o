<?php
namespace Printo;

final class Node implements NodeInterface
{
    private $value;
    private $meta = [];

    public function __construct($value, array $meta)
    {
        $this->value = $value;
        $this->meta = $meta;
    }

    public function toArray()
    {
        $array = $this->meta + ['name' => $this->getName($this->value)];

        return $array;
    }

    private function getName($value)
    {
        if (is_object($value)) {

            return get_class($value);
        }
        if (is_array($value)) {

            return $this->getArrayName($value);
        }

        return $this->getScalarName($value);
    }

    private function getArrayName(array $array)
    {
        $name = 'array';

        return $name;
    }

    private function getScalarName($value)
    {
        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }
        if (is_null($value)) {
            return 'null';
        }

        if (is_string($value)) {
            return "'{$value}'";
        }
        if (is_int($value)) {
            return $value;
        }
        $name = sprintf('(%s) %s', gettype($value), (string)$value);
        return $name;
    }
}
