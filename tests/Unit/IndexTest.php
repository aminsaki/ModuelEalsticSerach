<?php


namespace Holoo\ModuleElasticsearch\Test\Unit;


use Holoo\ModuleElasticsearch\Tests\TestCase;

class IndexTest extends TestCase
{

    public function test_method_index_not_empty() ///  not empty
    {

        $result=json_decode($this->client()->index($this->index, $this->id, ['body'=>$this->body]), true);
        $this->assertNotEmpty($result); //an assertion
    }

    public function test_method_index_result() ///result json
    {
        $result=json_decode($this->client()->index($this->index, $this->id, ['body'=>$this->body]), true);

        $this->assertJson(json_encode($result)); //an assertion
    }

    public function test_method_index_create()  /// create
    {
        $result=json_decode($this->client()->index($this->index, $this->id, ['body'=>$this->body]), true);
        $this->assertEquals('created', $result['result']);
    }

    public function test_method_index_update() // update
    {
        $result=json_decode($this->client()->index("index1010", "my888", ['body'=>$this->body]), true);
        $this->assertEquals('updated', $result['result']);
    }

    public function test_method_index_error() //error
    {
        $result=json_decode($this->client()->index("Index1010", "5512", ['body'=>$this->body]), true);
        $this->assertEquals(400, $result['status']);
    }


}
