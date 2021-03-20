<?php

require_once dirname(__FILE__)."/../dao/BaseDao.class.php";


Flight::route('GET /patients', function(){
  $offset= Flight::routeForLimitAndOffset("offset",0);
  $limit= Flight::routeForLimitAndOffset("limit",10);
  $search = Flight::routeForLimitAndOffset("search");

  Flight::json(Flight::patient_service()->getPatientService($search,$offset,$limit));

});

Flight::route('GET /patient/@id', function($id){
  $result=Flight::patient_service()->getEntity($id);
  Flight::json($result);
});

Flight::route('POST /patients', function(){
  $request = Flight::request();
  $data=$request->data->getData();
  $result=Flight::patient_service()->insertEntity($data);
  Flight::json($result);
});

Flight::route('PUT /patients/@id', function($id){
  $request=Flight::request();
  $data=$request->data->getData();
  Flight::patient_service()->updateEntity($id,$data);
  $result=Flight::patient_service()->getEntity($id);
  Flight::json($result);

});




 ?>
