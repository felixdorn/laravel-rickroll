<?php


namespace Felix\RickRoll\Tests;


use Felix\RickRoll\Providers\RickRollProvider;
use Orchestra\Testbench\TestCase as Base;

class TestCase extends Base
{
    protected function getPackageProviders($app): array
    {
        return [RickRollProvider::class];
    }
}
