<?php

namespace Holoo\ModuleElasticsearch\Adapter\Interfaces;


interface ClientAdapterInterface
{
    /**
     * @param array $params
     * @return mixed
     */
    public static function info(array $params=[]);

    /**
     * @param array $params
     * @return mixed
     */
    public static function index(array $params=[]);

    /**
     * @param array $params
     * @return mixed
     */
    public static function search(array $params=[]);

    /**
     * @param array $params
     * @return mixed
     */
    public static function updateByQuery(array $params=[]);

    /**
     * @param array $params
     * @return mixed
     */
    public static function update(array $params=[]);

    /**
     * @param array $params
     * @return mixed
     */
    public static function get(array $params=[]);

    /**
     * @param array $params
     * @return mixed
     */
    public static function query(array $params=[]);

    /**
     * @param array $params
     * @return mixed
     */
    public static function delete(array $params=[]);

    /**
     * @param array $params
     * @return mixed
     */
    public static function bulk(array $params=[]);

    /**
     * @param array $params
     * @return mixed
     */
    public static function deleteByQuery(array $params=[]);

    /**
     * @param array $params
     * @return mixed
     */
    public static function mget(array $params=[]);

    /**
     * @param array $params
     * @return mixed
     */
    public static function reindex(array $params=[]);

}
