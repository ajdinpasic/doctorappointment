<?php

 require_once dirname(__FILE__)."/dao/PatientsDao.class.php";
require_once dirname(__FILE__)."/dao/AccountsDao.class.php";
require_once dirname(__FILE__)."/dao/DoctorsDao.class.php";
require_once dirname(__FILE__)."/dao/CreditCardsDao.class.php";
require_once dirname(__FILE__)."/dao/AppointmentsDao.class.php";
require_once dirname(__FILE__)."/dao/AppointmentDetailsDao.class.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



$data = [
  "prob_description" => "Something bad happened.LOL HGHGHG",
  "prescription" => "Something bad hap463463pened.LOL HGHGHG",
  "price" => 400.00,
  "type" => "blood sample",
  "appointment_id" => 1,
  "card_id" => 2

];


$app_dao=new AppointmentDetailsDao();
$result=$app_dao->addDetails($data);
print_r ($result);



 ?>
