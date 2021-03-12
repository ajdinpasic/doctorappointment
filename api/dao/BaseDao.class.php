<?php

  require_once dirname(__FILE__)."/../config.php";

  class BaseDao {

    private $connection;

    public function __construct() {




      try {
      $this->connection = new PDO("mysql:host=".config::DB_HOST.";dbname=".config::DB_SCHEME, config::DB_USERNAME, config::DB_PASSWORD);
      // set the PDO error mode to exception
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // echo "Connected successfully";
      } catch(PDOException $e) {
        throw $e;
      }



  }

    public function insert() {

  }

    public function update() {

  }

    public function query($query,$parameters) {

      $stmt = $this->connection->prepare($query);
      $stmt->execute($parameters);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);


  }
    public function query_unique($query,$parameters) {
      $result=$this->query($query,$parameters);
      return reset($result);

  }

}



 ?>
