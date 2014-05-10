<?php

use Koriym\Printo\Printo;

/**
 * Print object graph
 *
 * @param object $object
 */
function print_o($object)
{
    echo (new Printo($object));
}
