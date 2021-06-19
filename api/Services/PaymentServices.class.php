<?php
require_once dirname(__FILE__)."/BaseService.class.php";


class PaymentService extends BaseService {

  private $account_dao;
  private $sad;

  public function __construct() {
    $this->dao=new AppointmentsDao();
    $this->sad=new AppointmentDetailsDao();
    $this->account_dao= new AccountsDao();
    $this->payment_dao=new PaymentsDao();
  }

  public function register($patient_id,$payment) {
  $appointment=$this->dao->getAppointmentForPatient($patient_id,$payment["appointment_id"]);
  if(!isset($appointment["appointment_id"])) throw new Exception("Payment does not exits",400);
  $payment = $this->payment_dao->insertEntity([
    "amount" => $payment["amount"],
    "payment_date" => date(Config::DATE_FORMAT),
    "serial_number" => $payment["serial_number"],
    "patient_id" => $patient_id,
    "appointment_id" => $payment["appointment_id"]


]); }

public function getPaymentService($patient_id,$id) {
  $appointment=$this->dao->getAppointmentForPatient($patient_id,$id);
  if(!isset($appointment["appointment_id"])) throw new Exception("Payment does not exits",400);
  return $this->payment_dao->getPayment($patient_id,$id);
}







}






 ?>
