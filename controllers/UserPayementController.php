<?php
class UserPayementController{

	private $_db;

	public function __construct($db) {
		$this->_db = $db;
	}

	public function run(){

		if (empty($_SESSION['authenticated'])) {
			header("Location: index.php?action=login");
			die();
		}else{
			if(!empty($_SESSION['authenticated']) && $_SESSION['type']=='m') {
				header("Location: index.php?action=membre");
				die();
			}
		}
		$current_page="userPayement";
		require_once(PATH_VIEWS.'responsible/header.php');

		$notification='';
		$success='';
		$tab_registrations = $this->_db->select_registrations_not_paid();


		if (!empty($_POST['form_registration'])) {
			if(empty($_POST['user'])){
				$notification = "Selectionnez un membre !";
			}else{
				$user = $_POST['user'];

				foreach ($user as $i){
					$this->_db->update_registration($tab_registrations[$i][2]);
				}
				$success = "Vous avez validé ".count($user)." membres ! ";

				$tab_registrations = $this->_db->select_registrations_not_paid();
			}

		}

		require_once(PATH_VIEWS . 'responsible/user_payement.php');
	}

}
?>
