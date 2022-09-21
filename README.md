# moduel Laravel-Elasticsearch  for laravel  9 


Build Status Total Downloads Latest Stable Version Latest Stable Version License
# Getting started 

Using this client assumes that you have an Elasticsearch server installed and running.

You can install the client in your PHP project using composer:

Once you’ve run a composer update command, you must register the Laravel service provider in your config/app.php file.


#  install
Using this client assumes that you have an Elasticsearch server installed and running.

You can install the client in your PHP project using composer:
  
     ...
     // composer require holoo/module-elasticsearch
     ...

# config/app.php 

 'providers' => [
     ...
     // \Holoo\ModuleElasticsearch\ServiceProvider\ModuleElasticSearchServiceProvider::class,
       
     //php artisan vendor:publish --tag=elastic_serach
     ...
 ]
 # config/elastic  
   return [
      
       "host"=>env('ELASTICSEARCH_HOST', "http://localhost:9200"),
       "apiKey"=>env('APIKEY', ''), 
       
   ];
 
# Environment Configuration  .env
 
 Add the following code in the .env section  
   ...
     
    ELASTICSEARCH_HOST =https://localhost:9200
    APIKEY=""
   ...
  # exmple code   
   
   -------------------------------------------
   # index 
   //This insert is in elasticserach
     That you
     It has two sides
     The first table of names
     The second bank is an ID
     The third company is a provider that you can see
     For example : 
    ... 
    
     public function index()
       {
           $result=ElasticClient::create();
           
           $re=$result->index('index', 'my_id48848',['title'=>'test','body'=>'this is one test']);
         
           return $result->resultHit($re);
        
       } 
     ...  
    
    
   
# serach

This is for elastic search
which includes three parameters
First parameter:
The name of the table is the name you entered in the # index field

The second part is the name of the field you are going to search for

The third part is the value to be searched for

For example


    ... 
    
     public function serach()
       {
           $result=ElasticClient::create();
           $re=$result->search('index', 'title', 'test');
           $r=$result->resultHit($re);
           return $r;
       } 
     ...
     
# delete 

To delete information in Elastic Search, two must be entered
The first list is the name of the table written in the list field
Second, you entered the ID in the list field
For example


    ... 
    
     public function delete()
       {
           $result=ElasticClient::create();
           $re=$result->delete('index', 'my_id48848' );
           $r=$result->resultHit($re);
           return $r;
        } 
     ...
     
 # bulk 
 
 This method is for doing several operations together
 For example, delete, add and update
  It contains three parameters
 
 The first parameter is the name of the table
 The second parameter is used to create or update
 
 The third parameter is the type of operation to be performed
 
 The tip is normally set to create
 
 For example  
 
 
     public function bulk()
        {
            $result=ElasticClient::create();
            $re=$result->bulk('index', ['title'=>'test','body'=>'this is one test'] ,'index');
            $r=$result->resultHit($re);
            return $r;
         } 
      ..   
      
      
      
 # reindex 
 This method has a task
 Take a chat from your table
 
 It contains two parameters
 
 The first parameter is the name of the table you created earlier in the insert field
 The second parameter is the name of the chat table, which you can choose any name you want
 
 For example  
 
 
     public function reindex()
         {
             $result=ElasticClient::create();
               $re=$result->reindex('index', 'index2');
             $r=$result->resultHit($re);
             return $r;
          } 
       ..     



#  mtermvectors  

Retrieves multiple term vectors with a single request. 


This method creates a vector of your text
This method includes

is the first name of the table
The second bank is an identifier in the table of your choice

The third is an identifier in the table of your choice

The fourth is the name of the field for which you want to create a vector
The text is long

Set five to true if the vector contains more letters, otherwise set to false

For example 

 
     public function reindex()
         {
             $result=ElasticClient::create();
              $re=$result->mtermvectors('index', '1','2','messages',"");
             $r=$result->resultHit($re);
             return $r;
          } 
       ..    

# Dsl  query  elastic Serach 

Using this method, you can enter sql database
This method is for someone who is not familiar with elastic serach
For example

     public function lists ()
         {
             $result=ElasticClient::create();
              $re=$result->query("select * from index);  ///  name table  name index 
             $r=$result->resultHit($re);
             return $r;
          } 
       .. 

# lists 

This method is used to display the tables that exist in elasticserach

A parameter takes the name of the table
 
Note: If you want to display all the tables, you must use the word -all

For example

 
     public function lists ()
         {
             $result=ElasticClient::create();
              $re=$result->lists('index');  ///  name table or _all
             $r=$result->resultHit($re);
             return $r;
          } 
       .. 
