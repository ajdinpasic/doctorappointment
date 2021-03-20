<?php

require_once dirname(__FILE__)."/../dao/BaseDao.class.php";
require_once dirname(__FILE__)."/BaseService.class.php";
require_once dirname(__FILE__)."/../dao/AccountsDao.class.php";

class AccountService extends BaseService{

  public function __construct() {

    $this->dao=new AccountsDao();
  }

  public function getAccountService($search,$offset,$limit) {
    if ($search) {
      return $this->dao->getAccountByEmail($search,$offset,$limit);
    } else {

    return $this->dao->getAllEntities($offset,$limit); }




}


}


 ?>
