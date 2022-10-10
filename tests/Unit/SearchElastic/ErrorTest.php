<?php


namespace Holoo\ModuleElasticsearch\Test\Unit\SearchElastic;


use Holoo\ModuleElasticsearch\Tests\TestCase;

class ErrorTest extends  TestCase
{
    public function test_method_serach_error() //error  404
    {
        $result=json_decode($this->client()->search('Index', 'title', 'test'), true);
        $this->assertEquals(404, $result['status']);
    }
}
