<?php


namespace Holoo\ModuleElasticsearch\Test\Unit;


use Holoo\ModuleElasticsearch\Tests\TestCase;

class QueryTest extends TestCase
{

    public function test_method_query_It_is_done_successfully()
    {
        $index=strtolower(fake()->lastName());
        $id=fake()->uuid;

        $this->client()->index($index, $id, ['body'=>fake()->text()]); /// indexing into elasticserach
        ///
        $result=json_decode($this->client()->query("select * from {$index}"), true);

        $this->assertJson(json_encode($result)); //an assertion
    }

    public function test_method_query_make_an_error()
    {
        $result=json_decode($this->client()->query("select * from Shop"), true);
        $this->assertEquals(400, $result['status']);

    }
}
