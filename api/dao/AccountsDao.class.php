<?php

require_once dirname(__FILE__)."/BaseDao.class.php";

  class AccountsDao extends BaseDao{

    public function getAccountById($id) {
      return $this->query_unique("SELECT * FROM accounts WHERE account_id = :account_id",["account_id"=>$id]);
    }
    /*public function addAccount($account) {

    } */

    public function getAccountbyEmail($email) {
      return $this->query_unique("SELECT * FROM accounts WHERE email = :email",["email"=>$email]);
    }

    public function getAccountByType($type) {

      return $this->query("SELECT * FROM accounts where type = :type",["type"=>$type]);

    }

    public function addAccount($account) {
      $sql = "INSERT INTO accounts (created_at, type, password, email) VALUES (:created_at, :type, :password, :email)";
      $stmt= $this->connection->prepare($sql);
      $stmt->execute($account);


    }
    public function updateAccount($account_id,$account) {

      $query="UPDATE accounts SET ";
      foreach($account as $key =>$value) {
        $query.=$key." = :".$key.", ";

      }
      $query=substr($query,0,-2);
      $query.=" WHERE account_id = :account_id";

      //$sql = "UPDATE accounts SET created_at = :created_at, type = :type,  password = :password email = :email  WHERE account_id=:account_id";
      $stmt= $this->connection->prepare($query);
      $account["account_id"]=$account_id;
      $stmt->execute($account);
    }



  }



?>
