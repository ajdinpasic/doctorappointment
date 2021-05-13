<?php

require_once dirname(__FILE__)."/BaseService.class.php";
require_once dirname(__FILE__)."/../dao/BaseDao.class.php";
require_once dirname(__FILE__)."/../dao/DoctorsDao.class.php";
require_once dirname(__FILE__)."/../dao/AccountsDao.class.php";
require_once dirname(__FILE__)."/../clients/SMTPclient.class.php";

class DoctorService extends BaseService {


  private $account_dao;
  private $smtpclient;


  public function __construct() {
    $this->dao=new DoctorsDao();
    $this->account_dao= new AccountsDao();
    $this->smtpclient=new SMTPclient();
  }


  public function getDoctorService($search,$offset,$limit,$order) {
    if ($search) {
      return $this->dao->getDoctorsByName($search,$offset,$limit,$order);
    } else {

    return $this->dao->getAllEntities($offset,$limit,$order); }


}
  public function register($doctor) {
    //if(!isset($patient["patient_name"])) throw new Exception("Account field is required");

    try {
      $this->dao->beginTransaction();

      $account = $this->account_dao->insertEntity([

        "type" => "doctor",
        "created_at" => date(Config::DATE_FORMAT),
        "role" => "user"

      ]);

      $doctor= parent:: insertEntity([
        "account_id" => $account["id"],
        "doctor_name" => $doctor["doctor_name"],
        "doctor_surname" => $doctor["doctor_surname"],
        "doctor_email" => $doctor["doctor_email"],
        "password" => md5($doctor["password"]),
        "token" => md5(random_bytes(16))

      ]);

      $this->dao->commit();
    } catch (Exception $e) {
      $this->dao->rollBack();
      if (str_contains($e->getMessage(), "doctors.uq_email")) {
          throw new Exception("Account with same email exists in the database", 400);
    } else {
      throw $e;
   }


    }

      $this->smtpclient->send_token_for_registrationDoctor($doctor);
      return $doctor;

  }

  public function confirm($token) {
    $doctor= $this->dao->getDoctorsByToken($token);
    if (!isset($doctor["doctor_id"])) throw new Exception("Invalid token",400);
    $this->account_dao->updateEntity($doctor["account_id"],["status"=> "Active"]);

    //  TODO: send email to customer (success)
  }

public function login($doctor) {
    $result1=$this->dao->getDoctorByEmail($doctor["doctor_email"]);
    if (!isset($result1["doctor_id"])) throw new Exception ("Doctor does not exist",400);
    $result2=$this->account_dao->getAccountById($result1["account_id"]);
    if ($result2["status"] != "Active") throw new Exception ("Account is not confirmed ",400);
    if ($result1["password"] != md5($doctor["password"])) throw new Exception ("invalid password",400);
    $jwt = (array)\Firebase\JWT\JWT::encode(["exp"=> (time()+Config::JWT_EXPIRE_TIME),"doctor_id" => $result1["doctor_id"],"account_id" =>$result1["account_id"],"role" =>$result2["role"]], Config::JWT_SECRET);
    return ["token" => $jwt];
}

public function forget($doctor) {
  $result1=$this->dao->getDoctorByEmail($doctor["doctor_email"]);
  if (!isset($result1["doctor_id"])) throw new Exception ("Doctor does not exist",400);
    if (strtotime(date(Config::DATE_FORMAT)) - strtotime($result1["token_expire"])  < 300 ) throw new Exception("Token overload",400);
  $newToken=md5(random_bytes(16));
  $result2=$this->updateEntity($result1["doctor_id"],["token" =>$newToken,"token_expire" => date(Config::DATE_FORMAT)]);
  $result1["token"]=$newToken;
  $this->smtpclient->send_token_for_resetPasswordDoctor($result1);
}



public function reset($doctor) {
  $result1=$this->dao->getDoctorsByToken($doctor["token"]);
  if (!isset($result1["doctor_id"])) throw new Exception ("Invalid token",400);
  if (strtotime(date(Config::DATE_FORMAT)) - strtotime($result1["token_expire"]) > 300 ) throw new Exception("Token session expired",400);
  $this->dao->updateEntity($result1["doctor_id"],["password" => md5($doctor["password"])]);
}


}



 ?>
