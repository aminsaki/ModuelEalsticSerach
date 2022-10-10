<?php


namespace Holoo\ModuleElasticsearch\Test\Unit\SearchElastic;


use Holoo\ModuleElasticsearch\Tests\TestCase;

class ResultTest extends  TestCase
{
    public function test_method_serach_result()  /// result
    {
        $result=json_decode($this->client()->search('index', 'title', 'test'), true);
        $this->assertJson(json_encode($result)); //an assertion
    }
}
