<?php
class Contribution{

  private $_id_contribution;
  private $_year;
  private $_cost;

  public function __construct($id,$year,$cost){
    $this->_id_contribution=$id;
    $this->_year=$year;
    $this->_cost=$cost;
  }

  public function id(){
    return $this->_id_contribution;
  }

  public function year(){
    return $this->_year;
  }

  public function cost(){
    return $this->_cost;
  }

  public function html_id(){
    return htmlspecialchars($this->_id_contribution);
  }

  public function html_year(){
    return htmlspecialchars($this->_year);
  }

  public function html_cost(){
    return htmlspecialchars($this->_cost);
  }

}
?>
