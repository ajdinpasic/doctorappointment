<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
  require_once dirname(__FILE__)."/../config.php";

  class BaseDao {

    protected $connection;

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

    public function insert($table,$entity) {
      $query="INSERT INTO ".$table." ( ";
      foreach($entity as $key => $value) {
        $query.=$key.", ";
      }
      $query=substr($query,0,-2);
      $query.=") VALUES ( ";
      foreach ($entity as $key => $value) {
        $query.=":".$key.", ";
      }
      $query=substr($query,0,-2);
      $query.=")";
      $stmt=$this->connection->prepare($query);
      $stmt->execute($entity);
      $entity['id']=$this->connection->lastInsertId();
      return $entity;
  }

    public function update($id,$table,$entity,$id_column="id") {
      $query="UPDATE ${table} SET ";
      foreach($entity as $key =>$value) {
        $query.=$key." = :".$key.", ";

      }
      $query=substr($query,0,-2);
      $query.=" WHERE $id_column = :id";

      //$sql = "UPDATE accounts SET created_at = :created_at, type = :type,  password = :password email = :email  WHERE account_id=:account_id";
      $stmt= $this->connection->prepare($query);
      $entity["id"]=$id;
      $stmt->execute($entity);

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
