<?php

require_once dirname(__FILE__)."/../dao/BaseDao.class.php";
require_once dirname(__FILE__)."/BaseService.class.php";
require_once dirname(__FILE__)."/../dao/PatientsDao.class.php";
class PatientService extends BaseService{


  public function __construct() {
    $this->dao=new PatientsDao();
  }


  public function getPatientService($search,$offset,$limit) {
    if ($search) {
      return $this->dao->getPatientsByName($search,$offset,$limit);
    } else {

    return $this->dao->getAllEntities($offset,$limit); }


}
  public function insertEntity($patient) {
    // validation check
    if (!isset($patient["patient_name"])) {
        throw new Exception("Name is missing");
    }
    return parent::insertEntity($patient);

  }



}




 ?>
