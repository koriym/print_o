<?php

namespace Koriym\Printo;

final class Node implements NodeInterface
{
    /**
     * @var
     */
    private $value;

    /**
     * @var array
     */
    private $meta = [];

    /**
     * @param       $value
     * @param array $meta
     */
    public function __construct($value, array $meta)
    {
        $this->value = $value;
        $this->meta = $meta;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $array = $this->meta + ['name' => $this->getName($this->value)];

        return $array;
    }

    /**
     * @param $value
     *
     * @return string
     */
    private function getName($value)
    {
        if (is_object($value)) {
            return get_class($value);
        }
        if (is_array($value)) {
            return $this->getArrayName();
        }

        return $this->getScalarName($value);
    }

    /**
     *
     * @return string
     */
    private function getArrayName()
    {
        $name = 'array';

        return $name;
    }

    /**
     * @param $value
     *
     * @return string
     */
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
        $name = sprintf('(%s) %s', gettype($value), (string) $value);

        return $name;
    }
}
