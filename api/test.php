<?php

 require_once dirname(__FILE__)."/dao/PatientsDao.class.php";
require_once dirname(__FILE__)."/dao/AccountsDao.class.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



/* $patients_dao=new PatientsDao();

$patient=$patients_dao->getPatientByEmail("m.k@gmail.com");
print_r ($patient);



$account_dao=new AccountsDao();
$account=$account_dao->getUserById(1);
print_r ($account);  */



/*
$r1_acc1=$acc1->getAccountByType("patient");

print_r ($r1_acc1); */

// $account_dao=new AccountsDao();
/*
$a= [
  "password" => "ghgh99"


];

$account_dao->updateAccount(1,$a); */
/*
$b= [

  "created_at" => "2020-03-13 11:37:58",
  "type" =>"patient",
  "password" => "cxcx",
  "email" => "mirza.k@gmail.com"



];

print_r ($account_dao->addAccount($b)); */


/*
$acc1= [

  "created_at" => "2021-03-13 11:37:58",
  "type" =>"paient",
  "password" => "bv9",
  "email" => "naida.f@gmail.com"

];

$account_dao->addAccount($acc1);

 print_r ($acc1); */
/*
$acc=new AccountsDao();

$r=$acc->getAccountByType("patient");

print_r ($r); */



$proba=new AccountsDao();
$a=[
  "password" => "novaa"


];
$proba->updateAccountByEmail("naida.f@gmail.com",$a);
$proba->updateAccountById(1,$a);

 ?>
