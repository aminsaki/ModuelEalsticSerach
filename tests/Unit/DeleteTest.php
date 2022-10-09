<?php


namespace Holoo\ModuleElasticsearch\Test\Unit;


use Holoo\ModuleElasticsearch\Tests\TestCase;

class DeleteTest extends TestCase
{
    public function test_method_index_delete_id_and_index()  ///  delete
    {
        $index=strtolower(fake()->lastName());
        $id=fake()->uuid;

        $this->client()->index($index, $id, ['body'=>fake()->text()]); /// indexing into elasticserach

        $result=json_decode($this->client()->delete($index, $id, true));

        $this->assertEquals('deleted', $result->result);

    }
    public function test_method_index_delete_id_not_found() /// not found
    {
        $result=json_decode($this->client()->delete('index', 'c8548', true));

        $this->assertEquals('not_found', $result->result);

    }


}
