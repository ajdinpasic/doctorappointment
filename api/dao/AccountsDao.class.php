<?php

require_once dirname(__FILE__)."/BaseDao.class.php";

  class AccountsDao extends BaseDao{

    public function getUserById($id) {
      return $this->query_unique("SELECT * FROM accounts WHERE account_id = :account_id",["account_id"=>$id]);
    }
    /*public function addAccount($account) {

    } */
    public function getUserByType($type) {
      return $this->query("SELECT * FROM accounts WHERE type = :type",["type"=>$type]);
    }

  }



?>
