<?php

namespace Holoo\ModuleElasticsearch\Test\Feature;


use Holoo\ModuleElasticsearch\Adapter\ElasticClient;
use Holoo\ModuleElasticsearch\Tests\TestCase;

class InfoTest extends TestCase
{
    public function test_method_info_not_empty()
    {
        $result=ElasticClient::create();

        $result=json_decode($result->info(), true);

        $this->assertNotEmpty($result); //an assertion

    }

}
