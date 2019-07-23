<?php
class Event{
  private $_id_event;
  private $_start_event;
  private $_end_event;
  private $_title;
  private $_description;
  private $_lat;
  private $_lng;
  private $_url;
  private $_cost;
  private $_url_picture;

  public function __construct($id,$start,$end,$title,$description,$lat,$lng,$url,$cost,$picture){
    $this->_id_event=$id;
    $this->_start_event=$start;
    $this->_end_event=$end;
    $this->_title=$title;
    $this->_description=$description;
    $this->_lat=$lat;
    $this->_lng=$lng;
    $this->_url=$url;
    $this->_cost=$cost;
    $this->_url_picture=$picture;
  }

  public function id(){
    return $this->_id_event;
  }
  public function start(){
    return $this->_start_event;
  }
  public function end(){
    return $this->_end_event;
  }
  public function title(){
    return $this->_title;
  }
  public function description(){
    return $this->_description;
  }
  public function lat(){
    return $this->_lat;
  }
  public function lng(){
    return $this->_lng;
  }
  public function url(){
    return $this->_url;
  }
  public function cost(){
    return $this->_cost;
  }
  public function picture(){
    return $this->_url_picture;
  }

  public function html_id(){
    return htmlspecialchars($this->_id_event);
  }
  public function html_start(){
    return htmlspecialchars($this->_start_event);
  }
  public function html_end(){
    return htmlspecialchars($this->_end_event);
  }
  public function html_title(){
    return htmlspecialchars($this->_title);
  }
  public function html_description(){
    return htmlspecialchars($this->_description);
  }
  public function html_lat(){
    return htmlspecialchars($this->_lat);
  }
  public function html_lng(){
    return htmlspecialchars($this->_lng);
  }
  public function html_url(){
    return htmlspecialchars($this->_url);
  }
  public function html_cost(){
    return htmlspecialchars($this->_cost);
  }
  public function html_picture(){
    return htmlspecialchars($this->_url_picture);
  }

}
?>
