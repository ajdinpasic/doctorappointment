<?php

//require_once dirname(__FILE__)."/../dao/BaseDao.class.php";
require_once dirname(__FILE__)."/../dao/BaseDao.class.php";

/**
 * @OA\Info(title="doctorappointment API", version="0.1")
 * @OA\OpenApi(
*   @OA\Server(
*       url="http://localhost/doctorappointment/api/",
*       description="DEVELOPMENT ENVIRONMENT"
*   )
* )
 */

/**
 * @OA\Get(
 *     path="/accounts",
 *     @OA\Response(response="200", description="Output all accounts from the database")
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
   *     path="/account/{account_id}",
   *@OA\Parameter(
   *    @OA\Schema(type="integer"),
   *    in="path",
   *    allowReserved=true,
   *    name="account_id",
   *    default="1"),
   *     @OA\Response(response="200", description="Get specific account based on given id"),
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
