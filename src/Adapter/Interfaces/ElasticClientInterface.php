<?php


namespace Holoo\ModuleElasticsearch\Adapter\Interfaces;

interface ElasticClientInterface
{
    /**
     * This method is to send information from an outgoing service
     * @param string|null $method
     * @param string|null $url
     * @param array|null $params
     * @param array|null $header
     * @return mixed
     */
    public  function send(string $method=null, string $url=null, array $params=null, array $header=null, $type= null);
}
