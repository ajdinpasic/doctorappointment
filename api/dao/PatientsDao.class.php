<?php

 require_once dirname(__FILE__)."/BaseDao.class.php";



  class PatientsDao extends BaseDao{

    public function __construct() {
        parent::__construct("patients","patient_id");
    }

    public function getPatientByEmail($email) {
      return $this->query_unique("SELECT * FROM patients WHERE patient_email = :patient_email",["email"=>$email]);

    } /*

    public function getPatientById($id) {
      return $this->query_unique("SELECT * FROM patients WHERE patient_id = :patient_id",["patient_id" => $id]);
    }
    public function getAllPatients() {
      return $this->query("SELECT * FROM patients",[]);
    }
    public function updatePatientById($id,$patient) {
      $this->update($id,"patients",$patient,"patient_id");
    }
    public function addPatient($patient) {
      return $this->insert("patients",$patient);
    } */


  }




 ?>
