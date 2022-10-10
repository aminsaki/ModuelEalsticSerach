<?php


namespace Holoo\ModuleElasticsearch\Test\Unit\DeleteEelastic;


use Holoo\ModuleElasticsearch\Tests\TestCase;

class NotFoundDeleteTest extends TestCase
{
    public function test_method_index_delete_id_not_found() /// not found
    {
        $result=json_decode($this->client()->delete('index', 'c8548', true));

        $this->assertEquals('not_found', $result->result);

    }
}
