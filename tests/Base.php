<?php

namespace Railken\Cacheable\Tests;

abstract class Base extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('cache:clear');
    }
}
