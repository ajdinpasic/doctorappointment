<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once dirname(__FILE__)."/dao/BaseDao.class.php";
require_once dirname(__FILE__)."/dao/AccountsDao.class.php";
require_once dirname(__FILE__)."/dao/PatientsDao.class.php";
require_once dirname(__FILE__)."/dao/DoctorsDao.class.php";
require_once dirname(__FILE__)."/dao/AppointmentsDao.class.php";
require_once dirname(__FILE__)."/dao/AppointmentDetailsDao.class.php";
require_once dirname(__FILE__)."/dao/PaymentsDao.class.php";
require_once dirname (__FILE__)."/../vendor/autoload.php";
require_once dirname (__FILE__)."/routes/middleware.php";
require_once dirname (__FILE__)."/routes/AccountRoutes.php";
require_once dirname (__FILE__)."/routes/DoctorRoutes.php";
require_once dirname (__FILE__)."/routes/PatientRoutes.php";
require_once dirname (__FILE__)."/routes/AppointmentDetailsRoutes.php";
require_once dirname (__FILE__)."/routes/AppointmentRoutes.php";
require_once dirname (__FILE__)."/Services/PatientServices.class.php";
require_once dirname (__FILE__)."/routes/PaymentsRoutes.php";
require_once dirname (__FILE__)."/Services/PaymentServices.class.php";
require_once dirname (__FILE__)."/Services/AccountServices.class.php";
require_once dirname (__FILE__)."/Services/DoctorServices.class.php";
require_once dirname (__FILE__)."/Services/AppointmentDetailsServices.class.php";
require_once dirname (__FILE__)."/Services/AppointmentServices.class.php";


Flight::set('flight.log_errors', true);


Flight::map('error', function(Exception $ex){
    Flight::json(["message" => $ex->getMessage()], $ex->getCode());
});



Flight::map('routeForLimitAndOffset', function($name,$defaultValue=NULL){
  $request=Flight::request();
  $params= @$request->query->getData()[$name];
  $params = $params ? $params : $defaultValue;
  return urldecode($params);
});

Flight::register('patient_service', 'PatientService');
Flight::register('account_service', 'AccountService');
Flight::register('doctor_service', 'DoctorService');
Flight::register('detail_service', 'DetailService');
Flight::register('appointment_service', 'AppointmentService');
Flight::register('payment_service', 'PaymentService');



/* utility function for getting header parameters */
Flight::map('header', function($name){
  $headers = getallheaders();
  return @$headers[$name];
});

Flight::route('GET /swagger', function(){

  $openapi = @\OpenApi\scan(dirname(__FILE__)."/routes");
  header('Content-Type: application/json');
  echo $openapi->toJson();

});


Flight::route('GET /', function(){

  Flight::redirect('/docs');

});





Flight::start();


 ?>
