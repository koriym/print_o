<?php

use Printo\Printo;

/**
 * Print object graph
 *
 * @param object $object
 */
function print_o($object)
{
    @ob_clean();
    echo (new Printo($object));
    exit(0);
}
