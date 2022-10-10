<?php


namespace Holoo\ModuleElasticsearch\Test\Unit\IndexElastic;


use Holoo\ModuleElasticsearch\Tests\TestCase;

class ErrorTest extends TestCase
{
    public function test_method_index_error() //error
    {
        $result=json_decode($this->client()->index("Index1010", "5512", ['body'=>$this->body]), true);
        $this->assertEquals(400, $result['status']);
    }
}
