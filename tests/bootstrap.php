<?php
/**
 * This file is part of the koriym/printo package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
error_reporting(E_ALL);

$loader = require dirname(__DIR__) . '/vendor/autoload.php';
/* @var $loader \Composer\Autoload\ClassLoader */
$loader->addPsr4('Koriym\Printo\\', __DIR__);
