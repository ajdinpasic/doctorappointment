<?php

require_once dirname(__FILE__)."/BaseDao.class.php";

  class DoctorsDao extends BaseDao{

  /*  public function getDoctorbyId($id) {

  } */

  public function getAllDoctors() {
    return $this->query("SELECT * FROM doctors",[]);
  }
  public function getDoctorById($id) {
    return $this->query_unique("SELECT * FROM doctors WHERE doctor_id = :id",["id"=>$id]);
  }
  public function updateDoctorById($id,$doctor) {
    return $this->update($id,"doctors",$doctor,"doctor_id");
  }
  public function addDoctor($doctor) {
    return $this->insert("doctors",$doctor);
  }

  }



 ?>
