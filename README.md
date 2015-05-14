# print_o

## An object graph visualizer for PHP

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/koriym/Koriym.Printo/badges/quality-score.png?b=1.x)](https://scrutinizer-ci.com/g/koriym/Koriym.Printo/?branch=1.x)
[![Build Status](https://travis-ci.org/koriym/Koriym.Printo.svg?branch=1.x)](https://travis-ci.org/koriym/Koriym.Printo)
[![Code Coverage](https://scrutinizer-ci.com/g/koriym/Koriym.Printo/badges/coverage.png)

![object graph](http://koriym.github.io/Koriym.Printo/v1/img/big.png)

### What is object graph ?

> Object-oriented applications contain complex webs of interrelated objects. Objects are linked to each other by one object either owning or containing another object or holding a reference to another object. This web of objects is called an object graph and it is the more abstract structure that can be used in discussing an application's state. - [wikipedia](http://en.wikipedia.org/wiki/Object_graph)

> (JA) オブジェクト指向のアプリケーションは相互に関係のある複雑なオブジェクト網を含んでいます。オブジェクトはあるオブジェクトから所有されているか、他のオブジェクト（またはそのリファレンス）を含んでいるか、そのどちらかでお互いに接続されています。このオブジェクト網をオブジェクトグラフと呼びます。

#### Simple object graph
![only object](http://koriym.github.io/Koriym.Printo/v1/img/object.png)

#### With properties
![+property](http://koriym.github.io/Koriym.Printo/v1/img/prop.png)

#### Full extract
![+array](http://koriym.github.io/Koriym.Printo/v1/img/full.png)

### Requirements
 * PHP 5.4+

### Installation

```javascript
{
    "require-dev": {
        "koriym/printo": "~1.0"
    }
}
```

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

 * [Aura.Framework_Project](http://koriym.github.io/Koriym.Printo/v1/libs/aura.framework_project.html) [![github](http://koriym.github.io/Koriym.Printo/images/gh.png)](https://github.com/auraphp/Aura.Framework_Project)

 * [BEAR.Sunday](http://koriym.github.io/Koriym.Printo/v1/libs/bear.sunday.html) [![github](http://koriym.github.io/Koriym.Printo/images/gh.png)](https://github.com/koriym/BEAR.Sunday)

