<?php

require_once dirname(__FILE__)."/../dao/BaseDao.class.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


/**
 * @OA\Post(path="/patients/appointments/register", tags={"appointments"},security={{"ApiKeyAuth":{}}},
 *   @OA\RequestBody(description="Appointment is registered by patient", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="scheduled_at", required="true", type="timestamp", example="2021-03-13 11:37:58",	description="Timestamp of the appointment" ),
 *     				 @OA\Property(property="office", required="true", type="integer", example="10",	description="Number of the office" ),
 *    				 @OA\Property(property="doctor_id", required="true", type="string", example="1",	description="Name of the doctor" )
 *          )
 *       )
 *     ),
 *  @OA\Response(response="200", description="New appointment is registered")
 * )
 */

Flight::route('POST /patients/appointments/register', function(){
  $request = Flight::request();
  $data=$request->data->getData();
  $result=Flight::appointment_service()->register(Flight::get("patient")["patient_id"],$data);
  Flight::json("Appointment successfully scheduled");
});

/**
 * @OA\Get(
 *     path="/doctor/appointments",tags={"appointments"},security={{"ApiKeyAuth":{}}},
 *     @OA\Response(response="200", description="Get all appointments of one doctor")
 *
*
* )
 */

Flight::route('GET /doctor/appointments', function(){
  $id=Flight::get("doctor")["doctor_id"];
  $result=Flight::appointment_service()->getAllAppointmentsDoctorService($id);
  Flight::json($result);
});

/**
 * @OA\Get(
 *     path="/patient/appointments",tags={"appointments"},security={{"ApiKeyAuth":{}}},
 *     @OA\Response(response="200", description="Get all appointments of one patient")
 *
*
* )
 */

Flight::route('GET /patient/appointments', function(){
  $id=Flight::get("patient")["patient_id"];
  $result=Flight::appointment_service()->getAllAppointmentsPatientService($id);
  Flight::json($result);
});




/**
 * @OA\Get(
 *     path="/patients/appointment/{appointment_id}",tags={"appointments"},security={{"ApiKeyAuth":{}}},
 *@OA\Parameter(
 *    type="integer",
 *    in="path",
 *    allowReserved=true,
 *    name="appointment_id",
 *    example="1"),
 *     @OA\Response(response="200", description="Get specific appointment based on given id")
 *
*
* )
 */

Flight::route('GET /patients/appointment/@id', function($id){
  $result=Flight::appointment_service()->getAppointmentForPatient(Flight::get("patient")["patient_id"],$id);
  Flight::json($result);
});




/**
 * @OA\Get(
 *     path="/doctors/appointment/{appointment_id}",tags={"appointments"},security={{"ApiKeyAuth":{}}},
 *@OA\Parameter(
 *    type="integer",
 *    in="path",
 *    allowReserved=true,
 *    name="appointment_id",
 *    example="1"),
 *     @OA\Response(response="200", description="Get specific appointment based on given id")
 *
*
* )
 */

Flight::route('GET /doctors/appointment/@id', function($id){
  $result=Flight::appointment_service()->getAppointmentForDoctor(Flight::get("doctor")["doctor_id"],$id);
  Flight::json($result);
});

/*
Flight::route('PUT /appointment/@id', function($id){
  $request=Flight::request();
  $data=$request->data->getData();
  Flight::appointment_service()->updateEntity($id,$data);
  $result=Flight::appointment_service()->getEntity($id);
  Flight::json($result);

}); */

 ?>
