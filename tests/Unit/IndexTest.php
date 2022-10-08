<?php


namespace Holoo\ModuleElasticsearch\Test\Unit;


use Holoo\ModuleElasticsearch\Adapter\ElasticClient;
use Holoo\ModuleElasticsearch\Tests\TestCase;

class IndexTest extends  TestCase
{
    public function test_method_info_not_empty()
    {
        $result=ElasticClient::create();

        $result=json_decode($result->index('index','my18888448',['body'=>"this is one test"]), true);

        $this->assertNotEmpty($result); //an assertion

    }


}
