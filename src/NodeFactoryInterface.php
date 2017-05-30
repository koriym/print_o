<?php
/**
 * This file is part of the koriym/printo package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Koriym\Printo;

interface NodeFactoryInterface
{
    /**
     * @return Node
     */
    public function newInstance($value, array $meta);
}
