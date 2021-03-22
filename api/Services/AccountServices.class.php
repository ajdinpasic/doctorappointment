<?php

require_once dirname(__FILE__)."/../dao/BaseDao.class.php";
require_once dirname(__FILE__)."/BaseService.class.php";
require_once dirname(__FILE__)."/../dao/AccountsDao.class.php";

class AccountService extends BaseService{

  public function __construct() {

    $this->dao=new AccountsDao();
  }

  public function getAccountService($offset,$limit,$order) {


    return $this->dao->getAllEntities($offset,$limit,$order); }




}





 ?>
