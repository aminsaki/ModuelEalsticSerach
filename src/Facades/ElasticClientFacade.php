<?php

namespace Holoo\ModuleElasticsearch\Facades;

use Illuminate\Support\Facades\Facade;

class ElasticClientFacade  extends  Facade
{
    protected static function getFacadeAccessor()
    {
        return 'elasticClient';
    }
}
