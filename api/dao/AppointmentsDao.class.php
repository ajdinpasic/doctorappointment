<?php

require_once dirname (__FILE__)."/BaseDao.class.php";

class AppointmentsDao extends BaseDao {

  public function __construct() {
      parent::__construct("appointments","appointment_id");
  }


    public function getAllAppointmentsForDoctor($doctor_id,$total=FALSE) {
      
      if ($total) {
        return $this->query("SELECT COUNT(*) AS total FROM appointments WHERE doctor_id = :doctor_id",["doctor_id"=> $doctor_id]);
      } else {
      return $this->query("SELECT * FROM appointments WHERE doctor_id = :doctor_id",["doctor_id"=> $doctor_id]); }
    }

    public function getAllAppointmentsForPatient($patient_id,$total=FALSE) {
      if ($total) {
        return $this->query("SELECT COUNT(*) AS total FROM appointments WHERE patient_id = :patient_id",["patient_id"=> $patient_id]);
      } else {
      return $this->query("SELECT * FROM appointments WHERE patient_id = :patient_id",["patient_id"=> $patient_id]); }
    }

    public function getAppointmentByPatient($id) {
      return $this->query_unique("SELECT * FROM appointments WHERE patient_id = :patient_id",["patient_id"=> $id]);

    }
    public function getAppointmentByDoctor($id) {
      return $this->query_unique("SELECT * FROM appointments WHERE doctor_id = :doctor_id",["doctor_id"=> $id]);

    }
    public function getAppointmentForPatient($patient_id,$id) {
      return $this->query_unique("SELECT * FROM appointments WHERE patient_id = :patient_id AND appointment_id = :appointment_id",["patient_id"=> $patient_id,"appointment_id" => $id]);
    }
    public function getAppointmentForDoctor($doctor_id,$id) {
      return $this->query_unique("SELECT * FROM appointments WHERE doctor_id = :doctor_id AND appointment_id = :appointment_id",["doctor_id"=> $doctor_id,"appointment_id" => $id]);
    }




}





 ?>
