<?php


namespace Holoo\ModuleElasticsearch\Test\Unit\InfoElastic;


use Holoo\ModuleElasticsearch\Tests\TestCase;

class NotEmptyTest extends  TestCase
{

    public function test_method_info_not_empty()
    {
        $result=json_decode($this->client()->info("aminsda"), true);

        $this->assertNotEmpty($result);
    }

}
