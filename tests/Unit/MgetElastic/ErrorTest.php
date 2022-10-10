<?php


namespace Holoo\ModuleElasticsearch\Test\Unit\MgetElastic;


use Holoo\ModuleElasticsearch\Tests\TestCase;

class ErrorTest extends TestCase
{
    public function test_method_mget_result_error()
    {
        $result=json_decode($this->client()->mget(
            [
                ['_index'=>'Shop','_id'=>"XJpOK4MBTnEkpFWFcXiF"]
            ]
        ));
        $this->assertEquals("index_not_found_exception",$result->docs[0]->error->type);

    }
}
