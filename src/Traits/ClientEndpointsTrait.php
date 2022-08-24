<?php


namespace Holoo\ModuleElasticsearch\Traits;


trait ClientEndpointsTrait
{
    /**
     * @param string $url
     * @param array $params
     * @param array $keys
     * @return string
     */
    protected static function addQueryString(string $url, array $params, array $keys): string
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
    protected static function convertValue($value): string
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
    private static function isNestedArray(array $a): bool
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
    protected static function checkRequiredParameters(array $required, array $params): void
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
    protected static function encode($value): string
    {
         dd($value , self::convertValue($value) ,  urlencode(self::convertValue($value)));
        return urlencode(self::convertValue($value));
    }
}
