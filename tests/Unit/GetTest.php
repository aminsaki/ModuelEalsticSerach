<?php


namespace Holoo\ModuleElasticsearch\Test\Unit;


use Holoo\ModuleElasticsearch\Tests\TestCase;

class GetTest extends TestCase
{
    public function test_method_get_not_empty()
    {
        $result=json_decode($this->client()->get($this->index, $this->id));
        $this->assertNotEmpty($result); //an assertion
    }

    public function test_method_get_result_json()
    {
        $result=json_decode($this->client()->get($this->index, $this->id));
        $this->assertJson(json_encode($result)); //an assertion
    }

    public function test_method_get_error() /// error
    {
        $result=json_decode($this->client()->get('Shop', $this->id));

        $this->assertEquals(404, $result->status);
    }

}
