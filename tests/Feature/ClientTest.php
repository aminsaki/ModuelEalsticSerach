<?php


namespace Holoo\ModuleElasticsearch\Test\Feature;


use Holoo\ModuleElasticsearch\Adapter\ElasticClient;
use Holoo\ModuleElasticsearch\Tests\TestCase;

class ClientTest extends TestCase
{

    public function test_method_send_request_client()
    {
        $client=new ElasticClient();
        $method='GET';
        $url='/';

        $headers=[
            'Authorization'=>"ApiKey " . config('elastic.apiKey'),
            'Accept'=>'application/json',
            'Content-Type'=>'application/json',
        ];
        $result=$client->send($method, $url, null, $headers, null);
        $this->assertJson($result);
    }

    public function test_method_send_request_client_faild()
    {
        $client=new ElasticClient();
        $method='GET';
        $url='/not url';

        $headers=[
            'Authorization'=>"ApiKey " . config('elastic.apiKey'),
            'Accept'=>'application/json',
            'Content-Type'=>'application/json',
        ];
        $result=$client->send($method, $url, null, $headers, null);
        $result=json_decode($result, true);
        $this->assertEquals('404', $result['status']);
    }


    public function test_method_send_request_client_faild_https()
    {
        $client=new ElasticClient();
        $method='GET';
        $url='/not url';

        $headers=[
//            'Authorization'=>"ApiKey " . config('elastic.apiKey'),
            'Accept'=>'application/json',
            'Content-Type'=>'application/json',
        ];
        $result=$client->send($method, $url, null, $headers, null);
        $result=json_decode($result, true);
        $this->assertEquals('401', $result['status']);
    }

}
