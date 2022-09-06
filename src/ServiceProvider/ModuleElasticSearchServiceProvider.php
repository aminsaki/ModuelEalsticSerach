<?php


namespace Holoo\ModuleElasticsearch\ServiceProvider;
use Carbon\Laravel\ServiceProvider;

use Holoo\ModuleElasticsearch\Adapter\ElasticClient;
use Holoo\ModuleElasticsearch\Adapter\Interfaces\ClientAdapterInterface;

class ModuleElasticSearchServiceProvider extends  ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->instance('elasticClient', new ElasticClient());
    }
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/elastic.php' => config_path('elastic.php'),
        ]);
        $this->app->singleton(ClientAdapterInterface::class,ElasticClient::class);
    }




}
