<?php

namespace Holoo\ModuleElasticsearch\Traits;

trait ClientEndpointsTrait
{
    /**
     * Returns basic information about the cluster.
     * @return mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function info()
    {
        $method='GET';
        $url='/';
        return $this->send($method, $url, null, $this->getHeader(), null);
    }

    public function lists(string $index)
    {
        $url='/' . $this->encode($index) . '/_search';
        $method='GET';
        return $this->send($method, $url, null, $this->getHeader(), null);
    }

    /**
     * @param string|null $index
     * @param string|null $id
     * @param array|null $body
     * @return mixed
     */
    public function index(string $index=null, string $id=null, array $body=null)
    {
        $params=$this->setDataIndex($index, $id, $body);
        $this->checkRequiredParameters(['index', 'body'], $params);

        if ( isset($params['id']) ) {
            $url='/' . $this->encode($params['index']) . '/_doc/' . $this->encode($params['id']);
            $method='PUT';
        } else {
            $url='/' . $this->encode($params['index']) . '/_doc';
            $method='POST';
        }
        $url=$this->addQueryString($url, $params, ['wait_for_active_shards', 'op_type', 'refresh', 'routing', 'timeout', 'version', 'version_type', 'if_seq_no', 'if_primary_term', 'pipeline', 'require_alias', 'pretty', 'human', 'error_trace', 'source', 'filter_path']);
        return $this->send($method, $url, $params['body'], $this->getHeader(), null);
    }

    /**
     * Updates the index mappings.
     * @param string $index
     * @param array $mapping
     * @return mixed
     */
    public function putMapping(string $index, array $mapping=[])
    {
        $params=$this->setDataputMapping($index, $mapping);
        $this->checkRequiredParameters(['index', 'body'], $params);
        $url='/' . $this->encode($params['index']) . '/_mapping';
        $method='PUT';
        $url=$this->addQueryString($url, $params, ['timeout', 'master_timeout', 'ignore_unavailable', 'allow_no_indices', 'expand_wildcards', 'write_index_only', 'pretty', 'human', 'error_trace', 'source', 'filter_path']);
        return $this->send($method, $url, $params['body'], $this->getHeader(), null);
    }

    /**
     *Returns results matching a query.
     * @param array $params
     * @return mixed
     */
    public function search(string $index=null, string $key, string $val)
    {
        $params=$this->setDataSerach($index, $key, $val);
        if ( isset($params['index']) ) {
            $url='/' . $this->encode($params['index']) . '/_search';
            $method=empty($params['body']) ? 'GET' : 'POST';
        } else {
            $url='/_search';
            $method=empty($params['body']) ? 'GET' : 'POST';
        }
        $url=$this->addQueryString($url, $params, ['analyzer', 'analyze_wildcard', 'ccs_minimize_roundtrips', 'default_operator', 'df', 'explain', 'stored_fields', 'docvalue_fields', 'from', 'ignore_unavailable', 'ignore_throttled', 'allow_no_indices', 'expand_wildcards', 'lenient', 'preference', 'q', 'routing', 'scroll', 'search_type', 'size', 'sort', '_source', '_source_excludes', '_source_includes', 'terminate_after', 'stats', 'suggest_field', 'suggest_mode', 'suggest_size', 'suggest_text', 'timeout', 'track_scores', 'track_total_hits', 'allow_partial_search_results', 'typed_keys', 'version', 'seq_no_primary_term', 'request_cache', 'batched_reduce_size', 'max_concurrent_shard_requests', 'pre_filter_shard_size', 'rest_total_hits_as_int', 'min_compatible_shard_node', 'pretty', 'human', 'error_trace', 'source', 'filter_path']);

        return $this->send($method, $url, $params['body'], $this->getHeader(), null);
    }

