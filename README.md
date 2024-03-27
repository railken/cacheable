# Cacheable

[![Actions Status](https://github.com/railken/cacheable/workflows/Test/badge.svg)](https://github.com/railken/cacheable/actions)

This library give you the ability to call any method with a suffix `Cached` to retrieve a Cached result of the methods. This comes in handy when you have a really time consuming method and the result is always be the same given the same parameters

# Requirements

- PHP 8.1 and later
- Laravel

## Installation

You can install it via [Composer](https://getcomposer.org/) by typing the following command:

```bash
composer require railken/cacheable
```

## Usage

Add the `CacheableTrait` and `CacheableContract` in the class you wish to cache
```php
use Railken\Cacheable\CacheableTrait;
use Railken\Cacheable\CacheableContract;

class Foo implements CacheableContract
{
  use CacheableTrait;

  public function sum(int $x, int $y): int
  {
      return $x + $y;
  }

  public function random(): string
  {
      return str_random(10);
  }
}

```
Now you can play with the method

```php
$foo = new Foo();
$foo->sumCached(2, 8); // 10

$foo->randomCached(); // Return always the same string

```

In order to cleanup the cache simply run `php artisan cache:clean`
