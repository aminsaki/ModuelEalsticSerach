<?php

namespace Holoo\ModuleElasticsearch\Tests;

use Holoo\ModuleElasticsearch\Adapter\ElasticClient;
use Holoo\ModuleElasticsearch\ServiceProvider\ModuleElasticSearchServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected  string  $index;
    protected string  $id;
    protected string  $body;



    public function setUp(): void
    {
        parent::setUp();
        $this->app->setBasePath(__DIR__ . '/laravel');
        $this->index=strtolower(fake()->lastName());
        $this->id=fake()->uuid;
        $this->body=fake()->text();
    }

    public function fake()
    {
        $this->index=strtolower(fake()->lastName());
        $this->id=fake()->uuid;
        $this->body=fake()->text();
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

    protected function client()
    {
        return ElasticClient::create();
    }

}
