<?php
require_once dirname(__FILE__)."/../dao/BaseDao.class.php";
/**
 * @OA\Post(path="/doctor/appointments/details/register", tags={"details"},security={{"ApiKeyAuth":{}}},
 *   @OA\RequestBody(description="Details are registered by doctor", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="p", required="true", type="string", example="Fever",	description="Problem of the appointment" ),
 *     				 @OA\Property(property="prescription", required="true", type="string", example="Paracetamol",	description="Prescription of the appointment" ),
 *     				 @OA\Property(property="type", required="true", type="string", example="Normal examination",	description="Type of the appointment" ),
 *    				 @OA\Property(property="appointment_id", required="true", type="int", example="1",	description="Id of appointment" )
 *          )
 *       )
 *     ),
 *  @OA\Response(response="200", description="New details are registered")
 * )
 */

 Flight::route('POST /doctor/appointments/details/register', function(){
   $request = Flight::request();
   $data=$request->data->getData();
   $result=Flight::detail_service()->registracija(Flight::get("doctor")["doctor_id"],$data);
   Flight::json("Details successfully uploaded");
 });

 /**
  * @OA\Get(
  *     path="/doctor/details/{appointment_id}",tags={"details"},security={{"ApiKeyAuth":{}}},
  *@OA\Parameter(
  *    type="integer",
  *    in="path",
  *    allowReserved=true,
  *    name="appointment_id",
  *    example="1"),
  *     @OA\Response(response="200", description="Get specific details based on given id")
  *
 *
 * )
  */

 Flight::route('GET /doctor/details/@id', function($id){
   $result=Flight::detail_service()->getAllDetailsDoctorService(Flight::get("doctor")["doctor_id"],$id);
   Flight::json($result);
 });

 /**
  * @OA\Get(
  *     path="/patient/details/{appointment_id}",tags={"details"},security={{"ApiKeyAuth":{}}},
  *@OA\Parameter(
  *    type="integer",
  *    in="path",
  *    allowReserved=true,
  *    name="appointment_id",
  *    example="1"),
  *     @OA\Response(response="200", description="Get specific details based on given id")
  *
 *
 * )
  */

 Flight::route('GET /patient/details/@id', function($id){
   $result=Flight::detail_service()->getAllDetailsPatientService(Flight::get("patient")["patient_id"],$id);
   Flight::json($result);
 });


 ?>