    /**
     * Returns a document.
     * @param array $params
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $index, $id)
    {
        $params=$this->setDataGet($index, $id);
        $this->checkRequiredParameters(['id', 'index'], $params);
        $url='/' . $this->encode($params['index']) . '/_doc/' . $this->encode($params['id']);
        $method='GET';

        $url=$this->addQueryString($url, $params, ['stored_fields', 'preference', 'realtime', 'refresh', 'routing', '_source', '_source_excludes', '_source_includes', 'version', 'version_type', 'pretty', 'human', 'error_trace', 'source', 'filter_path']);

        return $this->send($method, $url, null, $this->getHeader(), null);
    }

    /**
     * Updates a document with a script or partial document.
     * @param array $params
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function update(string $index=null, string $id, array $body)
    {
        $params=$this->setDataUpdate($index, $id, $body);

        $this->checkRequiredParameters(['id', 'index', 'body'], $params);
        $url='/' . $this->encode($params['index']) . '/_update/' . $this->encode($params['id']);
        $method='POST';

        $url=$this->addQueryString($url, $params, ['wait_for_active_shards', '_source', '_source_excludes', '_source_includes', 'lang', 'refresh', 'retry_on_conflict', 'routing', 'timeout', 'if_seq_no', 'if_primary_term', 'require_alias', 'pretty', 'human', 'error_trace', 'source', 'filter_path']);

        return $this->send($method, $url, $params['body'], $this->getHeader(), null);
    }

    /**
     *  Performs an update on every document in the index without changing the source,
     * for example to pick up a mapping change.
     * @param array $params
     * @return mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updateByQuery(string $index=null, string $name, string $value)
    {
        $params=$this->setDataUpdateQuery($index=null, $name, $value);
        $this->checkRequiredParameters(['index'], $params);
        $url='/' . $this->encode($params['index']) . '/_update_by_query';
        $method='POST';

        $url=$this->addQueryString($url, $params, ['analyzer', 'analyze_wildcard', 'default_operator', 'df', 'from', 'ignore_unavailable', 'allow_no_indices', 'conflicts', 'expand_wildcards', 'lenient', 'pipeline', 'preference', 'q', 'routing', 'scroll', 'search_type', 'search_timeout', 'max_docs', 'sort', 'terminate_after', 'stats', 'version', 'version_type', 'request_cache', 'refresh', 'timeout', 'wait_for_active_shards', 'scroll_size', 'wait_for_completion', 'requests_per_second', 'slices', 'pretty', 'human', 'error_trace', 'source', 'filter_path']);

        return $this->send($method, $url, $params['body'], $this->getHeader(), null);
    }

    /**
     * Removes a document from the index.
     * @param string $index
     * @param string $id
     * @return mixed
     */
    public function delete(string $index, string $id)
    {
        $params=$this->setDataDelete($index, $id);
        $this->checkRequiredParameters(['id', 'index'], $params);
        $url='/' . $this->encode($params['index']) . '/_doc/' . $this->encode($params['id']);
        $method='DELETE';

        $url=$this->addQueryString($url, $params, ['wait_for_active_shards', 'refresh', 'routing', 'timeout', 'if_seq_no', 'if_primary_term', 'version', 'version_type', 'pretty', 'human', 'error_trace', 'source', 'filter_path']);

        return $this->send($method, $url, null, $this->getHeader(), null);
    }

    /**
     * Deletes documents matching the provided query.
     * @param array $params
     * @return mixed
     */
    public function deleteByQuery($index, $params)
    {
        $params=$this->setDataDeleteQuery($index, $params);
        $this->checkRequiredParameters(['index', 'body'], $params);
        $url='/' . $this->encode($params['index']) . '/_delete_by_query';
        $method='POST';

        $url=$this->addQueryString($url, $params, ['analyzer', 'analyze_wildcard', 'default_operator', 'df', 'from', 'ignore_unavailable', 'allow_no_indices', 'conflicts', 'expand_wildcards', 'lenient', 'preference', 'q', 'routing', 'scroll', 'search_type', 'search_timeout', 'max_docs', 'sort', 'terminate_after', 'stats', 'version', 'request_cache', 'refresh', 'timeout', 'wait_for_active_shards', 'scroll_size', 'wait_for_completion', 'requests_per_second', 'slices', 'pretty', 'human', 'error_trace', 'source', 'filter_path']);

        return $this->send($method, $url, $params['body'], $this->getHeader(), null);
    }

