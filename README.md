# Cacheable

[![Build Status](https://travis-ci.org/railken/cacheable.svg?branch=master)](https://travis-ci.org/railken/cacheable)

This library give you the ability to call any method with a suffix `Cached` to retrieve a Cached result of the methods. This is comes in handy when you have a really time consuming method and the result should always be the same given the same parameters

# Requirements

PHP 7.1 and later.
Laravel

## Installation

You can install it via [Composer](https://getcomposer.org/) by typing the following command:

```bash
composer require railken/cacheable
```

## Usage

Add the `CacheableTrait` and `CacheableContract` in the class you wish to cache
```php
<?php

use Railken\Cacheable\CacheableTrait;
use Railken\Cacheable\CacheableContract;

class Foo implements CacheableContract
{
	use CacheableTrait;

	public function sum(int $x, int $y): int
	{
		return $x + $y;
	}
}

```
Now you can get the result cached!

```php
<?php
$foo = new Foo();
$foo->sumCached(2, 8); // 10

```
