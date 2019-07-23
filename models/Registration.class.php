<?php
class Registration{
  private $_id_registration;
  private $_user;
  private $_event;
  private $_payement;
  private $_date_registration;

  public function __construct($id,$user,$event,$payement,$date){
    $this->_id_registration=$id;
    $this->_user=$user;
    $this->_event=$event;
    $this->_payement=$payement;
    $this->_date_registration=$date;
  }

  public function id(){
    return $this->_id_registration;
  }

  public function user(){
    return $this->_user;
  }

  public function event(){
    return $this->_event
  }

  public function payement(){
    return $this->_payement;
  }

  public function date(){
    return $this->_date_registration;
  }

  public function html_id(){
    return htmlspecialchars($this->_id_registration);
  }

  public function html_user(){
    return htmlspecialchars($this->_user);
  }

  public function html_event(){
    return htmlspecialchars($this->_event);
  }

  public function html_payement(){
    return htmlspecialchars($this->_payement);
  }

  public function html_date(){
    return htmlspecialchars($this->_date_registration);
  }
}
?>
