<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__FILE__)."/dao/BaseDao.class.php";
require_once dirname(__FILE__)."/dao/AccountsDao.class.php";
require_once dirname(__FILE__)."/dao/PatientsDao.class.php";
require_once dirname(__FILE__)."/dao/DoctorsDao.class.php";
require_once dirname(__FILE__)."/dao/AppointmentsDao.class.php";
require_once dirname (__FILE__)."/../vendor/autoload.php";
require_once dirname (__FILE__)."/routes/AccountRoutes.php";
require_once dirname (__FILE__)."/routes/DoctorRoutes.php";
require_once dirname (__FILE__)."/routes/PatientRoutes.php";
require_once dirname (__FILE__)."/routes/AppointmentRoutes.php";
require_once dirname (__FILE__)."/Services/PatientServices.class.php";
require_once dirname (__FILE__)."/Services/AccountServices.class.php";
require_once dirname (__FILE__)."/Services/DoctorServices.class.php";
require_once dirname (__FILE__)."/Services/AppointmentServices.class.php";
Flight::set('flight.log_errors', true);

/*
Flight::map('error', function(Exception $ex){
    Flight::json(["message" => $ex->getMessage()], $ex->getCode());
}); */



Flight::map('routeForLimitAndOffset', function($name,$defaultValue=NULL){
  $request=Flight::request();
  $params= @$request->query->getData()[$name];
  $params = $params ? $params : $defaultValue;
  return $params;
});

Flight::register('patient_service', 'PatientService');
Flight::register('account_service', 'AccountService');
Flight::register('doctor_service', 'DoctorService');
Flight::register('appointment_service', 'AppointmentService');

Flight::start();


 ?>
