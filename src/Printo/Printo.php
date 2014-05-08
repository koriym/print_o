<?php
/**
 * Printo
 *
 * @package Printo
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */
namespace Printo;

use Exception;
use ReflectionObject;
use RuntimeException;

class Printo
{
    /**
     * @var \SplObjectStorage
     */
    private $objectIdStorage;

    /**
     * @var \SplObjectStorage
     */
    private $sourceObjectStorage;

    /**
     * @var array
     */
    private $graph = [
        'nodes' => [],
        'links' => []
    ];

    private $nodeIndex = -1;

    /**
     * @var NodeFactoryInterface
     */
    private $nodeFactory;

    const CONFIG_PROPERTY = 1;
    const CONFIG_ARRAY = 2;
    const CONFIG_OBJECT_IN_ARRAY = 4;
    const CONFIG_ALL = 7;

    private $config =3;

    /**
     * @param $object
     *
     * @throws RuntimeException
     */
    public function __construct($object, NodeFactoryInterface $nodeFactory = null)
    {
        if (!is_object($object)) {
            throw new \LogicException('Object only: ' . gettype($object));
        }
        $this->object = $object;
        $this->objectIdStorage = new \SplObjectStorage;
        $this->sourceObjectStorage = new \SplObjectStorage;
        $this->nodeFactory = $nodeFactory ?: new NodeFactory;
    }

    public function setConfig($config)
    {
        $this->config = $config;

        return $this;
    }

    public function __toString()
    {
        try {
            $this->addObject($this->object);
            $list = json_encode($this->graph);

            $html = require __DIR__ . '/html/d3.force.html';

            return $html;
        } catch (Exception $e) {
            echo $e;
            error_log($e);
            exit;
        }
    }

    private function addObject($object)
    {
        $this->sourceObjectStorage->attach($object);
        $ref = new \ReflectionObject($object);
        $meta = ['file' => $ref->getFileName()];
        $sourceIndex = $this->getObjectId($object, $meta);
        $props = $ref->getProperties();
        foreach ($props as $prop) {
            $this->prop($prop, $object, $sourceIndex);
        }
    }

    private function prop(\ReflectionProperty $prop, $object, $sourceIndex)
    {
        $prop->setAccessible(true);
        $value = $prop->getValue($object);
        $nonObjectProperty = (! is_object($value) && (! ($this->config & self::CONFIG_PROPERTY)));
        if ($nonObjectProperty) {
            return;
        }

        /** @var $prop \ReflectionProperty */
        $meta = ['prop' => $prop->getName(), 'modifier' => $prop->getModifiers()];
        $targetIndex = $this->addGraphLink($sourceIndex, $value, $meta);
        if (is_object($value) && !$this->sourceObjectStorage->contains($value)) {
            $this->addObject($value);
        }
        if (is_array($value)) {
            $this->addArray($targetIndex, $value);
        }
    }

    private function addArray($sourceIndex, array $array)
    {
        if (! ($this->config & self::CONFIG_ARRAY)) {
            return;
        }
        foreach ($array as $key => $value) {
            if (is_object($value) && ($this->config & self::CONFIG_OBJECT_IN_ARRAY)) {
                $this->addObject($value);
                continue;
            }

            $targetIndex = $this->addGraphLink($sourceIndex, $value, ['key' => $key]);
            if (is_array($value)) {
                $this->addArray($targetIndex, $value);
            }
        }
    }

    /**
     * @param int   $sourceIndex
     * @param mixed $value
     * @param array $meta
     *
     * @return int
     */
    private function addGraphLink($sourceIndex, $value, array $meta)
    {
        $targetIndex = $this->getTargetIndex($value, $meta);
        $type = $this->getType($value);
        $this->graph['links'][] = ['source' => $sourceIndex, 'target' => $targetIndex, 'type' => $type];

        return $targetIndex;
    }

    /**
     * @param $value
     *
     * @return string
     */
    private function getType($value)
    {
        if (is_object($value)) {
            return 'object';
        }
        if (is_array($value)) {
            return 'array';
        }

        return 'scalar';
    }

    /**
     * @param mixed $value
     * @param array $meta
     *
     * @return int
     */
    private function getTargetIndex($value, array $meta)
    {
        if (is_object($value)) {
            return $this->getObjectId($value, $meta);
        }
        $node = $this->nodeFactory->newInstance($value, $meta);
        $this->addNode($node);

        return $this->nodeIndex;
    }

    /**
     * @param $object
     *
     * @return int
     */
    private function getObjectId($object, array $meta)
    {
        if ($this->objectIdStorage->contains($object)) {
            return (integer) $this->objectIdStorage[$object];
        }

        $node = $this->nodeFactory->newInstance($object, $meta);
        $index = $this->addNode($node);
        $this->objectIdStorage->attach($object, (string) $index);

        return $index;
    }

    /**
     * @param NodeInterface $node
     *
     * @return int
     */
    private function addNode(NodeInterface $node)
    {
        $this->nodeIndex++;
        $this->graph['nodes'][] = $node->toArray();

        return $this->nodeIndex;
    }
}
