<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once dirname(__FILE__)."/BaseDao.class.php";

  class AccountsDao extends BaseDao{

    public function __construct() {
        parent::__construct("accounts","account_id");
    }
    public function getAccountById($id) {
      return $this->query_unique("SELECT * FROM accounts WHERE account_id = :account_id",["account_id"=>$id]);
    } 
}

?>
