<?php
class TrainingPlanController{

  private $_db;

  public function __construct($db) {
    $this->_db = $db;
  }

  public function run(){

    if (empty($_SESSION['authenticated'])) {
      header("Location: index.php?action=login");
      die();
    }else{
      if(!empty($_SESSION['authenticated']) && $_SESSION['type']!='c') {
        header("Location: index.php?action=login");
        die();
      }
    }
    $current_page="trainingPlan";
    require_once(PATH_VIEWS.'responsible/header.php');

    $notification='';
    $success='';

    if (!empty($_POST['form_import_plan'])) {
      if (!empty($_FILES['csvfile']['tmp_name'])) {

        //if ($_FILES['csvfile']['type']=='application/vnd.ms-excel' ){

          $fcontents = file($_FILES['csvfile']['tmp_name']);

          $training_plan_bool = "f";
          $name = $_POST['name'];
          $training_plan=NULL;
          $end_date = NULL;
          $start_date = NULL;

          foreach ($fcontents as $i => $line) {
            preg_match('/(.*);(.*)/', $line, $result);
            //var_dump($result[2]);
            $date='';
            $datefr = $result[1];
            $contenu = $result[2];

            if (preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/',$datefr,$dateresult)) {
              $date = "$dateresult[3]-$dateresult[2]-$dateresult[1]";
            }

            if($training_plan_bool=="f"){
              $this->_db->insert_training_plan($name,$date);
              $start_date=$date;
              $training_plan = $this->_db->select_training_plan($date);
              $training_plan_bool="t";
            }
            $end_date = $date;
            $this->_db->insert_trainings($contenu,$training_plan->id(),$date);
          }
          $this->_db->update_date_training_plan($start_date,$end_date);
          $success = 'L\'importation du fichier .csv a réussi';
        //} else {
        //  $notification = 'Le fichier uploadé doit être un fichier .csv !';
        //}
      } else {
        $notification = 'Veuillez choisir un fichier .csv';
      }
    }

    require_once(PATH_VIEWS . 'responsible/training_plan.php');
  }

}
?>
