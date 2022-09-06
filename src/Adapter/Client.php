<?php

namespace Holoo\ModuleElasticsearch\Adapter;

use Elastic\Elasticsearch\Exception\MissingParameterException;
use Holoo\ModuleElasticsearch\Adapter\Interfaces\ElasticClientInterface;
use Holoo\ModuleElasticsearch\Traits\ClientEndpointsTrait;

class Client implements ElasticClientInterface
{
    use ClientEndpointsTrait;

    /**
     * @param string $method
     * @param string|null $url
     * @param array|null $params
     * @param array|null $header
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send($method="get", string $url=null, array $params=null, array $header=null, $type=null)
    {
        try {
            $client=new \GuzzleHttp\Client([
                'http_errors'=>false,
                'verify'=>false,
                'headers'=>$this->setHeader($header)
            ]);
            $response=$this->getResponse($client, $method, $url, $params, $type);
            $response=$response->getBody()->getContents();
            return $response;

        } catch (GuzzleException  $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    /**
     * @param \GuzzleHttp\Client $client
     * @param string $method
     * @param string|null $url
     * @param string|null $params
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function getResponse(\GuzzleHttp\Client $client, string $method, ?string $url, ?array $params, ?string $type): \Psr\Http\Message\ResponseInterface
    {

        if ( !empty($type) || $type == "bulk" ) {
            return $this->requestBody($client, $method, $url, join("\n", $this->RequestArrayMethod($params)) . "\n");
        }

        if ( !empty($params) ) {
            return $this->requestBody($client, $method, $url, json_encode($params));
        }

        return $client->request(strtoupper($method), $this->setUrl($url));
    }

    /**
     * @param \GuzzleHttp\Client $client
     * @param string $method
     * @param string|null $host
     * @param $params
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function requestBody(\GuzzleHttp\Client $client, string $method, ?string $url, $params): \Psr\Http\Message\ResponseInterface
    {
        return $client->request($method, $this->setUrl($url),
            [
                'body'=>$params,
            ]
        );
    }

    /**
     * Send the request to the array method
     * @param $params
     * @return array
     */
    private function RequestArrayMethod($params)
    {
        $count=count($params);

        for($i=0; $i < $count; $i++) {
            $val=$params[$i];
            $data[]=(($i % 2) == 0) ? json_encode([array_keys($val)[0]=>array_values($val)[0]]) : json_encode($val);
        }
        $result=$data;
        return $result;
    }








}
