<?php

require_once dirname (__FILE__)./"BaseDao.class.php";

class CreditCardDao extends BaseDao {

    public function getAllCreditCards() {
      return $this->query("SELECT * FROM creditcards",[]);
    }
    public function getCreditCardbyId($id) {
      return $this->query_unique("SELECT * FROM creditcards WHERE credit_card_id = :id",["id" => $id]);
    }
    public function getCreditCardbyId($id) {
      return $this->query_unique("SELECT * FROM creditcards WHERE patient_id = :id",["id" => $id]);
    }
    public function addCreditCard($card) {
      return $this->insert("creditcards",$card);
    }
}





 ?>
