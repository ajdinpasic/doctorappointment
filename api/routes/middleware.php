<?php
/*
Flight::before('start', function(&$params, &$output){
    if (Flight::request()-> url == "/swagger") return TRUE;
    if(str_starts_with(Flight::request()-> url, "/doctors/register")) return TRUE;
    if(str_starts_with(Flight::request()-> url, "/doctors/login")) return TRUE;
    $headers= getallheaders();
    $token= @$headers["Authentication"];

    //print_r($headers); die;
    try {
      $decoded = (array)\Firebase\JWT\JWT::decode($token,"JWT",["HS256"]);
      print_r($decoded); die;
      Flight::set("doctor",$decoded);
      return TRUE;

    } catch (Exception $e) {
      Flight::json(["message" => $e->getMessage()], 401);
      die;
    }


}); */



Flight::route('/doctors/*', function(){
  if (Flight::request()-> url == "/swagger") return TRUE;
  if(str_starts_with(Flight::request()-> url, "/doctors/register")) return TRUE;
  if(str_starts_with(Flight::request()-> url, "/doctors/login")) return TRUE;
  if(str_starts_with(Flight::request()-> url, "/doctors/forget")) return TRUE;
  if(str_starts_with(Flight::request()-> url, "/doctors/reset")) return TRUE;
  if(str_starts_with(Flight::request()-> url, "/doctors/confirm")) return TRUE;

  $headers= getallheaders();
  $token= @$headers["Authentication"];
  //print_r($headers); die;
  try {

   $doctor = (array)\Firebase\JWT\JWT::decode(Flight::header("Authentication"), Config::JWT_SECRET, ["HS256"]);
    if (Flight::request()->method != "GET" && (!isset($doctor["doctor_id"]))){
      throw new Exception("Patients are not allowed to perform that", 403);
    }
    Flight::set('doctor', $doctor);
    return TRUE;

  } catch (Exception $e) {
    Flight::json(["message" => $e->getMessage()], 401);
    die;
  }
});
Flight::route('/patients/*', function(){
  if (Flight::request()-> url == "/swagger") return TRUE;
  if(str_starts_with(Flight::request()-> url, "/patients/register")) return TRUE;
  if(str_starts_with(Flight::request()-> url, "/patients/login")) return TRUE;
  if(str_starts_with(Flight::request()-> url, "/patients/forget")) return TRUE;
  if(str_starts_with(Flight::request()-> url, "/patients/reset")) return TRUE;
  if(str_starts_with(Flight::request()-> url, "/patients/confirm")) return TRUE;

  $headers= getallheaders();
  $token= @$headers["Authentication"];

  try {
    $patient = (array)\Firebase\JWT\JWT::decode(Flight::header("Authentication"), Config::JWT_SECRET, ["HS256"]);
     if (Flight::request()->method != "GET" && (!isset($patient["patient_id"]))){
       throw new Exception("Doctors are not allowed to perform that", 403);
     }
     Flight::set('patient', $patient);
     return TRUE;

  } catch (Exception $e) {
    Flight::json(["message" => $e->getMessage()], 401);
    die;
  }

});



Flight::route('/patients/appointments/*', function(){
  if (Flight::request()-> url == "/swagger") return TRUE;

  $headers= getallheaders();
  $token= @$headers["Authentication"];

  try {
    $patient = (array)\Firebase\JWT\JWT::decode(Flight::header("Authentication"), Config::JWT_SECRET, ["HS256"]);
     if (!isset($patient["patient_id"])){
       throw new Exception("You cannot access this", 403);
     }
     Flight::set('patient', $patient);
     return TRUE;

  } catch (Exception $e) {
    Flight::json(["message" => $e->getMessage()], 401);
    die;
  }

});

Flight::route('/doctors/appointments/*', function(){
  if (Flight::request()-> url == "/swagger") return TRUE;


  $headers= getallheaders();
  $token= @$headers["Authentication"];
  //print_r($headers); die;
  try {

   $doctor = (array)\Firebase\JWT\JWT::decode(Flight::header("Authentication"), Config::JWT_SECRET, ["HS256"]);
    if (!isset($doctor["doctor_id"])){
      throw new Exception("You cannot access this", 403);
    }
    Flight::set('doctor', $doctor);
    return TRUE;

  } catch (Exception $e) {
    Flight::json(["message" => $e->getMessage()], 401);
    die;
  }
});

 ?>
