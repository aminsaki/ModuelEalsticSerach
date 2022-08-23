<?php

namespace Holoo\ModuleElasticsearch\Adapter;

use Elastic\Elasticsearch\Exception\MissingParameterException;
use Holoo\ModuleElasticsearch\Adapter\Interfaces\ElasticClientInterface;
use http\Client\Response;

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
    public static function send($method="get", string $host=null, array $params=null, array $header=null)
    {
        try {
            $client=new \GuzzleHttp\Client([
                'headers'=>['Content-Type'=>'application/json', 'Accept'=>'application/json']
            ]);
            $response=self::getResponse($client, $method, $host, $params);
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
        if ( !empty($header) ) {
            return $header;
        }
        return $header=['Content-Type:application/json', 'Accept: application/json'];
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
    private static function getResponse(\GuzzleHttp\Client $client, string $method, ?string $host, ?array $params): \Psr\Http\Message\ResponseInterface
    {
        if ( !empty($params) ) {
            return $client->request($method, self::setHost($host),
                [
                    'body'=>json_encode($params),
                ]
            );
        }
        return $client->request(strtoupper($method), self::setHost($host));
    }

}
