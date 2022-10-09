<?php


namespace Holoo\ModuleElasticsearch\Test\Unit;


use Holoo\ModuleElasticsearch\Tests\TestCase;

class ReindexTest extends TestCase
{
    public function test_method_index_not_empty() ///  not empty
    {

        $result=json_decode($this->client()->reindex($this->index, $this->index . 1), true);
        $this->assertNotEmpty($result); //an assertion
    }

    public function test_method_reindex_error() ///  not 404
    {
        $result=json_decode($this->client()->reindex($this->index . "44414", $this->index . 1), true);
        $this->assertEquals(404, $result['status']);

    }

    public function test_method_reindex_result_json()
    {
        $result=json_decode($this->client()->reindex($this->index, $this->index . 1), true);

        $this->assertJson(json_encode($result)); //an assertion

    }
}
