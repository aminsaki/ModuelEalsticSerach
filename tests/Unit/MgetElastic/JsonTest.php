<?php


namespace Holoo\ModuleElasticsearch\Test\Unit\MgetElastic;


use Holoo\ModuleElasticsearch\Tests\TestCase;

class JsonTest extends TestCase
{
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
