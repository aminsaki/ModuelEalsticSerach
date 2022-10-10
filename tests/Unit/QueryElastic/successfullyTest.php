<?php


namespace Holoo\ModuleElasticsearch\Test\Unit\QueryElastic;


use Holoo\ModuleElasticsearch\Tests\TestCase;

class successfullyTest extends TestCase
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
}
