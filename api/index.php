<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__FILE__)."/dao/BaseDao.class.php";
require_once dirname(__FILE__)."/dao/AccountsDao.class.php";
require dirname (__FILE__).'/../vendor/autoload.php';


Flight::register('account', 'AccountsDao');



Flight::route('/', function(){
    echo 'hello world!';
});

Flight::route('GET/testiram', function(){
    echo 'flight php testing';
});

Flight::route('GET /accounts', function(){
    $result=Flight::account()->getAllEntities();
    Flight::json($result);

});
Flight::route('GET /accounts/@id', function($id){
    $result=Flight::account()->getEntity($id);
    Flight::json($result);

});

Flight::route('POST /accounts', function(){
  $request=Flight::request();
  $data=$request->data->getData();
  $result=Flight::account()->insertEntity($data);

  Flight::json($result);

});

Flight::route('PUT /accounts/@id', function($id){
  $request=Flight::request();
  $data=$request->data->getData();
  Flight::account()->updateEntity($id,$data);
  $result=Flight::account()->getEntity($id);
  Flight::json($result);

});


Flight::start();


 ?>
