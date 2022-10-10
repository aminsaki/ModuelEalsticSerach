<?php


namespace Holoo\ModuleElasticsearch\Test\Unit\GetELastic;


use Holoo\ModuleElasticsearch\Tests\TestCase;

class GetErrorTest extends  TestCase
{

    public function test_method_get_error() /// error
    {
        $result=json_decode($this->client()->get('Shop', $this->id));

        $this->assertEquals(404, $result->status);
    }

}
