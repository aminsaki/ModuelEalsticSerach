<?php


namespace Holoo\ModuleElasticsearch\Test;


use Dflydev\DotAccessData\Data;
use Holoo\ModuleElasticsearch\Tests\TestCase;

class MgetTest extends TestCase
{
    public function test_method_mget_result_not_empty()
    {
        $result=json_decode($this->client()->mget(
            [
                ['_index'=>'Shop','_id'=>"XJpOK4MBTnEkpFWFcXiF"],
                ['_index'=>'shop','_id'=>"Y5pOK4MBTnEkpFWFcnhg"]
            ]
        ));
        $this->assertNotEmpty($result); //an assertion

    }

    public function test_method_mget_result_error()
    {
        $result=json_decode($this->client()->mget(
            [
                ['_index'=>'Shop','_id'=>"XJpOK4MBTnEkpFWFcXiF"]
            ]
        ));
        $this->assertEquals("index_not_found_exception",$result->docs[0]->error->type);

    }
    public function test_method_mget_result_json()
    {
        $result=json_decode($this->client()->mget(
            [
                ['_index'=>'Shop','_id'=>"XJpOK4MBTnEkpFWFcXiF"],
                ['_index'=>'shop','_id'=>"Y5pOK4MBTnEkpFWFcnhg"]
            ]
        ));
        $this->assertJson(json_encode($result)); //an assertion

    }



}
