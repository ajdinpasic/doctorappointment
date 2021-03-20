<?php

class BaseService {

  protected $dao;

  public function getEntity($id) {
    return $this->dao->getEntity($id);
  }

  public function insertEntity($data) {
    return $this->dao->insertEntity($data);
  }

  public function updateEntity($id,$data) {
    $this->dao->updateEntity($id,$data);
  }

}




 ?>
