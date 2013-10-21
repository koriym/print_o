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
    const IS_OBJ = true;

    const IS_NOT_OBJ = false;

    private static $config = [
        'assetsPath' => 'http://koriym.github.com/print_o/assets/',
        'showProgressive' => true,
        'showSublines' => false,
        'canvasError' => "alert",
        'mapArea' => ['x' => -1, 'y' => -1]
    ];

    /**
     * Loaded
     *
     * @var \SplObjectStorage
     */
    private $storage;

    /**
     * @var array
     */
    private $vars;

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
        $this->storage = new \SplObjectStorage;
        ini_set('xdebug.var_display_max_children', 1);
        ob_start();
    }

    /**
     * Set config
     *
     * @param array $config
     */
    public static function init(array $config)
    {
        self::$config = array_merge(self::$config, $config);
    }

    /** @noinspection PhpInconsistentReturnPointsInspection */
    public function __toString()
    {
        try {
            $rootName = get_class($this->object);
            $data = $this->makeData($this->object);
            $list = $this->makeString($data);
            $vars = $this->getVarDivs();
            // object list
            $list = "<li>{$rootName}<ul>{$list}</ul></li>";
            // vars
            /** @noinspection PhpUnusedLocalVariableInspection */
            $config = json_encode(self::$config);
            /** @noinspection PhpUnusedLocalVariableInspection */
            $assetsPath = self::$config['assetsPath'];
            /** @noinspection PhpUnusedLocalVariableInspection */
            $list .= "<span style=\"visibility:hidden;\">{$vars}</span>";
            $html = require __DIR__ . '/html.php';

            return $html;
        } catch (Exception $e) {
            error_log($e);
        }
    }

    /**
     * make tree data
     *
     * @param object &$object
     * @param int    $nest
     *
     * @return array
     */
    private function makeData(&$object, $nest = 0)
    {
        $data = [];
        $props = (new ReflectionObject($object))->getProperties();
        foreach ($props as $prop) {
            $prop->setAccessible(true);
            $value = $prop->getValue($object);
            $name = $prop->name;
            if (is_object($value)) {
                $class = get_class($value);
                $loaded = $this->storage->contains($value);
                if ($loaded === true) {
                    $data["@{$name}"] = ["@{$name}", $value, self::IS_OBJ];
                } elseif ($nest > 500) {
                    $data[">{$name}"] = [">{$name}", $value, self::IS_OBJ];
                } else {
                    $this->storage->attach($value);
                    $nest++;
                    $child = $this->makeData($value, $nest);
                    $nest = 0;
                    $hasChild = ($child !== []);
                    $data["({$class}) {$name}"] = $hasChild ? [
                        $child,
                        $value,
                        self::IS_OBJ
                    ] : [
                        $name,
                        $value,
                        self::IS_OBJ
                    ];
                }
            } else {
                $value = $prop->getValue($object);
                $type = gettype($value);
                $data[$name] = ["($type) {$name}", $value, self::IS_NOT_OBJ];
            }
        }

        return $data;
    }

    /**
     * @param array $data
     *
     * @return string
     */
    private function makeString(array $data)
    {
        $li = '';
        foreach ($data as $key => $val) {
            list($element, $value, $isObject) = $val;
            $varId = md5(serialize($element));
            $this->vars[$varId] = $value;
            $objClass = $isObject ? ' type="object"' : '';
            if (is_array($element)) {
                //                $open = "<li><a href=\"#\" id=\"{$varId}\">{$key}</a>";
                $open = "<li id=\"{$varId}\" {$objClass}>{$key}";
                $list = '<ul>' . $this->makeString($element) . '</ul>';
                $close = '</li>';
                $li .= $open . $list . $close;
            } else {
                //$li .= "<li><a href=\"#\" id=\"{$varId}\">{$element}</a></li>\n";
                $li .= "<li id=\"{$varId}\">{$element}\n";
            }
        }

        return $li;
    }

    /**
     * Store variable representation using 'print_a'
     *
     * @return string
     */
    private function getVarDivs()
    {
        $div = '';
        foreach ($this->vars as $id => $var) {
            if (is_object($var)) {
                $varView = '';
//                $varView = print_a($var, 'return:1; show_objects:false; avoid@:1');
            } elseif (is_array($var) || is_scalar($var)) {
                ob_start();
                var_dump($var);
                $varView = ob_get_clean();
            }

            $div .= "<div id=\"data_{$id}\"><pre>$varView</pre></div>";
        }

        return $div;
    }
}