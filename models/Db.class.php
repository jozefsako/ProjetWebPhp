<?php
class Db
{
  private static $instance = null;
  private $_db;

  private function __construct(){
    try {
      $this->_db = new PDO('mysql:host=localhost;dbname=Projetweb;charset=utf8','root','root');
      $this->_db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      $this->_db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
    }
    catch (PDOException $e) {
      die('Erreur de connexion à la base de données : '.$e->getMessage());
    }
  }

  public static function getInstance(){
    if (is_null(self::$instance)) {
      self::$instance = new Db();
    }
    return self::$instance;
  }

  public function select_users() {
    $query = 'SELECT * FROM users';
    $ps = $this->_db->prepare($query);
    $ps->execute();
    $tableau = array();
    while ($row = $ps->fetch()) {
      $tableau[] = new User($row->id_user,$row->firstname,$row->lastname,$row->phone,$row->email,$row->address,$row->bank_account,$row->picture,$row->role,$row->type,$row->password,$row->confirmed);
    }
    return $tableau;
  }

  public function select_users_responsible() {
    $query = 'SELECT * FROM users WHERE confirmed="1" AND type!="m" ';
    $ps = $this->_db->prepare($query);
    $ps->execute();
    $tableau = array();
    while ($row = $ps->fetch()) {
      $tableau[] = new User($row->id_user,$row->firstname,$row->lastname,$row->phone,$row->email,$row->address,$row->bank_account,$row->picture,$row->role,$row->type,$row->password,$row->confirmed);
    }
    return $tableau;
  }

  public function select_confirmed_user(){
    $query = 'SELECT * FROM users WHERE confirmed="1" ';
    $ps = $this->_db->prepare($query);
    $ps->execute();
    $tableau = array();
    while ($row = $ps->fetch()) {
      $tableau[] = new User($row->id_user,$row->firstname,$row->lastname,$row->phone,$row->email,$row->address,$row->bank_account,$row->picture,$row->role,$row->type,$row->password,$row->confirmed);
    }
    return $tableau;
  }

  public function select_users_unregistred(){
    $query = 'SELECT * FROM users WHERE confirmed="0"';
    $ps = $this->_db->prepare($query);
    $ps->execute();
    $tableau = array();
    while ($row = $ps->fetch()) {
      $tableau[] = new User($row->id_user,$row->firstname,$row->lastname,$row->phone,$row->email,$row->address,$row->bank_account,$row->picture,$row->role,$row->type,$row->password,$row->confirmed);
    }
    return $tableau;
  }

  public function update_profile_picture($email,$picture){
    $query='UPDATE users SET picture=:picture WHERE email =:email';
    $ps = $this->_db->prepare($query);
    $ps->bindValue(':picture',$picture);
    $ps->bindValue(':email',$email);
    $ps->execute();
  }

  public function select_user($email) {
    $query = 'SELECT * FROM users WHERE email=:email';
    $ps = $this->_db->prepare($query);
    $ps->bindValue(':email',$email);
    $ps->execute();
    $user = "";
    while ($row = $ps->fetch()) {
      $user = new User($row->id_user,$row->firstname,$row->lastname,$row->phone,$row->email,$row->address,$row->bank_account,$row->picture,$row->role,$row->type,$row->password,$row->confirmed);
    }
    return $user;
  }

  public function confirm_user($id_user){
    $query='UPDATE users SET confirmed=1 WHERE id_user =:id_user';
    $ps = $this->_db->prepare($query);
    $ps->bindValue(':id_user',$id_user);
    $ps->execute();
  }

  public function insert_user($firstname,$email,$password){
    $query = 'INSERT INTO users (firstname,email,password) values (:firstname,:email,:password)';
    $ps = $this->_db->prepare($query);
    $ps->bindValue(':firstname',$firstname);
    $ps->bindValue(':email',$email);
    $ps->bindValue(':password',$password);
    return $ps->execute();
  }

  public function validate_user($email,$password){
    $query = 'SELECT * FROM users WHERE email=:email';
    $ps = $this->_db->prepare($query);
    $ps->bindValue(':email',$email);
    $ps->execute();
    if($ps->rowcount()==0){
      return false;
    }
    $hash = $ps->fetch()->password;
    return password_verify($password, $hash);
  }

  public function update_user_responsibility($id,$type,$role){
    $query='UPDATE users SET type=:type , role=:role WHERE id_user =:id';
    $ps = $this->_db->prepare($query);
    $ps->bindValue(':id',$id);
    $ps->bindValue(':type',$type);
    $ps->bindValue(':role',$role);
    $ps->execute();
  }

