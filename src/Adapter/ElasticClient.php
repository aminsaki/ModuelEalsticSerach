<?php

namespace Holoo\ModuleElasticsearch\Adapter;
use Elastic\Elasticsearch\ClientBuilder;
use Holoo\ModuleElasticsearch\Traits\ClientEndpointsTrait;
use Holoo\ModuleElasticsearch\Adapter\Client;

class ElasticClient extends Client
{
    use ClientEndpointsTrait;

    /**
     * Returns basic information about the cluster.
     * @return mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function info(array $params=[])
    {
        $method='GET';
        $url = '/';
        $headers=[
            'Accept'=>'application/json',
        ];
        return self::send($method, $url, null, $headers);
    }

    public static function index(array $params = [])
    {
        self::checkRequiredParameters(['index','body'], $params);

        if (isset($params['id'])) {
            $url = '/' . self::encode($params['index']) . '/_doc/' . self::encode($params['id']);
            $method = 'PUT';
        } else {
            $url = '/' . self::encode($params['index']) . '/_doc';
            $method = 'POST';
        }
        $url = self::addQueryString($url, $params, ['wait_for_active_shards','op_type','refresh','routing','timeout','version','version_type','if_seq_no','if_primary_term','pipeline','require_alias','pretty','human','error_trace','source','filter_path']);
        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
        return self::send($method , $url,$params['body'] ,$headers);

    }



}
