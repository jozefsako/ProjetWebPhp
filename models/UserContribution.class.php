<?php
class UserContribution{

  private $_id_user_contribution;
  private $_user;
  private $_contribution;
  private $_amount_payement;
  private $_date_payement;

  public function __construct($id,$user,$contribution,$amount,$date){
    $this->_id_user_contribution=$id;
    $this->_user=$user;
    $this->_contribution=$contribution;
    $this->_amount_payement=$amount;
    $this->_date_payement=$date;
  }

  public function id(){
    return $this->_id_user_contribution;
  }
  public function user(){
    return $this->_user;
  }
  public function contribution(){
    return $this->_contribution;
  }
  public function amount(){
    return $this->_amount_payement;
  }
  public function date(){
    return $this->_date_payement;
  }

  public function html_id(){
    return htmlspecialchars($this->_id_user_contribution);
  }
  public function html_user(){
    return htmlspecialchars($this->_user);
  }
  public function html_contribution(){
    return htmlspecialchars($this->_contribution);
  }
  public function html_amount(){
    return htmlspecialchars($this->_amount_payement);
  }
  public function html_date(){
    return htmlspecialchars($this->_date_payement);
  }
}
?>
