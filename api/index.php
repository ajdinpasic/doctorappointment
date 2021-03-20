<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__FILE__)."/dao/BaseDao.class.php";
require_once dirname(__FILE__)."/dao/AccountsDao.class.php";
require_once dirname(__FILE__)."/dao/PatientsDao.class.php";
require_once dirname (__FILE__)."/../vendor/autoload.php";
require_once dirname (__FILE__)."/routes/AccountRoutes.php";
require_once dirname (__FILE__)."/routes/PatientRoutes.php";
require_once dirname (__FILE__)."/Services/PatientServices.class.php";

Flight::map('routeForLimitAndOffset', function($name,$defaultValue=NULL){
  $request=Flight::request();
  $params= @$request->query->getData()[$name];
  $params = $params ? $params : $defaultValue;
  return $params;
});

Flight::register('account_dao', 'AccountsDao');
Flight::register('patient_dao', 'PatientsDao');

Flight::register('patient_service', 'PatientService');

Flight::start();


 ?>
