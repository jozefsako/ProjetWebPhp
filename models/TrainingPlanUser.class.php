<?php
class TrainingPlanUser{
  private $_id_training_plan_user;
  private $_user;
  private $_training_plan;

  public function __construct($id,$user,$plan){
    $this->_id=$id;
    $this->_user=$user;
    $this->_plan=$plan;
  }

  public function id(){
    return $this->_id_training_plan_user;
  }

  public function user(){
    return $this->_user;
  }

  public function plan(){
    return $this->_training_plan;
  }

  public function html_id(){
    return htmlspecialchars($this->_id_training_plan_user);
  }

  public function html_user(){
    return htmlspecialchars($this->_user);
  }

  public function html_plan(){
    return htmlspecialchars($this->_training_plan);
  }

}
?>
