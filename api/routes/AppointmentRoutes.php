<?php

require_once dirname(__FILE__)."/../dao/BaseDao.class.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);




Flight::route('POST /appointments/register', function(){
  $request = Flight::request();
  $data=$request->data->getData();
  $result=Flight::appointment_service()->insertEntity($data);
  Flight::json($result);
});


Flight::route('GET /appointments', function(){
  $offset= Flight::routeForLimitAndOffset("offset",0);
  $limit= Flight::routeForLimitAndOffset("limit",10);
  //$search = Flight::routeForLimitAndOffset("search");
  $order = Flight ::routeForLimitAndOffset("order","-patient_id");
  //$orderWay = Flight ::routeForLimitAndOffset("orderWay","DESC");
  Flight::json(Flight::appointment_service()->getAppointmentService($offset,$limit,$order));

});

Flight::route('GET /appointment', function(){
  $patient_id = Flight ::routeForLimitAndOffset("patient_id");
  $doctor_id = Flight ::routeForLimitAndOffset("doctor_id");
  $result=Flight::appointment_service()->getAppointmentByPatientOrDoctor($patient_id,$doctor_id);
  Flight::json($result);
});



Flight::route('GET /appointment/@id', function($id){
  $result=Flight::appointment_service()->getEntity($id);
  Flight::json($result);
});

Flight::route('PUT /appointment/@id', function($id){
  $request=Flight::request();
  $data=$request->data->getData();
  Flight::appointment_service()->updateEntity($id,$data);
  $result=Flight::appointment_service()->getEntity($id);
  Flight::json($result);

});

 ?>
