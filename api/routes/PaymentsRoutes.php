<?php

require_once dirname(__FILE__)."/../dao/BaseDao.class.php";


/**
 * @OA\Post(path="/payments", tags={"payments"},security={{"ApiKeyAuth":{}}},
 *   @OA\RequestBody(description="Appointments are paid by patient", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="amount", required="true", type="int", example="100",	description="Price of the appointment" ),
 *     				 @OA\Property(property="payment_date", required="true", type="timestamp", example="2021-03-13 11:37:58",	description="Date of the payment" ),
 *     				 @OA\Property(property="serial_number", required="true", type="string", example="N77T10",	description="Serial number of the credit card" ),
 *    				 @OA\Property(property="appointment_id", required="true", type="int", example="1",	description="Id of appointment" )
 *          )
 *       )
 *     ),
 *  @OA\Response(response="200", description="New payment is created")
 * )
 */

 Flight::route('POST /payments', function(){
   $request = Flight::request();
   $data=$request->data->getData();
   $result=Flight::payment_service()->register(Flight::get("patient")["patient_id"],$data);
   Flight::json("Appointment successfully paid");
 });

 /**
  * @OA\Get(
  *     path="/payments/{appointment_id}",tags={"payments"},security={{"ApiKeyAuth":{}}},
  *@OA\Parameter(
  *    type="integer",
  *    in="path",
  *    allowReserved=true,
  *    name="appointment_id",
  *    example="1"),
  *     @OA\Response(response="200", description="Get specific payment based on given id")
  *
 *
 * )
  */

 Flight::route('GET /payments/@id', function($id){
   $result=Flight::payment_service()->getPaymentService(Flight::get("patient")["patient_id"],$id);
   Flight::json($result);
 });


 ?>
