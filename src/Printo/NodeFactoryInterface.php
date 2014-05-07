<?php
namespace Printo;

interface NodeFactoryInterface
{
    public function newInstance($value, array $meta);
}
