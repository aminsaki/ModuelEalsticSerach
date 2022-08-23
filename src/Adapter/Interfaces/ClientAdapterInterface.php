<?php

namespace Holoo\ModuleElasticsearch\Adapter\Interfaces;


interface ClientAdapterInterface
{

    /**
     * @param array $params
     * @return mixed
     */
   public  function info(array $params = []);

    /**
     * @param array $params
     * @return mixed
     */
   public  function  index(array $params = []);
}
