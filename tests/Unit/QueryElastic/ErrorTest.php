<?php


namespace Holoo\ModuleElasticsearch\Test\Unit\QueryElastic;


use Holoo\ModuleElasticsearch\Tests\TestCase;

class ErrorTest extends TestCase
{
    public function test_method_query_make_an_error()
    {
        $result=json_decode($this->client()->query("select * from Shop"), true);
        $this->assertEquals(400, $result['status']);

    }
}
