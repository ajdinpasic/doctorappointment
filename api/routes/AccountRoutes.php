<?php

//require_once dirname(__FILE__)."/../dao/BaseDao.class.php";
require_once dirname(__FILE__)."/../dao/BaseDao.class.php";



/**
 * @OA\Get(
 *     path="/accounts",tags={"account"},
 *    @OA\Parameter(type="integer", in="query", name="offset", default="0", description="Offset for pagination"),
 *    @OA\Parameter(type="integer", in="query", name="limit", default="10", description="Limit for pagination"),
 *    @OA\Parameter(type="string", in="query", name="order", default="-account_id", description="Ordering for pagination"),
 *    @OA\Response(response="200", description="Output all accounts from the database")
 * )
 */



  Flight::route('GET /accounts', function(){
    $offset= Flight::routeForLimitAndOffset("offset",0);
    $limit= Flight::routeForLimitAndOffset("limit",10);
    $order =Flight:: routeForLimitAndOffset("order","-account_id");
    Flight::json(Flight::account_service()->getAccountService($offset,$limit,$order));

  });

  /**
   * @OA\Get(
   *     path="/account/{account_id}",tags={"account"},
   *@OA\Parameter(
   *    @OA\Schema(type="integer"),
   *    in="path",
   *    allowReserved=true,
   *    name="account_id",
   *    example="1"),
   *     @OA\Response(response="200", description="Get specific account based on given id")
   *
 *
 * )
   */




    Flight::route('GET /account/@id', function($id){
      $result=Flight::account_service()->getEntity($id);
      Flight::json($result);
    });
/*
  Flight::route('POST /accounts', function(){
      $request = Flight::request();
      $data=$request->data->getData();
      $result=Flight::account_service()->insertEntity($data);
      Flight::json($result);
    }); */
    /*
    Flight::route('PUT /accounts/@id', function($id){
      $request=Flight::request();
      $data=$request->data->getData();
      Flight::account_service()->updateEntity($id,$data);
      $result=Flight::account_service()->getEntity($id);
      Flight::json($result);

    }); */




 ?>
