<?php


namespace Holoo\ModuleElasticsearch\Test\Unit\IndexElastic;


use Holoo\ModuleElasticsearch\Tests\TestCase;

class ResultTest extends  TestCase
{

    public function test_method_index_result() ///result json
    {
        $result=json_decode($this->client()->index($this->index, $this->id, ['body'=>$this->body]), true);
        $this->assertJson(json_encode($result)); //an assertion
    }
}
