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
      Flight::set("doctor",$decoded);
      return TRUE;

    } catch (Exception $e) {
      Flight::json(["message" => $e->getMessage()], 401);
      die;
    }


}); */

Flight::route('*', function(){
  if (Flight::request()-> url == "/swagger") return TRUE;
  if(str_starts_with(Flight::request()-> url, "/doctors/register")) return TRUE;
  if(str_starts_with(Flight::request()-> url, "/doctors/login")) return TRUE;
  $headers= getallheaders();
  $token= @$headers["Authentication"];
  //print_r($headers); die;
  try {
    $decoded = (array)\Firebase\JWT\JWT::decode($token,"JWT",["HS256"]);
    Flight::set("doctor",$decoded);
    return TRUE;

  } catch (Exception $e) {
    Flight::json(["message" => $e->getMessage()], 401);
    die;
  }
});

 ?>
