<?php

require_once dirname(__FILE__)."/../dao/BaseDao.class.php";

Flight::route('POST /doctors/register', function(){
  $request = Flight::request();
  $data=$request->data->getData();
  $result=Flight::doctor_service()->register($data);
  Flight::json($result);
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

Flight::route('GET /doctor/@id', function($id){
  $result=Flight::doctor_service()->getEntity($id);
  Flight::json($result);
});

Flight::route('PUT /doctors/@id', function($id){
  $request=Flight::request();
  $data=$request->data->getData();
  Flight::doctor_service()->updateEntity($id,$data);
  $result=Flight::doctor_service()->getEntity($id);
  Flight::json($result);

});





 ?>
