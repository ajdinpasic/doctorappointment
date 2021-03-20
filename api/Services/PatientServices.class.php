<?php

require_once dirname(__FILE__)."/../dao/BaseDao.class.php";

class PatientService {

  private $patient_dao;

  public function __construct() {
    $this->patient_dao=new PatientsDao();
  }


  public function getAccountService($search,$offset,$limit) {
    if ($search) {
      return $this->patient_dao->getPatientsByName($search,$offset,$limit);
    } else {

    return $this->patient_dao->getAllEntities($offset,$limit); }


} }




 ?>
