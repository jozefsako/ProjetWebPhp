<?php
class Interest{
  private $_id_interest;
  private $_user;
  private $_event;
  private $_date_registration;

  public function __construct($id,$user,$event,$date){
    $this->_id_interest=$id;
    $this->_user=$user;
    $this->_event=$event;
    $this->_date_registration=$date;
  }

  public function id(){
    return $this->_id_interest;
  }

  public function user(){
    return $this->_user;
  }

  public function event(){
    return $this->_event;
  }

  public function date(){
    return $this->_date_registration;
  }

  public function html_id(){
    return htmlspecialchars($this->_id_interest);
  }

  public function html_user(){
    return htmlspecialchars($this->_user);
  }

  public function html_event(){
    return htmlspecialchars($this->_event);
  }

  public function html_date(){
    return htmlspecialchars($this->_date_registration);
  }

}
?>