  public function update_user_info($id,$lastname,$firstname,$phone,$email,$address,$bank){
    $query='UPDATE users SET lastname=:lastname , firstname=:firstname, phone=:phone, email=:email,address=:address, bank_account=:bank WHERE id_user=:id';
    $ps = $this->_db->prepare($query);
    $ps->bindValue(':id',$id);
    $ps->bindValue(':lastname',$lastname);
    $ps->bindValue(':firstname',$firstname);
    $ps->bindValue(':phone',$phone);
    $ps->bindValue(':email',$email);
    $ps->bindValue(':address',$address);
    $ps->bindValue(':bank',$bank);
    $ps->execute();
  }

  public function update_user_password($id,$password){
    $query='UPDATE users SET password=:password WHERE id_user =:id';
    $ps = $this->_db->prepare($query);
    $ps->bindValue(':id',$id);
    $ps->bindValue(':password',$password);
    $ps->execute();
  }

  public function email_exists($email) {
    $query = 'SELECT * from users WHERE email=:email';
    $ps = $this->_db->prepare($query);
    $ps->bindValue(':email',$email);
    $ps->execute();
    return ($ps->rowcount() != 0);
  }
  
  public function delete_user($email){
	$query='DELETE FROM users WHERE email=:email';
	$ps = $this->_db->prepare($query);
	$ps->bindValue(':email',$email);
    $ps->execute();
  }

  public function select_events() {
    $query = 'SELECT * FROM events';
    $ps = $this->_db->prepare($query);
    $ps->execute();
    $tableau = array();
    while ($row = $ps->fetch()) {
      $tableau[] = new Event($row->id_event,$row->start_date,$row->end_date,$row->title,$row->description,$row->lat,$row->lng,$row->url,$row->cost,$row->url_picture);
    }
    return $tableau;
  }

  public function select_coming_events(){
    $query = 'SELECT * FROM events WHERE end_date>:date_du_jour';
    $ps = $this->_db->prepare($query);
    $ps->bindValue(':date_du_jour',DATE_DB);
    $ps->execute();
    $tableau = array();
    while ($row = $ps->fetch()) {
      $tableau[] = new Event($row->id_event,$row->start_date,$row->end_date,$row->title,$row->description,$row->lat,$row->lng,$row->url,$row->cost,$row->url_picture);
    }
    return $tableau;
  }

  public function select_old_events(){
    $query = 'SELECT * FROM events WHERE end_date<:date_du_jour';
    $ps = $this->_db->prepare($query);
    $ps->bindValue(':date_du_jour',DATE_DB);
    $ps->execute();
    $tableau = array();
    while ($row = $ps->fetch()) {
      $tableau[] = new Event($row->id_event,$row->start_date,$row->end_date,$row->title,$row->description,$row->lat,$row->lng,$row->url,$row->cost,$row->url_picture);
    }
    return $tableau;
  }

  public function insert_event($title,$start_date,$end_date,$description,$lat,$lng,$url,$cost){
    $query = 'INSERT INTO events (start_date,end_date,title,description,lat,lng,url,cost) values (:start_date,:end_date,:title,:description,:lat,:lng,:url,:cost)';
    $ps = $this->_db->prepare($query);
    $ps->bindValue(':start_date',$start_date);
    $ps->bindValue(':end_date',$end_date);
    $ps->bindValue(':title',$title);
    $ps->bindValue(':description',$description);
    $ps->bindValue(':lat',$lat);
    $ps->bindValue(':lng',$lng);
    $ps->bindValue(':url',$url);
    $ps->bindValue(':cost',$cost);
    return $ps->execute();
  }

  public function update_event($id_event,$title,$start_date,$end_date,$description,$lat,$lng,$url,$picture,$cost){
    $query='UPDATE events SET title=:title, start_date=:start_date, end_date=:end_date, description=:description, lat=:lat, lng=:lng, url=:url, url_picture=:picture, cost=:cost WHERE id_event =:id_event';
    $ps = $this->_db->prepare($query);
    $ps->bindValue(':id_event',$id_event);
    $ps->bindValue(':title',$title);
    $ps->bindValue(':start_date',$start_date);
    $ps->bindValue(':end_date',$end_date);
    $ps->bindValue(':description',$description);
    $ps->bindValue(':lat',$lat);
    $ps->bindValue(':lng',$lng);
    $ps->bindValue(':url',$url);
    $ps->bindValue(':picture',$picture);
    $ps->bindValue(':cost',$cost);
    $ps->execute();
  }

