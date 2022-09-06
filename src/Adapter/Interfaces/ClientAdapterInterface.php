<?php

namespace Holoo\ModuleElasticsearch\Adapter\Interfaces;


interface ClientAdapterInterface
{
    /**
     * @param array $params
     * @return mixed
     */
    public  function info(array $params=[]);

    /**
     * @param array $params
     * @return mixed
     */
    public  function index(array $params=[]);

    /**
     * @param array $params
     * @return mixed
     */
    public  function search(array $params=[]);

    /**
     * @param array $params
     * @return mixed
     */
    public  function updateByQuery(array $params=[]);

    /**
     * @param array $params
     * @return mixed
     */
    public  function update(array $params=[]);

    /**
     * @param array $params
     * @return mixed
     */
    public  function get(array $params=[]);

    /**
     * @param array $params
     * @return mixed
     */
    public  function query(array $params=[]);

    /**
     * @param array $params
     * @return mixed
     */
    public  function delete(array $params=[]);

    /**
     * @param array $params
     * @return mixed
     */
    public  function bulk(array $params=[]);

    /**
     * @param array $params
     * @return mixed
     */
    public  function deleteByQuery(array $params=[]);

    /**
     * @param array $params
     * @return mixed
     */
    public  function mget(array $params=[]);

    /**
     * @param array $params
     * @return mixed
     */
    public  function reindex(array $params=[]);

}
