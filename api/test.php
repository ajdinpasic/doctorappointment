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

$acc=new AccountsDao();
/*print_r($_GET);
die; */

$result=$acc->getEntity(1);

echo json_encode($result,JSON_PRETTY_PRINT);





 ?>
