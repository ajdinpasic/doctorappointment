<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
  require_once dirname(__FILE__)."/../config.php";

  class BaseDao {

    protected $connection;
    private $table;
    private $unique_key;


    public function beginTransaction() {
    //  $this->connection->setAttribute(PDO::ATTR_AUTOCOMMIT,0);
      $this->connection->beginTransaction();
    }

    public function commit() {
      $this->connection->commit();
    //  $this->connection->setAttribute(PDO::ATTR_AUTOCOMMIT,1);
    }

    public function rollBack() {
      $this->connection->rollBack();
      //$this->connection->setAttribute(PDO::ATTR_AUTOCOMMIT,0);
    }


    public static function parse_order($order) {

      global $orderWay;

      switch(substr($order,0,1)) {
        case "+" :
         $orderWay = "DESC"; break;
        case "−" :
        $orderWay = "ASC"; break;
      };
      $orderColumn=substr($order,1);

      return [$orderColumn,$orderWay];

    }

    public function __construct($table,$unique_key) {
      $this->table=$table;
      $this->unique_key=$unique_key;

      try {
      $this->connection = new PDO("mysql:host=".config::DB_HOST.";dbname=".config::DB_SCHEME, config::DB_USERNAME, config::DB_PASSWORD);
      // set the PDO error mode to exception
      //$this->connection->setAttribute(PDO::ATTR_AUTOCOMMIT, 0);
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


      // echo "Connected successfully";
      } catch(PDOException $e) {
        throw $e;
      }



  }

    protected function insert($table,$entity) {

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

    protected function update($id,$table,$entity,$id_column="id") {
      $query="UPDATE ${table} SET ";
      foreach($entity as $key =>$value) {
        $query.=$key." = :".$key.", ";

      }
      $query=substr($query,0,-2);
      $query.=" WHERE $id_column = :id";

      //$sql = "UPDATE accounts SET created_at = :created_at, type = :type,  password = :password email = :email  WHERE account_id=:account_id";
      $stmt= $this->connection->prepare($query);
      $entity['id']=$id;
      $stmt->execute($entity);
      return $entity;

    }

    protected function query($query,$parameters) {

      $stmt = $this->connection->prepare($query);
      $stmt->execute($parameters);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);


    }
    protected function query_unique($query,$parameters) {
      $result=$this->query($query,$parameters);
      return reset($result);

    }
    public function insertEntity($data) {

      return $this->insert($this->table,$data);
    }
    public function updateEntity($id,$data) {
      return $this->update($id,$this->table,$data,$this->unique_key);
    }
    public function getEntity($id) {
      return $this->query_unique("SELECT * FROM ".$this->table." WHERE ".$this->unique_key." = :id",["id" => $id]);
    }

    public function getAllEntities($offset = 0, $limit = 25 ,$order="-id") {

      list($orderColumn,$orderWay)= self::parse_order($order);


      return $this->query("SELECT * FROM {$this->table}
        ORDER BY {$orderColumn} {$orderWay}
        LIMIT {$limit} OFFSET {$offset}",[]);
  }

}



 ?>
