# print_o
## An object graph visualizer for PHP

### What is object graph ?

> Object-oriented applications contain complex webs of interrelated objects. Objects are linked to each other by one object either owning or containing another object or holding a reference to another object. This web of objects is called an object graph and it is the more abstract structure that can be used in discussing an application's state. - [wikipedia](http://en.wikipedia.org/wiki/Object_graph)

####
> (JA) オブジェクト指向のアプリケーションは相互に関係のある複雑なオブジェクト網を含んでいます。オブジェクトはあるオブジェクトから所有されているか、他のオブジェクト（またはそのリファレンス）を含んでいるか、そのどちらかでお互いに接続されています。このオブジェクト網をオブジェクトグラフと呼びます。


### Requirements
 * PHP 5.4+

### Usage

print_o() displays information about a object graph and variable in a way that's readable by humans.
print_o() also show protected and private properties of objects with PHP 5. Static class members will be shown unlike print_r, var_dump.

```php
<?php
require '/path/to/print_o/src.php';

...
print_o($obj);
```

Try click, double click, or drag.

### Live demo

 * [data/sample-01](http://koriym.github.com/print_o/sample/01-sample.html) - [source code](https://github.com/koriym/print_o/blob/master/data/sample-01.php)
 * [Doctrine annotation reader object](http://koriym.github.com/print_o/sample/02-doctrine-anno.html)
 * [Symfony commandline application object](http://koriym.github.com/print_o/sample/03-symfony.command.application.html)

## Dependencies

 * [kennethkufluk / js-mindmap](https://github.com/kennethkufluk/js-mindmap)
 * [debuglib for PHP5](http://phpdebuglib.de/)
