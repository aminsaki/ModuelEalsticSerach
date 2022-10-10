<?php


namespace Holoo\ModuleElasticsearch\Test\Unit\DeleteEelastic;


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



}
