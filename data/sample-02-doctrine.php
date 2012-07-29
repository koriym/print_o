<?php
namespace Printo\doc;

require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/src.php';

use Doctrine\Common\Annotations\SimpleAnnotationReader as Reader;
use Printo\doc\PrintoAnno;

/**
 * @Annotation
 * @Target({"CLASS"})
 */
class PrintoAnno{}

/**
 * @PrintoAnno
 */
class SampleAnno{}

$obj = new Reader;
$obj->getClassAnnotations(new \ReflectionClass('Printo\doc\SampleAnno'));

// print object graph
print_o($obj);
