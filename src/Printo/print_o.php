<?php
use Printo\Printo;

function print_o($object)
{
    @ob_clean();
    echo (new Printo($object));
    exit(0);
}
