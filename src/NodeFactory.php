<?php
/**
 * koriym/print_o
 *
 * @license http://opensource.org/licenses/bsd-license.php MIT
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
