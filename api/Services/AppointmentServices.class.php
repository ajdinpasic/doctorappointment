<?php
require_once dirname(__FILE__)."/BaseService.class.php";



class AppointmentService extends BaseService {

  private $account_dao;

  public function __construct() {
    $this->dao=new AppointmentsDao();
    $this->account_dao= new AccountsDao();
  }

  public function getAppointmentService($offset,$limit,$order) {

    return $this->dao->getAllEntities($offset,$limit,$order);
  }

  public function getAppointmentByPatientOrDoctor($patient_id,$doctor_id) {

    if ($patient_id) {
      return $this->dao->getAppointmentByPatient($patient_id);
    }
    else if ($doctor_id) {

    return $this->dao->getAppointmentByDoctor($doctor_id);
  }

  }

}



 ?>
