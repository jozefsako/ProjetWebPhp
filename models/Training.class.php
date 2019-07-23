<?php
class Training{
  private $_id_training;
  private $_description;
  private $_training_plan;
  private $_training_date;

  public function __construct($id,$description,$plan,$date){
    $this->_id_training=$id;
    $this->_description=$description;
    $this->_training_plan=$plan;
    $this->_training_date=$date;
  }

  public function id(){
    return $this->_id_training;
  }

  public function description(){
    return $this->_description;
  }

  public function plan(){
    return $this->_training_plan;
  }

  public function date(){
    return $this->_training_date;
  }

  public function html_id(){
    return htmlspecialchars($this->_id_training);
  }

  public function html_description(){
    return htmlspecialchars($this->_description);
  }

  public function html_plan(){
    return htmlspecialchars($this->_training_plan);
  }

  public function html_date(){
    return htmlspecialchars($this->_training_date);
  }

}
?>
