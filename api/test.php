<?php

 require_once dirname(__FILE__)."/dao/PatientsDao.class.php";
require_once dirname(__FILE__)."/dao/AccountsDao.class.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



$patients_dao=new PatientsDao();

$patient=$patients_dao->getPatientByEmail("m.k@gmail.com");
print_r ($patient);



$account_dao=new AccountsDao();
$account=$account_dao->getUserById(1);
print_r ($account);



 ?>
