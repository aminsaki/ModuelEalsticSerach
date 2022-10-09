<?php


namespace Holoo\ModuleElasticsearch\Test\Unit;


use Holoo\ModuleElasticsearch\Tests\TestCase;

class SearchTest extends TestCase
{
    public function test_method_serach_not_empty()  // not result
    {
        $result=json_decode($this->client()->search('index', 'title', 'test'), true);
        $this->assertNotEmpty($result); //an assertion
    }

    public function test_method_serach_result()  /// result
    {
        $result=json_decode($this->client()->search('index', 'title', 'test'), true);
        $this->assertJson(json_encode($result)); //an assertion
    }

    public function test_method_serach_error() //error  404
    {
        $result=json_decode($this->client()->search('Index', 'title', 'test'), true);
        $this->assertEquals(404, $result['status']);
    }
}
