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
* ),
* @OA\SecurityScheme(
*      securityScheme="ApiKeyAuth",
*      type="apiKey",
*      in="header",
*      name="Authentication"
* )
 */





  Flight::route('GET /accounts', function(){
    $offset= Flight::routeForLimitAndOffset("offset",0);
    $limit= Flight::routeForLimitAndOffset("limit",10);
    $order =Flight:: routeForLimitAndOffset("order","-account_id");
    Flight::json(Flight::account_service()->getAccountService($offset,$limit,$order));

  });






    Flight::route('GET /accounts/@id', function($id){
      $headers= getallheaders();
      $token= @$headers["Authentication"];

      try {
        $decoded = (array)\Firebase\JWT\JWT::decode($token,"JWT",["HS256"]);
          if($decoded["patient_id"] == $id) {
        $result=Flight::account_service()->getEntity($id);
        Flight::json($result); }
        else {
          Flight::json(["message" => "Acc is not for you"], 401);
        }

      } catch (Exception $e) {
        Flight::json(["message" => $e->getMessage()], 401);
        die;
      }

    });





 ?>
