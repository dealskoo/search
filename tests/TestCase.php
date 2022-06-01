<?php

namespace Dealskoo\Search\Tests;


use Dealskoo\Search\Providers\SearchServiceProvider;

abstract class TestCase extends \Dealskoo\Admin\Tests\TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            SearchServiceProvider::class
        ];
    }

    protected function getPackageAliases($app)
    {
        return [];
    }

    protected function setUp(): void
    {
        parent::setUp();
    }
}
