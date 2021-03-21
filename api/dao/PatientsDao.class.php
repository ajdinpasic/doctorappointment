<?php

 require_once dirname(__FILE__)."/BaseDao.class.php";



  class PatientsDao extends BaseDao{

    public function __construct() {
        parent::__construct("patients","patient_id");
    }

    public function getPatientsByName($search,$offset,$limit,$order) {
/*
      global $orderWay;

      switch(substr($order,0,1)) {
        case "+" :
         $orderWay = "DESC"; break;
        case "−" :
        $orderWay = "ASC"; break;
      };
      $orderColumn=substr($order,1); */


      return $this->query("SELECT * FROM patients
        WHERE LOWER(patient_name) LIKE CONCAT('%', :patient_name, '%')
        ORDER BY {$order} DESC
        LIMIT {$limit} OFFSET {$offset}",["patient_name" =>strtolower($search) /*"orderWay" => $orderWay*/]);
    }
    public function getPatientsByToken($token) {
      return $this->query_unique("SELECT * FROM patients WHERE token = :token",["token"=> $token]);
    }

    }

     /*

    public function getPatientById($id) {
      return $this->query_unique("SELECT * FROM patients WHERE patient_id = :patient_id",["patient_id" => $id]);
    }
    public function getAllPatients() {
      return $this->query("SELECT * FROM patients",[]);
    }
    public function updatePatientById($id,$patient) {
      $this->update($id,"patients",$patient,"patient_id");
    }
    public function addPatient($patient) {
      return $this->insert("patients",$patient);
    } */







 ?>
