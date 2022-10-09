<?php

namespace Holoo\ModuleElasticsearch\Adapter;

use Holoo\ModuleElasticsearch\Traits\ClientEndpointsTrait;
use Holoo\ModuleElasticsearch\Traits\SetValueTrait;


class   ElasticClient extends Client
{
    use ClientEndpointsTrait, SetValueTrait;

    const DEFAULT_HOST='http://localhost:9200';

    protected string  $apiKey;

    /**
     * ElasticClient constructor.
     */
    /**
     * @return ElasticClient
     */
    public static function create(): ElasticClient
    {
        return new static();
    }

    /**
     * @param $result
     * @return mixed
     */
    public function resultHit($result): mixed
    {
        $list=[];

        $result=json_decode($result, true);

        if ( isset($result->error) ) return response()->json($result->error->reason);


        if ( isset($result['result']) ) {
            $result="This information has been {$result['result']} successfully";
            return response()->json($result);
        }


        if ( !empty($result->hits->hits) ) {

            foreach($result['hits']['hits'] as $key=>$value) $list[]=$value['_source'];

            if ( !empty($list) ) return json_decode($list, true);
        }

        return $result;
    }

    /**
     * @param array|null $header
     * @return array|string[]
     */
    public function getHeader(array $header=null): array
    {
        if ( !empty($this->apiKey) ) return $this->setHeaders($this->apiKey);

        if ( !empty(config('elastic.apiKey')) ) return $this->setHeaders(config('elastic.apiKey'));

        if ( !empty($header) ) return $header;


        return $this->headers=[
            'Accept'=>'application/json',
            'Content-Type'=>'application/json',
        ];
    }

    /**
     * @param string|null $param
     * @return array|string[]
     */
    private function setHeaders(?string $param): array
    {
        return [
            'Authorization'=>"ApiKey " . $param,
            'Accept'=>'application/json',
            'Content-Type'=>'application/json',

        ];
    }

    /**
     * Set the ApiKey
     * If the id is not specified we store the ApiKey otherwise
     * we store as Base64(id:ApiKey)
     *
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/security-api-create-api-key.html
     */
    public function setApiKey(string $apiKey=null, string $id=null): ElasticClient
    {
        (empty($id)) ? $this->apiKey=$apiKey : $this->apiKey=base64_encode($id . ':' . $apiKey);

        return $this;
    }

    /**
     * @param $url
     * @return string
     */
    protected function setUrl(string $url): string
    {
        return $this->setHost() . $url;
    }

    /**
     * Set the hosts (nodes)
     * @param $host
     * @return string
     */
    public function setHost(string $host=null): string
    {
        if ( !empty(config('elastic')) ) {
            return config('elastic.host');
        }

        return (!empty($host)) ? $host : self::DEFAULT_HOST;
    }

    /**
     * @param string $url
     * @param array $params
     * @param array $keys
     * @return string
     */
    protected function addQueryString(string $url, array $params, array $keys): string
    {
        $queryParams=[];

        foreach($keys as $k) {
            if ( isset($params[$k]) ) $queryParams[$k]=$this->convertValue($params[$k]);
        }


        if ( empty($queryParams) ) return $url;

        return $url . '?' . http_build_query($queryParams);
    }

    /**
     * Converts array to comma-separated list;
     * Converts boolean value to true', 'false' string
     *
     * @param mixed $value
     */
    protected function convertValue($value): string
    {
        // Convert a boolean value in 'true' or 'false' string
        if ( is_bool($value) ) {
            return $value ? 'true' : 'false';
            // Convert to comma-separated list if array
        } elseif ( is_array($value) && $this->isNestedArray($value) === false ) {
            return implode(',', $value);
        }
        return (string)$value;
    }

    /**
     * @param array $a
     * @return bool
     */
    private function isNestedArray(array $a): bool
    {
        foreach($a as $v) {
            if ( is_array($v) ) {
                return true;
            }
        }
        return false;
    }

    /**
     * Check if the $required parameters are present in $params
     * @throws MissingParameterException
     */
    protected function checkRequiredParameters(array $required, array $params): void
    {
        foreach($required as $req) {
            if ( !isset($params[$req]) ) {
                throw new MissingParameterException(sprintf(
                    'The parameter %s is required',
                    $req
                ));
            }
        }
    }

    /**
     * Encode a value for a valid URL
     *
     * @param mixed $value
     */
    protected function encode($value): string
    {
        return urlencode($this->convertValue($value));
    }
}
