<?php


namespace Holoo\ModuleElasticsearch\Traits;

/**
 *  TODO  This section should be refactor
 */
trait SetValueTrait
{
    /**
     * @param string $index
     * @param array $mapping
     * @return array|array[]
     */
    public static function setDataputMapping(string $index, array $mapping=[]): array
    {
        $params=[
            'index'=>$index,
            "body"=>[
                '_source'=>[
                    'enabled'=>true
                ],
                'properties'=>$mapping
            ]
        ];

        return $params;
    }

    /*
    * @param string|null $index
    * @param string|null $id
    * @param array|null $body
    * @return mixed
    */
    public function setDataIndex(string $index=null, string $id=null, array $body=null): mixed
    {
        $params['index']=$index;
        $params['id']=isset($id) ? $id : "";
        $params['body']=$body;
        return $params;
    }

    /**
     * @param string|null $index
     * @param string $id
     * @param array|null $body
     * @return mixed
     */
    public function setDataUpdate(string $index=null, string $id, array $body=null): mixed
    {
        $params['index']=$index;
        $params['id']=$id;
        $params['body']['doc']=$body;
        return $params;
    }

    /**
     * @param string $index
     * @param string $id
     * @return mixed
     */
    public function setDataDelete(string $index, string $id): mixed
    {
        $params['index']=$index;
        $params['id']=$id;
        return $params;
    }

    /**
     * @param array $params
     * @return array
     */
    public function setDataMget(array $params): mixed
    {
        $params["body"]['docs']=$params;
        return $params;
    }

    /**
     * @param string|null $index
     * @param string $key
     * @param string $val
     */
    public function setDataSerach(string $index=null, string $key, string $val): mixed
    {
        $params['index']=$index;
        $params['body']['query']['match'][$key]=$val;
        return $params;
    }

    /***
     * @param string $query
     * @return \string[][]
     */
    public function setDataQuery(string $query): mixed
    {
        $params=[
            'body'=>array(
                'query'=>$query
            )
        ];
        return $params;
    }

    /**
     * @param string $source
     * @param string $dest
     * @return \string[][][]
     */
    public function setDataReindex(string $source, string $dest): mixed
    {
        $params=[
            'body'=>[
                "source"=>[
                    'index'=>$source
                ],
                'dest'=>[
                    'index'=>$dest
                ]
            ]
        ];
        return $params;
    }

    /**
     * @param $index
     * @param string $name
     * @param string $value
     * @return array
     */
    public function setDataUpdateQuery($index, string $name, string $value): mixed
    {
        $params=[
            'index'=>!empty($index) ? $index : "_all",
            'body'=>[
                'query'=>[
                    'match_all'=>(object)[] // this cast is necessary!
                ],
                "script"=>[
                    "inline"=>"ctx._source.${name}= params.value",
                    "params"=>[
                        "${name}"=>$value
                    ]
                ]
            ]
        ];
        return $params;
    }

    /***
     * @param $index
     * @param array $param
     * @return array
     */
    public function setDataDeleteQuery($index, array $param): mixed
    {
        $params=[
            'index'=>'user',
            'body'=>[
                'query'=>[
                    "term"=>$param
                ]
            ]
        ];
        return $params;
    }

    /**
     * @param string $index
     * @param array $body
     * @param string $action
     */
    public function setDataBulk(string $index, array $body, string $action)
    {
        $action=!empty($action) ? $action : "index";
        $params['body'][]=[
            "${action}"=>[
                '_index'=>$index,
            ]
        ];
        $params['body'][]=$body;

        return $params;
    }

    /**
     * @param $index
     * @param $id
     * @param $idTwo
     * @param $fields
     * @param bool $term_statistics
     * @return array|\array[][][]
     */
    public function setDataMtermvectors($index, $id, $idTwo, $fields, $term_statistics): array
    {
        $params=[
            "body"=>[
                "docs"=>[
                    [
                        "_index"=>$index,
                        "_id"=>"$id",
                        "term_statistics"=>$term_statistics ? $term_statistics : true
                    ],
                    [
                        "_index"=>$index,
                        "_id"=>$idTwo,
                        "fields"=>[$fields]
                    ]
                ]
            ]
        ];
        return $params;
    }


}
