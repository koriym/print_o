<?php
/**
 * koriym/print_o
 *
 * @license http://opensource.org/licenses/bsd-license.php MIT
 */
namespace Koriym\Printo;

interface NodeFactoryInterface
{
    /**
     * @return Node
     */
    public function newInstance($value, array $meta);
}
