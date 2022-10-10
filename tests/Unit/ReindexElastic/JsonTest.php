<?php


namespace Holoo\ModuleElasticsearch\Test\Unit\ReindexElastic;


use Holoo\ModuleElasticsearch\Tests\TestCase;

class JsonTest extends  TestCase
{
    public function test_method_reindex_result_json()
    {
        $result=json_decode($this->client()->reindex($this->index, $this->index . 1), true);
        $this->assertJson(json_encode($result)); //an assertion
    }
}
