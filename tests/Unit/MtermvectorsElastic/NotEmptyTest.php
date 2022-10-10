<?php


namespace Holoo\ModuleElasticsearch\Test\Unit\DeleteEelastic;


use Holoo\ModuleElasticsearch\Tests\TestCase;

class NotEmptyTest extends  TestCase
{

    public function test_method_mtermvectors_not_empty() ///  not empty
    {
        $result=json_decode($this->client()->mtermvectors($this->index, $this->id, $this->id2, 'body'), true);
        $this->assertNotEmpty($result); //an assertion
    }

}
