<?php


namespace Holoo\ModuleElasticsearch\Test\Unit\IndexElastic;


use Holoo\ModuleElasticsearch\Tests\TestCase;

class UpdateTest extends  TestCase
{
    public function test_method_index_update() // update
    {
        $result=json_decode($this->client()->index("index1010", "my888", ['body'=>$this->body]), true);
        $this->assertEquals('updated', $result['result']);
    }

}
