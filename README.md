# PHP String Juggler

[![Latest Stable Version](https://poser.pugx.org/10quality/php-string-juggler/v/stable)](https://packagist.org/packages/10quality/php-string-juggler)
[![Total Downloads](https://poser.pugx.org/10quality/php-string-juggler/downloads)](https://packagist.org/packages/10quality/php-string-juggler)
[![License](https://poser.pugx.org/10quality/php-string-juggler/license)](https://packagist.org/packages/10quality/php-string-juggler)

Juggling with strings in PHP.

This is a forked version of [Christian Johansson](https://github.com/cjohansson)'s phpStringJuggler library.

**Major changes:**

* PHP 7 support.
* Composer support.
* PHPunit.

## Install

```bash
composer require 10quality/php-string-juggler
```

## Purpose
The idea is the make it easier to process strings in a object-oriented way.

An instantiated class is compatible with a string so you can use all functions for strings on a instantiated class.

Like this:

``` php
$string = new StringJuggler\Juggler('DONEC');`
echo strtolower($string);
// Echoes 'donec'
```

## Examples
Sometimes examples is the best way to learn.

### 1. Create a StringJuggler

``` php
// Use statement
use StringJuggler\Juggler;

$string = new Juggler('Donec id elit non mi porta gravida at eget metus.');
```

### 2. Juggle before

``` php
$before = $string->getBefore(' id');
// $before now equals 'Donec'
```

### 3. Juggle after

``` php
$after = $string->getAfter('porta ');
// $after now equals 'gravida at eget metus.'
```

### 4. Juggle in a conditional statement

``` php
if (($after = $string->getAfter('porta ')) == 'gravida at eget metus.') {
	.. do something
} else {
	.. do something else
}
```

If you need to verify if something was found compare with '' rather than boolean false, like this, or use the `isEmpty()` and `isNotEmpty()` methods.

``` php
if (($after = $string->getAfter('porta ')) != '') {
	.. do something
} else {
	.. do something else
}
```

``` php
if ($string->getAfter('porta ')->isNotEmpty()) {
	.. do something
} else {
	.. do something else
}
```

Because the StringJuggler class will **always equal true but not always equal an empty string**. That behavior is caused by PHP.

### 5. Juggle a lot

``` php
$string = new \StringJuggler\String('Nullam quis risus eget urna mollis ornare vel eu leo. Vestibulum id ligula porta felis euismod semper. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam porta sem malesuada magna mollis euismod. Vestibulum id ligula porta felis euismod semper. Nullam id dolor id nibh ultricies vehicula ut id elit. Donec id elit non mi porta gravida at eget metus. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Curabitur blandit tempus porttitor. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Nullam id dolor id nibh ultricies vehicula ut id elit. Donec id elit non mi porta gravida at eget metus. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Maecenas sed diam eget risus varius blandit sit amet non magna. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.');`

if (($text = $string->getAfter('risus')->getBefore('vel eu')->getTrimmed()) == 'eget urna mollis ornare') {
	.. do something
} else {
	.. do something else
}`
```

## All methods

* after()
* before()
* getAfter()
* getAfterPosition()
* getBefore()
* getBeforePosition()
* getExplode()
* getIReplace()
* getPregMatches()
* getPregReplace()
* getReplace()
* getString()
* getTrimmed()
* ireplace()
* isEmpty()
* isNotEmpty()
* pregMatch()
* pregReplace()
* replace()
* setString()
* trim()

## License and attribution

The MIT License (MIT)

Copyright (c) 2015 Christian Johansson