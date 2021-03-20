<?php

  require_once dirname(__FILE__)."/../dao/AccountsDao.class.php";


    Flight::map('hello', function($name){
      echo "hello $name!";
    });

  // Call your custom method
  Flight::hello('Bob');



  Flight::route('GET /accounts', function(){
    $request=Flight::request();
    $offset= @$request->query->getData()["offset"];
    $offset = $offset ? $offset : 0;
    $limit= @$request->query->getData()["limit"];
    $limit = $limit ? $limit : 15;

    print_r($offset);
    print_r($limit);
  });

    Flight::route('GET /account/@id', function($id){
      $result=Flight::account()->getEntity($id);
      Flight::json($result);
    });

  Flight::route('POST /accounts', function(){
      $request = Flight::request();
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




 ?>
