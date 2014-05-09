<?php
namespace Koriym\Printo;

final class NodeFactory implements NodeFactoryInterface
{
    /**
     * @param $value
     *
     * @return NodeInterface
     */
    public function newInstance($value, array $meta)
    {
        return new Node($value, $meta);
    }
}
