#moduel Laravel-Elasticsearch  for laravel  9 


Build Status Total Downloads Latest Stable Version Latest Stable Version License
#Getting started 

Using this client assumes that you have an Elasticsearch server installed and running.

You can install the client in your PHP project using composer:

Once you’ve run a composer update command, you must register the Laravel service provider in your config/app.php file.


# install
Using this client assumes that you have an Elasticsearch server installed and running.

You can install the client in your PHP project using composer:
  
     ...
     // composer require holoo/module_generator
     ...



#config/app.php

 'providers' => [

     ...
     // \Holoo\ModuleElasticsearch\ServiceProvider\ModuleElasticSearchServiceProvider::class,

     ...
    
 ]
 ...
 
 #config/elastic  
 
   return [
      
       "host"=>env('ELASTICSEARCH_HOST', "http://localhost:9200"),
       "apiKet"=>env('APIKET', ''),
   
   ];
 
 
#Environment Configuration  .env
 
 Add the following code in the .env section  
 
   ...
     
    ELASTICSEARCH_HOST =https://localhost:9200
    APIKET=Qk4xUUVZTUJPem1VXzdpM3JEdms6eVdfSDcxRnlRcnlYY2NNMkNRdmFuZw==
   ...
  
  
  #exmple code  
    ... 
     
         public function info()
      {
              $result = ElasticClient::create()
                   ->info();
    
           $re =   json_decode($result , true);
           dd($re);
      } 
      
     ...   
     
 [a. link](https://www.elastic.co/guide/en/elasticsearch/client/php-api/current/index_management.html   
)
