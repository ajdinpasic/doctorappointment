<?php


require_once dirname(__FILE__)."/../dao/BaseDao.class.php";

Flight::route('POST /doctors/register', function(){
  $request = Flight::request();
  $data=$request->data->getData();
  Flight::doctor_service()->register($data);
  Flight::json("Check out your email for further instructions");
});


Flight::route('GET /doctors/confirm/@token', function($token){
  Flight::doctor_service()->confirm($token);
  Flight::json(["Message" => "Your account is successfully activated"]);
});



Flight::route('GET /doctors', function(){
  $offset= Flight::routeForLimitAndOffset("offset",0);
  $limit= Flight::routeForLimitAndOffset("limit",10);
  $search = Flight::routeForLimitAndOffset("search");
  $order = Flight ::routeForLimitAndOffset("order","-doctor_id");
  //$orderWay = Flight ::routeForLimitAndOffset("orderWay","DESC");
  Flight::json(Flight::doctor_service()->getDoctorService($search,$offset,$limit,$order));

});

/**
 * @OA\Get(
 *     path="/doctor/{doctor_id}",tags={"doctors"},security={{"ApiKeyAuth":{}}},
 *@OA\Parameter(
 *    type="integer",
 *    in="path",
 *    allowReserved=true,
 *    name="doctor_id",
 *    example="1"),
 *     @OA\Response(response="200", description="Get specific doctor based on given id")
 *
*
* )
 */
Flight::route('GET /doctor/@id', function($id){
  $headers= getallheaders();
  $token= @$headers["Authentication"];
  //print_r($headers); die;
  try {
    $decoded = (array)\Firebase\JWT\JWT::decode($token,"JWT",["HS256"]);
      $result=Flight::doctor_service()->getEntity($id);
      Flight::json($result);

  } catch (Exception $e) {
    Flight::json(["message" => $e->getMessage()], 401); die;
  }



});

Flight::route('PUT /doctors/@id', function($id){
  $request=Flight::request();
  $data=$request->data->getData();
  Flight::doctor_service()->updateEntity($id,$data);
  $result=Flight::doctor_service()->getEntity($id);
  Flight::json($result);

});

Flight::route('POST /doctors/login', function(){
  $request = Flight::request();
  $data=$request->data->getData();
  Flight::json(Flight::doctor_service()->login($data));
  //Flight::json("Your are successfully loged in");
});

Flight::route('POST /doctors/forget', function(){
  $request = Flight::request();
  $data=$request->data->getData();
  Flight::doctor_service()->forget($data);
  Flight::json("Your recovery URL has been sent to your email account");
});



Flight::route('POST /doctors/reset', function(){
  $request = Flight::request();
  $data=$request->data->getData();
  Flight::doctor_service()->reset($data);
  Flight::json("Your password has been changed");
});


 ?>
