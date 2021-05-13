<?php
require_once dirname(__FILE__)."/BaseService.class.php";


class DetailService extends BaseService {

  private $account_dao;
  private $sad;

  public function __construct() {
    $this->dao=new AppointmentsDao();
    $this->sad=new AppointmentDetailsDao();
    $this->account_dao= new AccountsDao();
    $this->doctor_dao=new DoctorsDao();
  }

  public function registracija($doctor_id,$detail) {

  $doctor=$this->dao->getAppointmentForDoctor($doctor_id,$detail["appointment_id"]);
  if(!isset($doctor["appointment_id"])) throw new Exception("Appointment does not exits",400);
  $detail = $this->sad->insertEntity([
    "p" => $detail["p"],
    "prescription" => $detail["prescription"],
    "type" => $detail["type"],
    "appointment_id" => $doctor["appointment_id"]


]);

}

public function getAllDetailsDoctorService($doctor_id,$id) {

  $appointment=$this->dao->getAppointmentForDoctor($doctor_id,$id);
  if(!isset($appointment["doctor_id"])) throw new Exception("Appointment does not exits",400);
  $result=$this->sad->getDetailForDoctor($id);
  return $result;
}

public function getAllDetailsPatientService($patient_id,$id) {

  $appointment=$this->dao->getAppointmentForPatient($patient_id,$id);
  if(!isset($appointment["patient_id"])) throw new Exception("Appointment does not exits",400);
  $result=$this->sad->getDetailForPatient($id);
  return $result;
}



}






 ?>
