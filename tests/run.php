<?php
/**
 * This file is part of the koriym/printo package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Koriym\Printo;

$loader = require dirname(__DIR__) . '/vendor/autoload.php';
$loader->addPsr4('Koriym\Printo\\', __DIR__);

echo(new Printo(new Mock\FirstGraph))->setRange(Printo::RANGE_PROPERTY);
//echo (new Printo($_SERVER));
