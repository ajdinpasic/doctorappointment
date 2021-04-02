<?php

require_once dirname(__FILE__)."/../dao/BaseDao.class.php";
require_once dirname(__FILE__)."/BaseService.class.php";
require_once dirname(__FILE__)."/../dao/PatientsDao.class.php";
require_once dirname(__FILE__)."/../dao/AccountsDao.class.php";
require_once dirname(__FILE__)."/../clients/SMTPclient.class.php";

class PatientService extends BaseService{

  private $account_dao;
  private $smtpclient;

  public function __construct() {
    $this->dao=new PatientsDao();
    $this->account_dao= new AccountsDao();
    $this->smtpclient= new SMTPclient();
  }


  public function getPatientService($search,$offset,$limit,$order) {
    if ($search) {
      return $this->dao->getPatientsByName($search,$offset,$limit,$order);
    } else {

    return $this->dao->getAllEntities($offset,$limit,$order); }


}
  public function register($patient) {
    //if(!isset($patient["patient_name"])) throw new Exception("Account field is required");

    try {
      $this->dao->beginTransaction();

      $account = $this->account_dao->insertEntity([

        "type" => "patient",
        "created_at" => date(Config::DATE_FORMAT)

      ]);

      $patient= parent:: insertEntity([
        "account_id" => $account["id"],
        "patient_name" => $patient["patient_name"],
        "patient_surname" => $patient["patient_surname"],
        "patient_email" => $patient["patient_email"],
        "password" => md5($patient["password"]),
        "token" => md5(random_bytes(16))

      ]);

      $this->dao->commit();
    } catch (Exception $e) {
      $this->dao->rollBack();
      if (str_contains($e->getMessage(), "patients.uq_email")) {
          throw new Exception("Account with same email exists in the database", 400);
    } else {
      throw $e;
   }


    }

    $this->smtpclient->send_token_for_registrationPatient($patient);
      return $patient;
    // TODO: send email with some token
  }

  public function confirm($token) {
    $patient= $this->dao->getPatientsByToken($token);
    if (!isset($patient["patient_id"])) throw new Exception("Invalid token",400);
    $this->account_dao->updateEntity($patient["account_id"],["status"=> "Active"]);

    //  TODO: send email to customer (success)
  }

  public function login($patient) {
      $result1=$this->dao->getPatientByEmail($patient["patient_email"]);
      if (!isset($result1["patient_id"])) throw new Exception ("Doctor does not exist",400);
      $result2=$this->account_dao->getAccountById($result1["account_id"]);
      if ($result2["status"] != "Active") throw new Exception ("Account is not confirmed ",400);
      if ($result1["password"] != md5($patient["password"])) throw new Exception ("invalid password",400);

      //return $result1;
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
