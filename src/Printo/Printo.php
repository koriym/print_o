<?php
/**
 * Printo
 *
 * @package Printo
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */
namespace Printo;

use DbugL;
use Exception;
use ReflectionObject;
use RuntimeException;

if (! function_exists('print_a')) {
    require_once dirname(dirname(__DIR__)) . '/libs/debuglib/debuglib.php';
}

/**
 * Printo
 *
 * @package Printo
 * @author  Akihito Koriyama <akihito.koriyama@gmail.com>
 */
class Printo
{
    /**
     * @var \SplObjectStorage
     */
    private $objectIdStorage;

    private $objectAddStorage;

    /**
     * @var array
     */
    private $graph =[];

    /**
     * @param $object
     *
     * @throws RuntimeException
     */
    public function __construct($object)
    {
        if (!is_object($object)) {
            throw new RuntimeException('Object only: ' . gettype($object));
        }
        $this->object = $object;
        $this->objectIdStorage = new \SplObjectStorage;
        $this->objectAddStorage = new \SplObjectStorage;
        ob_start();
    }

    public function __toString()
    {
        try {
            $this->addObject($this->object);
            $links = json_encode($this->graph, JSON_PRETTY_PRINT);

            $html = require __DIR__ . '/view.html';

            return $html;
        } catch (Exception $e) {
            error_log($e);
        }
    }

    private function addObject($object)
    {
        $this->objectAddStorage->attach($object);
        $props = (new ReflectionObject($object))->getProperties();
        foreach ($props as $prop) {
            $prop->setAccessible(true);
            $value = $prop->getValue($object);
            $name = $prop->name;
            $this->addGraph($object, $value, $name);
            if (is_object($value) && ! $this->objectAddStorage->contains($value)) {
                $this->addObject($value);
            }
        }
    }

    private function addGraph($source, $target, $name)
    {
        $doDraw = is_object($target);
        $doDraw = true;
        if ($doDraw) {
            $this->graph[] = ['source' => $this->getName($source), 'target' => $this->getName($target), 'type' => gettype($target), 'name' => $name];
        }
    }

    private function getName($item)
    {
        if (is_object($item)) {
            return $this->getObjectId($item) . '.' . get_class($item);
        }
        if (is_bool($item)) {
            return $item ? '(true)' : '(false)';
        }
        if (is_scalar($item)) {
            return (string) $item;
        }
    }
    private function getObjectId($object)
    {
        static $cnt = 0;

        if ($this->objectIdStorage->contains($object)) {
            return $this->objectIdStorage[$object];
        }
        $cnt++;
        $hash = (string) $cnt;
        $this->objectIdStorage[$object] = $hash;

        return $hash;
    }
}
