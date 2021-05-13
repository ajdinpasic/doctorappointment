<?php
require_once dirname(__FILE__)."/BaseService.class.php";



class AppointmentService extends BaseService {

  private $account_dao;

  public function __construct() {
    $this->dao=new AppointmentsDao();
    $this->account_dao= new AccountsDao();
    $this->doctor_dao=new DoctorsDao();
  }

  public function getAllAppointmentsDoctorService($id) {
    return $this->dao->getAllAppointmentsForDoctor($id);
  }

  public function getAllAppointmentsPatientService($id) {
    return $this->dao->getAllAppointmentsForPatient($id);
  }
/*
  public function getAppointmentByPatientOrDoctor($patient_id,$doctor_id) {

    if ($patient_id) {
      return $this->dao->getAppointmentByPatient($patient_id);
    }
    else if ($doctor_id) {

    return $this->dao->getAppointmentByDoctor($doctor_id);
  }

} */
  public function register($patient_id,$appointment) {

  $doctor=$this->doctor_dao->getEntity(strtolower($appointment["doctor_id"]));
  if(!isset($doctor["doctor_id"])) throw new Exception("Doctor does not exits",400);
    $appointment = parent:: insertEntity([
      "scheduled_at" => $appointment["scheduled_at"],
      "reserved_at" => date(Config::DATE_FORMAT),
      "office" => $appointment["office"],
      "patient_id" => $patient_id,
      "doctor_id" =>$doctor["doctor_id"]

  ]);

}

public function getAppointmentForPatient($patient_id,$id) {
  $patient= $this->dao->getAppointmentForPatient($patient_id,$id);
  if(!isset($patient["patient_id"])) throw new Exception("Patient did not schedule any appointment",400);
  return $patient;
}

public function getAppointmentForDoctor($doctor_id,$id) {
  $doctor= $this->dao->getAppointmentForDoctor($doctor_id,$id);
  if(!isset($doctor["doctor_id"])) throw new Exception("Doctor does not have any scheduled appointment",400);
  return $doctor;
}


}

 ?>
