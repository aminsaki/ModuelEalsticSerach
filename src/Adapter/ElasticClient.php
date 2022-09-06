<?php

namespace Holoo\ModuleElasticsearch\Adapter;

use Holoo\ModuleElasticsearch\Adapter\Interfaces\ClientAdapterInterface;

class ElasticClient extends Client implements ClientAdapterInterface
{
    const DEFAULT_HOST='http://localhost:9200';


    private string  $apiKey;

    /**
     * Make the constructor final so cannot be overwritten
     */
    final public function __construct()
    {
    }

    /**
     * @return ElasticClient
     */
    public static function create(): ElasticClient
    {
        return new static();
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
            if ( isset($params[$k]) ) {
                $queryParams[$k]=self::convertValue($params[$k]);
            }
        }
        if ( empty($queryParams) ) {
            return $url;
        }
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
        } elseif ( is_array($value) && self::isNestedArray($value) === false ) {
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
        return urlencode(self::convertValue($value));
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
     * @param $header
     * @return mixed
     */
    public function setHeader($header): mixed
    {
        if ( !empty($this->apiKey) ) {
            return $this->setHeaders($this->apiKey);
        }
        if ( !empty(config('elastic.apiKet')) ) {
            return $this->setHeaders(config('elastic.apiKet'));
        }

        if ( !empty($header) ) {
            return $header;
        }

        return $headers=[
            'Accept'=>'application/json',
            'Content-Type'=>'application/json',
        ];
    }

    /**
     * Set the hosts (nodes)
     * @param $host
     * @return string
     */
    public function setHost($host=null): string
    {

        if ( !empty(config('elastic')) ) {
            return config('elastic.host');
        }

        if ( !empty($host) ) {
            return $host;
        }

        return $this->DEFAULT_HOST;
    }

    /**
     * @param $url
     * @return string
     */
    public function setUrl(string $url): string
    {
        return $this->setHost() . $url;
    }

    /**
     * @param string|null $param
     * @return array|string[]
     */
    public function setHeaders(?string $param): array
    {
        return $headers=[
            'Authorization'=>"ApiKey " . $param,
            'Accept'=>'application/json',
            'Content-Type'=>'application/json',
        ];
    }


}
