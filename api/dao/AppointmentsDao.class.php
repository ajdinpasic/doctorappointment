<?php

require_once dirname (__FILE__)."/BaseDao.class.php";

class AppointmentsDao extends BaseDao {

  public function __construct() {
      parent::__construct("appointments","appointment_id");
  }


    public function getAllAppointments() {
      return $this->query("SELECT * FROM appointments",[]);
    }

    public function getAppointmentByPatient($id) {
      return $this->query_unique("SELECT * FROM appointments WHERE patient_id = :patient_id",["patient_id"=> $id]);

    }
    public function getAppointmentByDoctor($id) {
      return $this->query_unique("SELECT * FROM appointments WHERE doctor_id = :doctor_id",["doctor_id"=> $id]);

    }



    /*
    public function getAppointmentById($id) {
      return $this->query_unique("SELECT * FROM appointments WHERE appointment_id =:id",["id" => $id]);
    }
    public function getAppointmentByPatientId($id) {
      return $this->query_unique("SELECT * FROM appointments WHERE patient_id =:id",["id" => $id]);
    }
    public function getAppointmentByDoctorId($id) {
      return $this->query_unique("SELECT * FROM appointments WHERE doctor_id =:id",["id" => $id]);
    }
    public function updateAppointmentById($id,$appointment) {
      $this->update($id,"appointments",$appointment,"appointment_id");
    }
    public function addAppointment($appointment) {
      return $this->insert("appointments",$appointment);
    } */
}





 ?>
