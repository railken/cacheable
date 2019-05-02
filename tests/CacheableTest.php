<?php

namespace Railken\Cacheable\Tests;

class CacheableTest extends BaseTest
{
    public function testFoo()
    {
        $foo = new Foo();
        $this->assertEquals(50, Foo::getInt());
        $this->assertEquals(50, Foo::getIntCached());
        $this->assertEquals($foo->getRandomStringCached(), $foo->getRandomStringCached());
        $this->assertEquals('bar', $foo->getConstantString());
        $this->assertEquals('bar', $foo->getConstantStringCached());
        $this->assertEquals(10, $foo->sumCached(2, 8));
        $this->assertEquals(4, $foo->sumCached(1, 3));

        $cacheKey = $foo::cacheable()->name(get_class($foo), 'sumCached', [2, 8]);

        $this->assertEquals("Railken\Cacheable\Tests\Foo::sumCached::a:2:{i:0;i:2;i:1;i:8;}", $cacheKey);
    }
}
