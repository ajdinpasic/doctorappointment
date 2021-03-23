<?php

require_once dirname(__FILE__)."/BaseService.class.php";
require_once dirname(__FILE__)."/../dao/BaseDao.class.php";
require_once dirname(__FILE__)."/../dao/DoctorsDao.class.php";
require_once dirname(__FILE__)."/../dao/AccountsDao.class.php";

class DoctorService extends BaseService {

  private $account_dao;


  public function __construct() {
    $this->dao=new DoctorsDao();
    $this->account_dao= new AccountsDao();
  }


  public function getDoctorService($search,$offset,$limit,$order) {
    if ($search) {
      return $this->dao->getDoctorsByName($search,$offset,$limit,$order);
    } else {

    return $this->dao->getAllEntities($offset,$limit,$order); }


}
  public function register($doctor) {
    //if(!isset($patient["patient_name"])) throw new Exception("Account field is required");
    $this->dao->beginTransaction();
    try {


      $account = $this->account_dao->insertEntity([

        "type" => "doctor",
        "created_at" => date(Config::DATE_FORMAT)

      ]);

      $doctor= parent:: insertEntity([
        "account_id" => $account["id"],
        "doctor_name" => $doctor["doctor_name"],
        "doctor_surname" => $doctor["doctor_surname"],
        "doctor_email" => $doctor["doctor_email"],
        "password" => $doctor["password"],
        "token" => md5(random_bytes(16))

      ]);


    } catch (Exception $e) {
      $this->dao->rollBack();
      if (str_contains($e->getMessage(), "doctors.uq_email")) {
          throw new Exception("Account with same email exists in the database", 400);
    } else {
      throw $e;
   }


    }

    $this->dao->commit();
      return $doctor;
    // TODO: send email with some token
  }

  public function confirm($token) {
    $doctor= $this->dao->getDoctorsByToken($token);
    if (!isset($doctor["doctor_id"])) throw new Exception("Invalid token",400);
    $this->account_dao->updateEntity($doctor["account_id"],["status"=> "Active"]);

    //  TODO: send email to customer (success)
  }




}



 ?>
