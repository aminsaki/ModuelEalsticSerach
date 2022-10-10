<?php


namespace Holoo\ModuleElasticsearch\Test\Unit\GetELastic;


use Holoo\ModuleElasticsearch\Tests\TestCase;

class ResultJsonTest extends  TestCase
{
    public function test_method_get_result_json()
    {
        $result=json_decode($this->client()->get($this->index, $this->id));
        $this->assertJson(json_encode($result)); //an assertion
    }
}
