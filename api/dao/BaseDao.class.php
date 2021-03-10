<?php

  class BaseDao {

    public function __construct() {
      $servername = "localhost";
      $username = "doctorappointment";
      $password = "doctorappointment";

      try {
      $conn = new PDO("mysql:host=$servername;dbname=doctorappointment", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "Connected successfully";
      } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
      }



  }

    public function insert() {

  }

    public function update() {

  }

    public function query() {


  }
    public function query_unique() {


  }

}



 ?>
