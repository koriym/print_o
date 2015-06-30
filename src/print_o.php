<?php
/**
 * koriym/print_o
 *
 * @license http://opensource.org/licenses/bsd-license.php MIT
 */
use Koriym\Printo\Printo;

/**
 * Print object graph
 *
 * @param object $object
 */
function print_o($object)
{
    echo(new Printo($object));
}
