<?php
/**
 * This file is part of the koriym/printo package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
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
