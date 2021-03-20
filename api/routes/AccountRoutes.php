<?php

require_once dirname(__FILE__)."/../dao/BaseDao.class.php";

  Flight::route('GET /accounts', function(){
    $offset= Flight::routeForLimitAndOffset("offset",0);
    $limit= Flight::routeForLimitAndOffset("limit",10);

    Flight::json(Flight::account_dao()->getAllEntities($offset,$limit));

  });

    Flight::route('GET /account/@id', function($id){
      $result=Flight::account_dao()->getEntity($id);
      Flight::json($result);
    });

  Flight::route('POST /accounts', function(){
      $request = Flight::request();
      $data=$request->data->getData();
      $result=Flight::account_dao()->insertEntity($data);
      Flight::json($result);
    });

    Flight::route('PUT /accounts/@id', function($id){
      $request=Flight::request();
      $data=$request->data->getData();
      Flight::account_dao()->updateEntity($id,$data);
      $result=Flight::account_dao()->getEntity($id);
      Flight::json($result);

    });




 ?>
