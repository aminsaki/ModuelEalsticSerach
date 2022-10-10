<?php


namespace Holoo\ModuleElasticsearch\Test\Unit\ReindexElastic;


use Holoo\ModuleElasticsearch\Tests\TestCase;

class NotEmptyTest extends  TestCase
{
    public function test_method_reindex_error() ///  not 404
    {
        $result=json_decode($this->client()->reindex($this->index . "44414", $this->index . 1), true);
        $this->assertEquals(404, $result['status']);

    }
}
