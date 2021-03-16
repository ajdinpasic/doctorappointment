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

$patient_dao=new PatientsDao();


$result=$patient_dao->getAllEntities();
print_r ($result);






 ?>
