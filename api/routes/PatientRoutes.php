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
  * @OA\Get(
  *     path="/patients",tags={"patients"},security={{"ApiKeyAuth":{}}},
  *    @OA\Parameter(type="integer", in="query", name="offset", default="0", description="Offset for pagination"),
  *    @OA\Parameter(type="integer", in="query", name="limit", default="10", description="Limit for pagination"),
  *    @OA\Parameter(type="string", in="query", name="search", default="ajdin", description="Search for pagination"),
  *    @OA\Parameter(type="string", in="query", name="order", default="-account_id", description="Ordering for pagination"),
  *    @OA\Response(response="200", description="Output all doctors from the database")
  * )
  */




Flight::route('GET /patients', function(){
  $offset= Flight::routeForLimitAndOffset("offset",0);
  $limit= Flight::routeForLimitAndOffset("limit",10);
  $search = Flight::routeForLimitAndOffset("search");
  $order = Flight ::routeForLimitAndOffset("order","-patient_id");
  //$orderWay = Flight ::routeForLimitAndOffset("orderWay","DESC");
  $total = Flight::patient_service()->getPatientService($search,$offset,$limit,$order,TRUE);
  //Flight::json($total[0]["total"]); die;
  header('total-records: ' .$total[0]["total"]);

  Flight::json(Flight::patient_service()->getPatientService($search,$offset,$limit,$order));

});

/**
 * @OA\Get(
 *     path="/patients/{patient_id}",tags={"patients"},security={{"ApiKeyAuth":{}}},
 *@OA\Parameter(
 *    type="integer",
 *    in="path",
 *    allowReserved=true,
 *    name="patient_id",
 *    example="1"),
 *     @OA\Response(response="200", description="Get specific patient based on given id")
 *
*
* )
 */




Flight::route('GET /patients/@id', function($id){
  //if(Flight::get("patient")["patient_id"] != $id ) throw new Exception("This is not for you",403);
  $result=Flight::patient_service()->getEntity($id);
  Flight::json($result);
});

/**
 * @OA\Post(path="/patients/register", tags={"patients"},
 *   @OA\RequestBody(description="New patient registers", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="patient_name", required="true", type="string", example="My Test Account",	description="Name of the patient" ),
 *     				 @OA\Property(property="patient_surname", required="true", type="string", example="First Last Name",	description="Surname of the patient`" ),
 *    				 @OA\Property(property="patient_email", required="true", type="string", example="myemail@gmail.com",	description="Patient's email address" ),
 *             @OA\Property(property="password", required="true", type="string", example="12345",	description="Patient's password" )
 *          )
 *       )
 *     ),
 *  @OA\Response(response="200", description="New patient is registered")
 * )
 */



Flight::route('POST /patients/register', function(){
  $request = Flight::request();
  $data=$request->data->getData();
  Flight::patient_service()->register($data);
  Flight::json("Check out your email for further instructions");
});

/**
 * @OA\Put(path="/patients/{patient_id}", tags={"patients"}, security={{"ApiKeyAuth": {}}},
 *   @OA\Parameter(@OA\Schema(type="integer"), in="path", name="patient_id", default=1),
 *   @OA\RequestBody(description="Patient about to be updated", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="patient_name", required="true", type="string", example="John ",	description="Name of the patient" ),
 *    				 @OA\Property(property="patient_surname",required="true", type="string",  example="Doe",	description="Surname of the patient" )
 *          )
 *       )
 *     ),
 *     @OA\Response(response="200", description="Update patient based on id")
 * )
 */


Flight::route('PUT /patients/@id', function($id){
  if(Flight::get("patient")["patient_id"] != $id ) throw new Exception("This is not for you",403);
  $request=Flight::request();
  $data=$request->data->getData();
  Flight::patient_service()->updateEntity($id,$data);
  $result=Flight::patient_service()->getEntity($id);
  Flight::json($result);

});

/**
 * @OA\Get(path="/patients/confirm/{token}", tags={"patients"},
 *     @OA\Parameter(type="string", in="path", name="token", default=123, description="Temporary token for activating account"),
 *     @OA\Response(response="200", description="Message upon successfull activation.")
 * )
 */


  Flight::route('GET /patients/confirm/@token', function($token){
    Flight::patient_service()->confirm($token);
    Flight::json(["Message" => "Your account is successfully activated"]);
  //  Flight::json(Flight::jwt(Flight::PatientService()->confirm($token)));
  });

  /**
   * @OA\Post(path="/patients/login", tags={"patients"},
   *   @OA\RequestBody(description="Patient logs in", required=true,
   *       @OA\MediaType(mediaType="application/json",
   *    			@OA\Schema(
   *    				 @OA\Property(property="patient_email", required="true", type="string", example="myemail@gmail.com",	description="Patient's email address" ),
   *             @OA\Property(property="password", required="true", type="string", example="12345",	description="Patient password" )
   *          )
   *       )
   *     ),
   *  @OA\Response(response="200", description="Patient has successfully loged in")
   * )
   */




  Flight::route('POST /patients/login', function(){
    $request = Flight::request();
    $data=$request->data->getData();
    Flight::json(Flight::patient_service()->login($data));
    //Flight::json("Your are successfully loged in");
  });

  /**
   * @OA\Post(path="/patients/forget", tags={"patients"}, description="Send recovery URL to patient email address",
   *   @OA\RequestBody(description="Patient forgets password", required=true,
   *       @OA\MediaType(mediaType="application/json",
   *    			@OA\Schema(
   *    				 @OA\Property(property="patient_email", required="true", type="string", example="myemail@gmail.com",	description="Patient's email address" )
   *          )
   *       )
   *     ),
   *  @OA\Response(response="200", description="Message that recovery link has been sent.")
   * )
   */


  Flight::route('POST /patients/forget', function(){
    $request = Flight::request();
    $data=$request->data->getData();
    Flight::patient_service()->forget($data);
    Flight::json("Your recovery URL has been sent to your email account");
  });

  /**
   * @OA\Post(path="/patients/reset", tags={"patients"}, description="Reset patient password using recovery token",
   *   @OA\RequestBody(description="Patient resets password", required=true,
   *       @OA\MediaType(mediaType="application/json",
   *    			@OA\Schema(
   *    				 @OA\Property(property="token", required="true", type="string", example="123",	description="Recovery token" ),
   *    				 @OA\Property(property="password", required="true", type="string", example="123",	description="New password" )
   *          )
   *       )
   *     ),
   *  @OA\Response(response="200", description="Message that patient has changed password.")
   * )
   */


  Flight::route('POST /patients/reset', function(){
    $request = Flight::request();
    $data=$request->data->getData();
    Flight::patient_service()->reset($data);
    Flight::json("Your password has been changed");
  });


 ?>
