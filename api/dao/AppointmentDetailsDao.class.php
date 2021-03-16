<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class AppointmentDetailsDao extends BaseDao {

  public function __construct() {
    parent:: __construct("appointmentdetails","app_detail_id");
  }

      public function getAllDetails() {
        return $this->query("SELECT * FROM appointmentdetails",[]);
      } /*
      public function getDetailByAppointmentId($id) {
        return $this->query_unique("SELECT * FROM appointmentdetails WHERE appointment_id = :id",["id" => $id]);
      }
      public function addDetails($detail) {
        return $this->insert("appointmentdetails",$detail);
      }
      public function updateDetailsByAppointmentId($id,$detail) {
        $this->update($id,"appointmentdetails",$detail,"appointment_id");
      } */



}




 ?>
