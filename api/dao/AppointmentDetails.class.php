<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class AppointmentDetailsDao extends BaseDao {

      public function getAllDetails() {
        return $this->query("SELECT * FROM appointmentdetails",[]);
      }
      public function getDetailByAppointmentId($id) {
        return $this->query_unique("SELECT * FROM appointmentdetails WHERE appointment_id = :id",["id" => $id]);
      }




}




 ?>
