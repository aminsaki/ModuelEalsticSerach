<?php


namespace Holoo\ModuleElasticsearch\Test\Unit\InfoElastic;


use Holoo\ModuleElasticsearch\Tests\TestCase;

class CheckVersion extends  TestCase
{
    public function test_method_info_check_version()
    {
        $result=json_decode($this->client()->info(), true);

        $this->assertEquals("8.3.3", $result['version']['number']);

    }
}
