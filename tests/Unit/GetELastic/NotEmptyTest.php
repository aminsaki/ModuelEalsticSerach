<?php


namespace Holoo\ModuleElasticsearch\Test\Unit;


use Holoo\ModuleElasticsearch\Tests\TestCase;

class NotEmptyTest  extends  TestCase
{
    public function test_method_get_not_empty()
    {
        $result=json_decode($this->client()->get($this->index, $this->id));
        $this->assertNotEmpty($result); //an assertion
    }
}
