<?php

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


Flight::route('GET /swagger', function(){

  $openapi = \OpenApi\scan(dirname(__FILE__)."/../routes");
  header('Content-Type: application/json');
  echo $openapi->toJson();

});

Flight::route('GET /', function(){

  Flight::redirect('/docs');

});

 ?>
