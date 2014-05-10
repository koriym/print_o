<?php
namespace Koriym\Printo;

interface NodeFactoryInterface
{
    /**
     * @return Node
     */
    public function newInstance($value, array $meta);
}
