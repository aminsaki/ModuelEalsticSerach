<?php

namespace Holoo\ModuleElasticsearch\Tests;

use Holoo\ModuleElasticsearch\ServiceProvider\ModuleElasticSearchServiceProvider;
use Illuminate\Support\Facades\Config;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->app->setBasePath(__DIR__.'/laravel');
    }
    /**
     * @inheritdoc
     */
    protected function getPackageProviders($app)
    {
        return [
            ModuleElasticSearchServiceProvider::class,
        ];
    }

}
