<?php
class User{
  private $_id_user;
  private $_firstname;
  private $_lastname;
  private $_phone;
  private $_email;
  private $_address;
  private $_bank_account;
  private $_picture;
  private $_role;
  private $_type;
  private $_password;
  private $_confirmed;

  public function __construct($id,$firstname,$lastname,$phone,$email,$address,$bank,$picture,$role,$type,$password,$confirmed){
    $this->_id_user=$id;
    $this->_firstname=$firstname;
    $this->_lastname=$lastname;
    $this->_phone=$phone;
    $this->_email=$email;
    $this->_address=$address;
    $this->_bank_account=$bank;
    $this->_picture=$picture;
    $this->_role=$role;
    $this->_type=$type;
    $this->_password=$password;
    $this->_confirmed=$confirmed;
  }

  public function id(){
    return $this->_id_user;
  }

  public function firstname(){
    return $this->_firstname;
  }

  public function lastName(){
    return $this->_lastname;
  }

  public function phone(){
    return $this->_phone;
  }

  public function email(){
    return $this->_email;
  }

  public function address(){
    return $this->_address;
  }

  public function bank(){
    return $this->_bank_account;
  }

  public function picture(){
    return $this->_picture;
  }

  public function role(){
    return $this->_role;
  }

  public function type(){
    return $this->_type;
  }

  public function password(){
    return $this->_password;
  }

  public function confirmed(){
    return $this->_confirmed;
  }

  public function html_id(){
    return htmlspecialchars($this->_id_user);
  }

  public function html_firstname(){
    return htmlspecialchars($this->_firstname);
  }

  public function html_lastName(){
    return htmlspecialchars($this->_lastname);
  }

  public function html_phone(){
    return htmlspecialchars($this->_phone);
  }

  public function html_email(){
    return htmlspecialchars($this->_email);
  }

  public function html_address(){
    return htmlspecialchars($this->_address);
  }

  public function html_bank(){
    return htmlspecialchars($this->_bank_account);
  }

  public function html_picture(){
    return htmlspecialchars($this->_picture);
  }

  public function html_role(){
    return htmlspecialchars($this->_role);
  }

  public function html_type(){
    return htmlspecialchars($this->_type);
  }

  public function html_password(){
    return htmlspecialchars($this->_password);
  }

  public function html_confirmed(){
    return htmlspecialchars($this->_confirmed);
  }

}
?>
