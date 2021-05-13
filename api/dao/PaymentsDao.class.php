<?php

require_once dirname (__FILE__)."/BaseDao.class.php";

class PaymentsDao extends BaseDao {
  public function __construct() {
      parent::__construct("payments","payment_id");
  }
    public function getCreditCardbyPatientId($id) {
      return $this->query_unique("SELECT * FROM creditcards WHERE patient_id = :id",["id" => $id]);
    }
    public function getPayment($patient_id,$appointment_id) {
      return $this->query_unique("SELECT * FROM payments WHERE patient_id = :patient_id AND appointment_id = :appointment_id",["patient_id"=> $patient_id,"appointment_id" => $appointment_id]);
    }
}





 ?>
