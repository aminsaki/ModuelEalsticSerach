<?php


namespace Holoo\ModuleElasticsearch\Test\Unit\MtermvectorsElastic;


use Holoo\ModuleElasticsearch\Tests\TestCase;

class ValidationError extends  TestCase
{
    public function test_method_mtermvectors_validation_error() //error
    {
        $result=json_decode($this->client()->mtermvectors('Shop', $this->id, $this->id2, 'body'), true);
        $this->assertEquals("index_not_found_exception", $result['docs'][0]['error']['type']);
    }
}
