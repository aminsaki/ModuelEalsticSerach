<?php


namespace Holoo\ModuleElasticsearch\Test\Unit\MtermvectorsElastic;


use Holoo\ModuleElasticsearch\Tests\TestCase;

class ResultTest extends TestCase
{
    public function test_method_mtermvectors_result() ///result json
    {
        $result=json_decode($this->client()->mtermvectors($this->index, $this->id, $this->id2, 'body'), true);

        $this->assertJson(json_encode($result)); //an assertion
    }
}
