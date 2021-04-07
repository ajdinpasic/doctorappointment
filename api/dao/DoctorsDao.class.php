<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once dirname(__FILE__)."/BaseDao.class.php";

  class DoctorsDao extends BaseDao{
    public function __construct() {
        parent::__construct("doctors","doctor_id");
    }

    public function getDoctorsByToken($token) {
      return $this->query_unique("SELECT * FROM doctors WHERE token = :token",["token"=> $token]);
    }


    public function getDoctorsByName($search,$offset,$limit,$order) {

      list($orderColumn,$orderWay)= self:: parse_order($order);


      return $this->query("SELECT * FROM doctors
        WHERE LOWER(doctor_name) LIKE CONCAT('%', :doctor_name, '%')
        ORDER BY {$order} {$orderWay}
        LIMIT {$limit} OFFSET {$offset}",["doctor_name" =>strtolower($search) /*"orderWay" => $orderWay*/]);

}

  /*  public function getDoctorbyId($id) {

  }

  public function getDcotorBy() {
    return $this->query("SELECT * FROM doctors",[]);
  } */
  public function getDoctorByEmail($email) {
    return $this->query_unique("SELECT * FROM doctors WHERE doctor_email = :doctor_email",["doctor_email"=>$email]);
  }

  public function getDoctorByNameForAppointment($name) {
    return $this->query_unique("SELECT * FROM doctors WHERE doctor_name = :doctor_name",["doctor_name"=>strtolower($name)]);
  }

  /*
  public function updateDoctorById($id,$doctor) {
    return $this->update($id,"doctors",$doctor,"doctor_id");
  }
  public function addDoctor($doctor) {
    return $this->insert("doctors",$doctor);
  } */


}


 ?>
