<?php


namespace Holoo\ModuleElasticsearch\Test\Unit\IndexElastic;


use Holoo\ModuleElasticsearch\Tests\TestCase;

class CreateTest extends TestCase
{
    public function test_method_index_create()  /// create
    {
        $result=json_decode($this->client()->index($this->index, $this->id, ['body'=>$this->body]), true);
        $this->assertEquals('created', $result['result']);
    }
}
