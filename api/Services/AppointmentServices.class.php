<?php
require_once dirname(__FILE__)."/BaseService.class.php";


class AppointmentService extends BaseService {


  public function __construct() {
    $this->dao=new AppointmentsDao();
  }


}



 ?>