  public function select_registrations() {
    $query = 'SELECT * FROM registrations';
    $ps = $this->_db->prepare($query);
    $ps->execute();
    $tableau = array();
    while ($row = $ps->fetch()) {
      $tableau[] = new Registration($row->id_registration,$row->user,$row->event,$row->payement,$row->date_registration);
    }
    return $tableau;
  }

  public function select_registrations_not_paid(){
    $query='SELECT u.id_user as "id_user", u.email as "email", r.id_registration as "id_registration", e.title as "title" FROM users u, registrations r, events e WHERE u.id_user = r.user and e.id_event = r.event and r.payement="f" order by e.id_event';
    $ps = $this->_db->prepare($query);
    $ps->execute();
    $tableau = array();
    while ($row = $ps->fetch()) {
      $tableau[] = array($row->id_user,$row->email,$row->id_registration,$row->title);
    }
    return $tableau;
  }

  public function update_registration($id_registration){
    $query='UPDATE registrations SET payement="t" WHERE id_registration =:id_registration';
    $ps = $this->_db->prepare($query);
    $ps->bindValue(':id_registration',$id_registration);
    $ps->execute();
  }

  public function select_interests() {
    $query = 'SELECT * FROM interests';
    $ps = $this->_db->prepare($query);
    $ps->execute();
    $tableau = array();
    while ($row = $ps->fetch()) {
      $tableau[] = new Interest($row->id_registration,$row->user,$row->event,$row->date_registration);
    }
    return $tableau;
  }

  public function select_interests_by_event($id_event){
    $query = 'SELECT u.email as "email_user" FROM users u, interests i WHERE event=:id_event and u.id_user=i.user';
    $ps = $this->_db->prepare($query);
    $ps->bindValue(':id_event',$id_event);
    $ps->execute();
    $tableau = array();
    while ($row = $ps->fetch()) {
      $tableau[] = $row->email_user;
    }
    return $tableau;
  }

  public function select_subscripted_by_event($id_event){
    $query = 'SELECT u.email as "email_user" FROM users u, registrations r WHERE event=:id_event and u.id_user=r.user';
    $ps = $this->_db->prepare($query);
    $ps->bindValue(':id_event',$id_event);
    $ps->execute();
    $tableau = array();
    while ($row = $ps->fetch()) {
      $tableau[] = $row->email_user;
    }
    return $tableau;
  }

  public function select_users_by_event($id_event){
    $query = 'SELECT u.email as "email_user" FROM users u, registrations r WHERE event=:id_event and u.id_user=r.user UNION SELECT u.email as "email_user" FROM users u, interests i WHERE event=:id_event and u.id_user=i.user';
    $ps = $this->_db->prepare($query);
    $ps->bindValue(':id_event',$id_event);
    $ps->execute();
    $tableau = array();
    while ($row = $ps->fetch()) {
      $tableau[] = $row->email_user;
    }
    return $tableau;
  }

  public function select_users_by_event2($id_event){
    $query = 'SELECT u.firstname as "firstname", u.lastname as "lastname", u.email as "email" FROM users u, registrations r WHERE event=:id_event and u.id_user=r.user UNION SELECT u.firstname as "firstname", u.lastname as "lastname", u.email as "email" FROM users u, interests i WHERE event=:id_event and u.id_user=i.user';
    $ps = $this->_db->prepare($query);
    $ps->bindValue(':id_event',$id_event);
    $ps->execute();
    $tableau = array();
    while ($row = $ps->fetch()) {
      $tableau[] = array($row->firstname,$row->lastname,$row->email);
    }
    return $tableau;
  }

  public function select_contributions() {
    $query = 'SELECT * FROM contributions';
    $ps = $this->_db->prepare($query);
    $ps->execute();
    $tableau = array();
    while ($row = $ps->fetch()) {
      $tableau[] = new Contribution($row->id_contribution,$row->year,$row->cost);
    }
    return $tableau;
  }

  public function insert_contribution($year,$cost){
    $query = 'INSERT INTO contributions (year,cost) values (:year,:cost)';
    $ps = $this->_db->prepare($query);
    $ps->bindValue(':year',$year);
    $ps->bindValue(':cost',$cost);
    return $ps->execute();
  }

  public function contribution_exists($year) {
    $query = 'SELECT * from contributions WHERE year=:year';
    $ps = $this->_db->prepare($query);
    $ps->bindValue(':year',$year);
    $ps->execute();
    return ($ps->rowcount() != 0);
  }

