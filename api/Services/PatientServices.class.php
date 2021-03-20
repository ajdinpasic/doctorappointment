<?php

require_once dirname(__FILE__)."/../dao/BaseDao.class.php";
require_once dirname(__FILE__)."/BaseService.class.php";
require_once dirname(__FILE__)."/../dao/PatientsDao.class.php";
require_once dirname(__FILE__)."/../dao/AccountsDao.class.php";

class PatientService extends BaseService{

  private $account_dao;

  public function __construct() {
    $this->dao=new PatientsDao();
    $this->account_dao= new AccountsDao();
  }


  public function getPatientService($search,$offset,$limit) {
    if ($search) {
      return $this->dao->getPatientsByName($search,$offset,$limit);
    } else {

    return $this->dao->getAllEntities($offset,$limit); }


} /*
  public function register($patient) {
    if(!isset($patient["patient_name"])) throw new Exception("Account field is required");

    $account = $this->account_dao->insertEntity([

      "created_at" => date(Config::DATE_FORMAT);
      "password" => $patient["password"],
      "email" => $patient["email"],
      "type" => $patient["type"]

    ]);

    $user= parent:: insertEntity([
      "patient_name" => $patient["patient_name"],
      "patient_surname" => $patient["patient_surname"],
      "account_id" => $account["account_id"]


    ]);


  } */

  public function confirm($token) {

  }



/*
  public function insertEntity($patient) {
    // validation check
    if (!isset($patient["patient_name"])) {
        throw new Exception("Name is missing");
    }
    return parent::insertEntity($patient);

  } */



}




 ?>
