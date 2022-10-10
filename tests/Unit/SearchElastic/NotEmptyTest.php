<?php


namespace Holoo\ModuleElasticsearch\Test\Unit\SearchElastic;


use Holoo\ModuleElasticsearch\Tests\TestCase;

class NotEmptyTest extends  TestCase
{
    public function test_method_serach_not_empty()  // not result
    {
        $result=json_decode($this->client()->search('index', 'title', 'test'), true);
        $this->assertNotEmpty($result); //an assertion
    }
}
