<?php

require_once dirname(__FILE__)."/../dao/BaseDao.class.php";

Flight::route('POST /appointments/register', function(){
  $request = Flight::request();
  $data=$request->data->getData();
  $result=Flight::appointment_service()->insertEntity($data);
  Flight::json($result);
});






 ?>
