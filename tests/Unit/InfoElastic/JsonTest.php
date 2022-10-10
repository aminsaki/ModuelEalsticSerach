<?php


namespace Holoo\ModuleElasticsearch\Test\Unit\InfoElastic;


use Couchbase\TermRangeSearchQuery;
use Holoo\ModuleElasticsearch\Tests\TestCase;

class JsonTest extends TestCase
{
    public function test_method_info_json()
    {
        $result=json_decode($this->client()->index('index', 'my18888448', ['body'=>"this is one test"]), true);

        $this->assertJson(json_encode($result));
    }
}