  public function select_user_contributions() {
    $query = 'SELECT * FROM user_contributions';
    $ps = $this->_db->prepare($query);
    $ps->execute();
    $tableau = array();
    while ($row = $ps->fetch()) {
      $tableau[] = new UserContribution($row->id_user_contribution,$row->user,$row->contribution,$row->date_payement);
    }
    return $tableau;
  }

  public function insert_user_contribution($user,$contribution,$amount_payement,$date_payement){
    $query = 'INSERT INTO user_contributions (user,contribution,amount_payement,date_payement) values (:user,:contribution,:amount_payement,:date_payement)';
    $ps = $this->_db->prepare($query);
    $ps->bindValue(':user',$user);
    $ps->bindValue(':contribution',$contribution);
    $ps->bindValue(':amount_payement',$amount_payement);
    $ps->bindValue(':date_payement',$date_payement);
    return $ps->execute();
  }

  public function select_all_contributions_not_paid($year){
    $query = 'SELECT u.id_user , u.email as "user", c.id_contribution, c.year FROM users u, contributions c WHERE u.confirmed=1 AND c.year=:year AND u.id_user NOT IN ( SELECT uc.user FROM user_contributions uc WHERE  uc.contribution = c.id_contribution)';
    $ps = $this->_db->prepare($query);
    $ps->bindValue(':year',$year);
    $ps->execute();
    $tab = array();
    while($row = $ps->fetch()){
      $tab[]= array($row->id_user,$row->user,$row->id_contribution,$row->year);
    }
    return $tab;
  }

  public function select_training_plans() {
    $query = 'SELECT * FROM training_plans';
    $ps = $this->_db->prepare($query);
    $ps->execute();
    $tableau = array();
    while ($row = $ps->fetch()) {
      $tableau[] = new TrainingPlan($row->id_training_plan,$row->name,$row->$row->start_date,$row->end_date);
    }
    return $tableau;
  }

  public function select_training_plan($start_date) {
    $query = 'SELECT * FROM training_plans WHERE start_date=:start_date';
    $ps = $this->_db->prepare($query);
    $ps->bindValue(':start_date',$start_date);
    $ps->execute();
    $tp = NULL;
    while ($row = $ps->fetch()) {
      $tp = new TrainingPlan($row->id_training_plan,$row->name,$row->start_date,$row->end_date);
    }
    return $tp;
  }

  public function insert_training_plan($name,$start_date){
    $query = 'INSERT INTO training_plans (name,start_date) values (:name,:start_date)';
    $ps = $this->_db->prepare($query);
    $ps->bindValue(':name',$name);
    $ps->bindValue(':start_date',$start_date);
    return $ps->execute();
  }

  public function update_date_training_plan($start_date,$end_date){
    $query='UPDATE training_plans SET end_date=:end_date WHERE start_date =:start_date';
    $ps = $this->_db->prepare($query);
    $ps->bindValue(':start_date',$start_date);
    $ps->bindValue(':end_date',$end_date);
    $ps->execute();
  }

  public function select_trainings() {
    $query = 'SELECT * FROM trainings';
    $ps = $this->_db->prepare($query);
    $ps->execute();
    $tableau = array();
    while ($row = $ps->fetch()) {
      $tableau[] = new Training($row->id_training,$row->description,$row->training_plan,$row->training_date);
    }
    return $tableau;
  }

  public function insert_trainings($description,$training_plan,$training_date){
    $query = 'INSERT INTO trainings (description,training_plan,training_date) values (:description,:training_plan,:training_date)';
    $ps = $this->_db->prepare($query);
    $ps->bindValue(':description',$description);
    $ps->bindValue(':training_plan',$training_plan);
    $ps->bindValue(':training_date',$training_date);
    return $ps->execute();
  }

  public function select_training_plan_users() {
    $query = 'SELECT * FROM training_plans_users';
    $ps = $this->_db->prepare($query);
    $ps->execute();
    $tableau = array();
    while ($row = $ps->fetch()) {
      $tableau[] = new TrainingPlanUser($row->id_training_plan_user,$row->user,$row->training_plan);
    }
    return $tableau;
  }
  
  public function insert_training_plan_user($user,$training_plan){
	$query = 'INSERT INTO training_plans_users (user,training_plan) values (:user,:training_plan)';
	$ps = $this->_db->prepare($query);
    $ps->bindValue(':user',$user);
    $ps->bindValue(':training_plan',$training_plan);
    return $ps->execute();
  }
  
}
