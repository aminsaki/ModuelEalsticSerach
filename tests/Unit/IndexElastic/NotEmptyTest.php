<?php


namespace Holoo\ModuleElasticsearch\Test\Unit\IndexElastic;


use Holoo\ModuleElasticsearch\Tests\TestCase;

class NotEmptyTest extends TestCase
{
    public function test_method_index_not_empty() ///  not empty
    {
        $result=json_decode($this->client()->index($this->index, $this->id, ['body'=>$this->body]), true);
        $this->assertNotEmpty($result); //an assertion
    }
}
