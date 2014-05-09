<?php
namespace Koriym\Printo;

interface NodeFactoryInterface
{
    public function newInstance($value, array $meta);
}
