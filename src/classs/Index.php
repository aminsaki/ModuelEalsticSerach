<?php


namespace Holoo\ModuleElasticsearch;


use Holoo\ModuleElasticsearch\Traits\ClientEndpointsTrait;

class Index
{
   use ClientEndpointsTrait;


    protected array $settings=[];

    protected array $mappings=[];

    protected array  $analyzer=[];

    protected array  $body= [];

//    public function __construct($body , $mappings , $analyzer , $settings)
//    {
//        $this->body =  $body;
//        $this->body =  $mappings;
//        $this->body =  $analyzer;
//        $this->body =  $settings;
//
//    }


}
