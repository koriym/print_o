<?php
/**
 * This file is part of the koriym/printo package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
use Koriym\Printo\Printo;

/**
 * Print object graph
 *
 * @param object $object
 */
function print_o($object)
{
    echo new Printo($object);
}
