<?php

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




/**
 * @OA\Post(path="/doctors/register", tags={"doctors"},
 *   @OA\RequestBody(description="New doctor registers", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="doctor_name", required="true", type="string", example="My Test Account",	description="Name of the doctor" ),
 *     				 @OA\Property(property="doctor_surname", required="true", type="string", example="First Last Name",	description="Surnname of the doctor`" ),
 *    				 @OA\Property(property="doctor_email", required="true", type="string", example="myemail@gmail.com",	description="Patient's email address" ),
 *             @OA\Property(property="password", required="true", type="string", example="12345",	description="Patient's password" )
 *          )
 *       )
 *     ),
 *  @OA\Response(response="200", description="New doctor is registered")
 * )
 */


Flight::route('POST /doctors/register', function(){
  $request = Flight::request();
  $data=$request->data->getData();
  Flight::doctor_service()->register($data);
  Flight::json("Check out your email for further instructions");
});

/**
 * @OA\Get(path="/doctors/confirm/{token}", tags={"doctors"},
 *     @OA\Parameter(type="string", in="path", name="token", default=123, description="Temporary token for activating account"),
 *     @OA\Response(response="200", description="Message upon successfull activation.")
 * )
 */

Flight::route('GET /doctors/confirm/@token', function($token){
  Flight::doctor_service()->confirm($token);
  Flight::json(["Message" => "Your account is successfully activated"]);
});

/**
 * @OA\Get(
 *     path="/doctors",tags={"doctors"},security={{"ApiKeyAuth":{}}},
 *    @OA\Parameter(type="integer", in="query", name="offset", default="0", description="Offset for pagination"),
 *    @OA\Parameter(type="integer", in="query", name="limit", default="10", description="Limit for pagination"),
 *    @OA\Parameter(type="string", in="query", name="search", default="John", description="Search for pagination"),
 *    @OA\Parameter(type="string", in="query", name="order", default="-account_id", description="Ordering for pagination"),
 *    @OA\Response(response="200", description="Output all doctors from the database")
 * )
 */

Flight::route('GET /doctors', function(){
  $offset= Flight::routeForLimitAndOffset("offset",0);
  $limit= Flight::routeForLimitAndOffset("limit",10);
  $search = Flight::routeForLimitAndOffset("search");
  $order = Flight ::routeForLimitAndOffset("order","-doctor_id");
  //$orderWay = Flight ::routeForLimitAndOffset("orderWay","DESC");
  $total = Flight::doctor_service()->getDoctorService($search,$offset,$limit,$order,TRUE);
  header('total-records: ' .$total[0]["total"]);
  Flight::json(Flight::doctor_service()->getDoctorService($search,$offset,$limit,$order));

});

/**
 * @OA\Get(
 *     path="/doctors/{doctor_id}",tags={"doctors"},security={{"ApiKeyAuth":{}}},
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
Flight::route('GET /doctors/@id', function($id){
  //print_r($id); die;
    //if(Flight::get("doctor")["doctor_id"] != $id) throw new Exception("This is not for you",403);
      $result=Flight::doctor_service()->getEntity($id);
      Flight::json($result);




});

/**
 * @OA\Put(path="/doctors/{doctor_id}", tags={"doctors"}, security={{"ApiKeyAuth": {}}},
 *   @OA\Parameter(@OA\Schema(type="integer"), in="path", name="doctor_id", default=1),
 *   @OA\RequestBody(description="Doctor about to be updated", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="doctor_name", required="true", type="string", example="John ",	description="Name of the doctor" ),
 *    				 @OA\Property(property="doctor_surname",required="true", type="string",  example="Doe",	description="Surname of the doctor" )
 *          )
 *       )
 *     ),
 *     @OA\Response(response="200", description="Update doctor based on id")
 * )
 */



Flight::route('PUT /doctors/@id', function($id){
  if(Flight::get("doctor")["doctor_id"] != $id ) throw new Exception("This is not for you",403);
  $request=Flight::request();
  $data=$request->data->getData();
  Flight::doctor_service()->updateEntity($id,$data);
  $result=Flight::doctor_service()->getEntity($id);
  Flight::json($result);

});

/**
 * @OA\Post(path="/doctors/login", tags={"doctors"},
 *   @OA\RequestBody(description="Doctor logs in", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="doctor_email", required="true", type="string", example="myemail@gmail.com",	description="Doctor's email address" ),
 *             @OA\Property(property="password", required="true", type="string", example="12345",	description="Doctor's password" )
 *          )
 *       )
 *     ),
 *  @OA\Response(response="200", description="Doctor has successfully loged in")
 * )
 */




Flight::route('POST /doctors/login', function(){
  $request = Flight::request();
  $data=$request->data->getData();
  Flight::json(Flight::doctor_service()->login($data));
  //Flight::json("Your are successfully loged in");
});

/**
 * @OA\Post(path="/doctors/forget", tags={"doctors"}, description="Send recovery URL to doctor email address",
 *   @OA\RequestBody(description="Doctor forgets password", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="doctor_email", required="true", type="string", example="myemail@gmail.com",	description="Doctor's email address" )
 *          )
 *       )
 *     ),
 *  @OA\Response(response="200", description="Message that recovery link has been sent.")
 * )
 */




Flight::route('POST /doctors/forget', function(){
  $request = Flight::request();
  $data=$request->data->getData();
  Flight::doctor_service()->forget($data);
  Flight::json("Your recovery URL has been sent to your email account");
});

/**
 * @OA\Post(path="/doctors/reset", tags={"doctors"}, description="Reset doctor password using recovery token",
 *   @OA\RequestBody(description="Doctor resets password", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="token", required="true", type="string", example="123",	description="Recovery token" ),
 *    				 @OA\Property(property="password", required="true", type="string", example="123",	description="New password" )
 *          )
 *       )
 *     ),
 *  @OA\Response(response="200", description="Message that doctor has changed password.")
 * )
 */


Flight::route('POST /doctors/reset', function(){
  $request = Flight::request();
  $data=$request->data->getData();
  Flight::doctor_service()->reset($data);
  Flight::json("Your password has been changed");
});


 ?>