    /**
     * Allows to get multiple documents in one request.
     * @param string $index
     * @param string $id
     * @return mixed
     */
    public function mget(array $params)
    {
        $params=$this->setDataMget($params);
        $this->checkRequiredParameters(['body'], $params);
        if ( isset($params['index']) ) {
            $url='/' . $this->encode($params['index']) . '/_mget';
            $method=empty($params['body']) ? 'GET' : 'POST';
        } else {
            $url='/_mget';
            $method=empty($params['body']) ? 'GET' : 'POST';
        }
        $url=$this->addQueryString($url, $params, ['stored_fields', 'preference', 'realtime', 'refresh', 'routing', '_source', '_source_excludes', '_source_includes', 'pretty', 'human', 'error_trace', 'source', 'filter_path']);

        return $this->send($method, $url, $params['body'], $this->getHeader(), null);
    }

    /**
     * Executes a SQL request
     * @param array $params
     * @return mixed
     */
    public function query(string $query_sql)
    {
        $params=$this->setDataQuery($query_sql);
        $this->checkRequiredParameters(['body'], $params);
        $url='/_sql';
        $method=empty($params['body']) ? 'GET' : 'POST';

        $url=$this->addQueryString($url, $params, ['format', 'pretty', 'human', 'error_trace', 'source', 'filter_path']);

        return $this->send($method, $url, $params['body'], $this->getHeader(), null);
    }

    /***
     * Allows to perform multiple index/update/delete operations in a single request.
     * @param string $index
     * @param array $body
     * @param string $action
     * @return mixed
     */
    public function bulk(string $index, array $body, string $action)
    {
        $params=$this->setDataBulk($index, $body, $action);
        $this->checkRequiredParameters(['body'], $params);

        if ( isset($params['index']) ) {
            $url='/' . $this->encode($params['index']) . '/_bulk';
            $method='POST';
        } else {
            $url='/_bulk';
            $method='POST';
        }
        $url=$this->addQueryString($url, $params, ['wait_for_active_shards', 'refresh', 'routing', 'timeout', 'type', '_source', '_source_excludes', '_source_includes', 'pipeline', 'require_alias', 'pretty', 'human', 'error_trace', 'source', 'filter_path']);

        $headers=array_merge($this->getHeader(), ['Content-Type'=>'application/x-ndjson']);

        return $this->send($method, $url, $params['body'], $headers, 'bulk');
    }

    /**
     * /**
     * Allows to copy documents from one index to another, optionally filtering the source
     * documents by a query, changing the destination index settings, or fetching the
     * documents from a remote cluster.
     * @param array $params
     * @return mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function reindex(string $source, string $dest)
    {
        $params=$this->setDataReindex($source, $dest);
        $this->checkRequiredParameters(['body'], $params);
        $url='/_reindex';
        $method='POST';

        $url=$this->addQueryString($url, $params, ['refresh', 'timeout', 'wait_for_active_shards', 'wait_for_completion', 'requests_per_second', 'scroll', 'slices', 'max_docs', 'pretty', 'human', 'error_trace', 'source', 'filter_path']);

        return $this->send($method, $url, $params['body'], $this->getHeader(), null);
    }

    /**
     * Returns multiple termvectors in one request.
     * @param $index
     * @param $id
     * @param $idTwo
     * @param $fields
     * @param $term_statistics
     * @return mixed
     */
    public function mtermvectors($index, $id, $idTwo, $fields, $term_statistics=null)
    {
        $params=$this->setDataMtermvectors($index, $id, $idTwo, $fields, $term_statistics);
        if ( isset($params['index']) ) {
            $url='/' . $this->encode($params['index']) . '/_mtermvectors';
            $method=empty($params['body']) ? 'GET' : 'POST';
        } else {
            $url='/_mtermvectors';
            $method=empty($params['body']) ? 'GET' : 'POST';
        }
        $url=$this->addQueryString($url, $params, ['ids', 'term_statistics', 'field_statistics', 'fields', 'offsets', 'positions', 'payloads', 'preference', 'routing', 'realtime', 'version', 'version_type', 'pretty', 'human', 'error_trace', 'source', 'filter_path']);

        return $this->send($method, $url, $params['body'], $this->getHeader(), null);
    }

}
