<?php

require_once dirname (__FILE__)./"BaseDao.class.php";

class AppointmentsDao extends BaseDao {
    public function getAllAppointments() {
      return $this->query("SELECT * FROM appointments",[]);
    }
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
}





 ?>
