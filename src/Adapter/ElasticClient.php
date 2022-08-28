<?php

namespace Holoo\ModuleElasticsearch\Adapter;

use Holoo\ModuleElasticsearch\Adapter\Interfaces\ClientAdapterInterface;
use Holoo\ModuleElasticsearch\Traits\ClientEndpointsTrait;

class ElasticClient extends Client implements ClientAdapterInterface
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
        $url='/';
        return self::send($method, $url, null, null,null);
    }

    /**
     *  Performs a kNN search.
     * @param array $params
     * @return mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function index(array $params=[])
    {
        self::checkRequiredParameters(['index', 'body'], $params);

        if ( isset($params['id']) ) {
            $url='/' . self::encode($params['index']) . '/_doc/' . self::encode($params['id']);
            $method='PUT';
        } else {
            $url='/' . self::encode($params['index']) . '/_doc';
            $method='POST';
        }
        $url=self::addQueryString($url, $params, ['wait_for_active_shards', 'op_type', 'refresh', 'routing', 'timeout', 'version', 'version_type', 'if_seq_no', 'if_primary_term', 'pipeline', 'require_alias', 'pretty', 'human', 'error_trace', 'source', 'filter_path']);

        return self::send($method, $url, $params['body'], null ,null);
    }

    /**
     *Returns results matching a query.
     * @param array $params
     * @return mixed
     */
    public static function search(array $params=[])
    {
        if ( isset($params['index']) ) {
            $url='/' . self::encode($params['index']) . '/_search';
            $method=empty($params['body']) ? 'GET' : 'POST';
        } else {
            $url='/_search';
            $method=empty($params['body']) ? 'GET' : 'POST';
        }
        $url=self::addQueryString($url, $params, ['analyzer', 'analyze_wildcard', 'ccs_minimize_roundtrips', 'default_operator', 'df', 'explain', 'stored_fields', 'docvalue_fields', 'from', 'ignore_unavailable', 'ignore_throttled', 'allow_no_indices', 'expand_wildcards', 'lenient', 'preference', 'q', 'routing', 'scroll', 'search_type', 'size', 'sort', '_source', '_source_excludes', '_source_includes', 'terminate_after', 'stats', 'suggest_field', 'suggest_mode', 'suggest_size', 'suggest_text', 'timeout', 'track_scores', 'track_total_hits', 'allow_partial_search_results', 'typed_keys', 'version', 'seq_no_primary_term', 'request_cache', 'batched_reduce_size', 'max_concurrent_shard_requests', 'pre_filter_shard_size', 'rest_total_hits_as_int', 'min_compatible_shard_node', 'pretty', 'human', 'error_trace', 'source', 'filter_path']);

        return self::send($method, $url, $params['body'], null ,null);
    }

    /**
     * Returns a document.
     * @param array $params
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function get(array $params=[])
    {
        self::checkRequiredParameters(['id', 'index'], $params);
        $url='/' . self::encode($params['index']) . '/_doc/' . self::encode($params['id']);
        $method='GET';

        $url=self::addQueryString($url, $params, ['stored_fields', 'preference', 'realtime', 'refresh', 'routing', '_source', '_source_excludes', '_source_includes', 'version', 'version_type', 'pretty', 'human', 'error_trace', 'source', 'filter_path']);

        return self::send($method, $url, $params['body'], null , null);
    }

    /**
     * Updates a document with a script or partial document.
     * @param array $params
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function update(array $params=[])
    {
        self::checkRequiredParameters(['id', 'index', 'body'], $params);
        $url='/' . self::encode($params['index']) . '/_update/' . self::encode($params['id']);
        $method='POST';

        $url=self::addQueryString($url, $params, ['wait_for_active_shards', '_source', '_source_excludes', '_source_includes', 'lang', 'refresh', 'retry_on_conflict', 'routing', 'timeout', 'if_seq_no', 'if_primary_term', 'require_alias', 'pretty', 'human', 'error_trace', 'source', 'filter_path']);

        return self::send($method, $url, $params['body'], null , null);
    }

    /**
     *  Performs an update on every document in the index without changing the source,
     * for example to pick up a mapping change.
     * @param array $params
     * @return mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function updateByQuery(array $params=[])
    {
        self::checkRequiredParameters(['index'], $params);
        $url='/' . self::encode($params['index']) . '/_update_by_query';
        $method='POST';

        $url=self::addQueryString($url, $params, ['analyzer', 'analyze_wildcard', 'default_operator', 'df', 'from', 'ignore_unavailable', 'allow_no_indices', 'conflicts', 'expand_wildcards', 'lenient', 'pipeline', 'preference', 'q', 'routing', 'scroll', 'search_type', 'search_timeout', 'max_docs', 'sort', 'terminate_after', 'stats', 'version', 'version_type', 'request_cache', 'refresh', 'timeout', 'wait_for_active_shards', 'scroll_size', 'wait_for_completion', 'requests_per_second', 'slices', 'pretty', 'human', 'error_trace', 'source', 'filter_path']);

        return self::send($method, $url, $params['body'], null , null);
    }

    /**
     * Removes a document from the index.
     * @param array $params
     * @return mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function delete(array $params=[])
    {
        self::checkRequiredParameters(['id', 'index'], $params);
        $url='/' . self::encode($params['index']) . '/_doc/' . self::encode($params['id']);
        $method='DELETE';

        $url=self::addQueryString($url, $params, ['wait_for_active_shards', 'refresh', 'routing', 'timeout', 'if_seq_no', 'if_primary_term', 'version', 'version_type', 'pretty', 'human', 'error_trace', 'source', 'filter_path']);

        return self::send($method, $url, $params['body'], null , null);
    }

    /**
     * Executes a SQL request
     * @param array $params
     * @return mixed
     */
    public static function query(array $params=[])
    {
        self::checkRequiredParameters(['body'], $params);
        $url='/_sql';
        $method=empty($params['body']) ? 'GET' : 'POST';

        $url=self::addQueryString($url, $params, ['format', 'pretty', 'human', 'error_trace', 'source', 'filter_path']);

        return self::send($method, $url, $params['body'], null , null);
    }

    /**
     * Allows to perform multiple index/update/delete operations in a single request.
     * @param array $params
     * @return mixed
     */
    public static function bulk(array $params=[])
    {
        self::checkRequiredParameters(['body'], $params);

        if ( isset($params['index']) ) {
            $url='/' . self::encode($params['index']) . '/_bulk';
            $method='POST';
        } else {
            $url='/_bulk';
            $method='POST';
        }
        $url=self::addQueryString($url, $params, ['wait_for_active_shards', 'refresh', 'routing', 'timeout', 'type', '_source', '_source_excludes', '_source_includes', 'pipeline', 'require_alias', 'pretty', 'human', 'error_trace', 'source', 'filter_path']);

        $headers=[
            'Accept'=>'application/json',
            'Content-Type'=>'application/x-ndjson',
        ];

        return self::send($method, $url, $params['body'], $headers ,'bulk');

    }
}
