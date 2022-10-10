<?php


namespace Holoo\ModuleElasticsearch\Test\Unit;


use Holoo\ModuleElasticsearch\Tests\TestCase;

class MtermvectorsTest extends TestCase
{
    public function test_method_mtermvectors_not_empty() ///  not empty
    {

        $result=json_decode($this->client()->mtermvectors($this->index, $this->id, $this->id2, 'body'), true);
        $this->assertNotEmpty($result); //an assertion
    }

    public function test_method_mtermvectors_result() ///result json
    {
        $result=json_decode($this->client()->mtermvectors($this->index, $this->id, $this->id2, 'body'), true);

        $this->assertJson(json_encode($result)); //an assertion
    }

    public function test_method_mtermvectors_validation_error() //error
    {
        $result=json_decode($this->client()->mtermvectors('Shop', $this->id, $this->id2, 'body'), true);
        $this->assertEquals("index_not_found_exception", $result['docs'][0]['error']['type']);
    }


}
