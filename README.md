# print_o
## An object graph visualizer for PHP

![object graph](http://koriym.github.io/print_o/v1/img/big.png)

### What is object graph ?

> Object-oriented applications contain complex webs of interrelated objects. Objects are linked to each other by one object either owning or containing another object or holding a reference to another object. This web of objects is called an object graph and it is the more abstract structure that can be used in discussing an application's state. - [wikipedia](http://en.wikipedia.org/wiki/Object_graph)

> (JA) オブジェクト指向のアプリケーションは相互に関係のある複雑なオブジェクト網を含んでいます。オブジェクトはあるオブジェクトから所有されているか、他のオブジェクト（またはそのリファレンス）を含んでいるか、そのどちらかでお互いに接続されています。このオブジェクト網をオブジェクトグラフと呼びます。

#### Simple object graph
![only object](http://koriym.github.io/print_o/v1/img/object.png)

#### With properties
![only object](http://koriym.github.io/print_o/v1/img/prop.png)

#### Full extract
![only object](http://koriym.github.io/print_o/v1/img/full.png)

### Requirements
 * PHP 5.4+

### Usage


```php

print_o($object);

//or 

use Koriym\Printo\Printo;

echo (new Printo($object))
    ->setRange(Printo::RANGE_PROPERTY)
    ->setLinkDistance(130)
    ->setCharge(-500);
```

### Live demo

 * [BEAR.Resource](http://koriym.github.io/print_o/v1/libs/bear.resource.html)
