<?php
class TrainingPlan{
  private $_id_training_plan;
  private $_name;
  private $_start_date;
  private $_end_date;

  public function __construct($id,$name,$start,$end){
    $this->_id_training_plan=$id;
    $this->_name=$name;
    $this->_start_date=$start;
    $this->_end_date=$end;
  }

  public function id(){
    return $this->_id_training_plan;
  }

  public function name(){
    return $this->_name;
  }

  public function start(){
    return $this->_start_date;
  }

  public function end(){
    return $this->_end_date;
  }

  public function html_id(){
    return htmlspecialchars($this->_id_training_plan);
  }

  public function html_name(){
    return htmlspecialchars($this->_name);
  }

  public function html_start(){
    return htmlspecialchars($this->_start_date);
  }

  public function html_end(){
    return htmlspecialchars($this->_end_date);
  }

}
?>
