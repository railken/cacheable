<?php

namespace Railken\Cacheable\Tests;

abstract class BaseTest extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('cache:clear');
    }
}
