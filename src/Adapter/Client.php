<?php

namespace Holoo\ModuleElasticsearch\Adapter;

use Elastic\Elasticsearch\Exception\MissingParameterException;
use Holoo\ModuleElasticsearch\Adapter\Interfaces\ElasticClientInterface;

class Client implements ElasticClientInterface
{

    const DEFAULT_HOST='localhost:9200';

    /**
     * @param string $method
     * @param string|null $host
     * @param array|null $params
     * @param array|null $header
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function send($method="get", string $host=null, array $params=null, array $header=null, $type=null)
    {
        try {
            $client=new \GuzzleHttp\Client([
                'http_errors'=>false,
                'verify'=>false,
                'headers'=>self::setHeader($header)

            ]);
            $response=self::getResponse($client, $method, $host, $params, $type);
            $response=$response->getBody()->getContents();
            return $response;

        } catch (GuzzleException  $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    /**
     * @param $header
     * @return mixed
     */
    private static function setHeader($header): mixed
    {
        if ( !empty($header) )
            return $header;


        return $headers=[
            'Accept'=>'application/json',
            'Content-Type'=>'application/json',
        ];
    }

    /**
     * @param $host
     * @return string
     */
    private static function setHost($host): string
    {
        return (!empty($host)) ? self::DEFAULT_HOST . $host : self::DEFAULT_HOST;
    }

    /**
     * @param \GuzzleHttp\Client $client
     * @param string $method
     * @param string|null $host
     * @param string|null $params
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private static function getResponse(\GuzzleHttp\Client $client, string $method, ?string $host, ?array $params, ?string $type): \Psr\Http\Message\ResponseInterface
    {

        if ( !empty($type) || $type == "bulk" ) {
            return self::requestBody($client, $method, $host, join("\n", self::RequestArrayMethod($params)) . "\n");
        }

        if ( !empty($params) ) {
            return self::requestBody($client, $method, $host, json_encode($params));
        }

        return $client->request(strtoupper($method), self::setHost($host));
    }

    /**
     * @param \GuzzleHttp\Client $client
     * @param string $method
     * @param string|null $host
     * @param $params
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private static function requestBody(\GuzzleHttp\Client $client, string $method, ?string $host, $params): \Psr\Http\Message\ResponseInterface
    {
        return $client->request($method, self::setHost($host),
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
    private static function RequestArrayMethod($params)
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
