<?php


namespace Holoo\ModuleElasticsearch\Adapter\Interfaces;

interface ElasticClientInterface
{
    /**
     * This method is to send information from an outgoing service
     * @param string|null $method
     * @param string|null $host
     * @param array|null $params
     * @param array|null $header
     * @return mixed
     */
    public static  function send(string $method = null , string $host = null, array $params = null , array $header = null);
}
