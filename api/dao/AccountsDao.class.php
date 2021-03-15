<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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

      return $this->insert("accounts",$account);

    }
    public function updateAccountById($account_id,$account) {

      $this->update($account_id,"accounts",$account,"account_id");
    }
    public function updateAccountbyEMail($email,$account) {
      $this->update($email,"accounts",$account,"email");
    }


  }



?>
