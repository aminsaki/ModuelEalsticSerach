<?php

namespace Holoo\ModuleElasticsearch\Test\Feature;

use Holoo\ModuleElasticsearch\Test\Traits\ServicesTraits;
use Holoo\ModuleElasticsearch\Tests\TestCase;

class InfoTest extends TestCase
{

    public function test_method_info_not_empty()
    {
        $result=json_decode($this->client()->info(), true);

        $this->assertNotEmpty($result);
    }

    public function test_method_info_json()
    {
        $result=json_decode($this->client()->index('index', 'my18888448', ['body'=>"this is one test"]), true);

        $this->assertJson(json_encode($result));
    }


}
