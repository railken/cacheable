<?php

namespace Railken\Cacheable\Tests;

use Railken\Cacheable\CacheableTrait;
use Railken\Cacheable\CacheableContract;

class Foo implements CacheableContract
{
    use CacheableTrait;

    public function getRandomString(): string
    {
        return str_random(40);
    }

    public function getConstantString(): string
    {
        return 'bar';
    }

    public static function getInt(): int
    {
        return 50;
    }

    public static function sum(int $x, int $y): int
    {
        return $x + $y;
    }
}
