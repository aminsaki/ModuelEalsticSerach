<?php


namespace Holoo\ModuleElasticsearch\Test\Unit\ReindexElastic;


use Holoo\ModuleElasticsearch\Tests\TestCase;

class ErrorTest extends TestCase
{
    public function test_method_index_not_empty() ///  not empty
    {
        $result=json_decode($this->client()->reindex($this->index, $this->index . 1), true);
        $this->assertNotEmpty($result); //an assertion
    }

}
