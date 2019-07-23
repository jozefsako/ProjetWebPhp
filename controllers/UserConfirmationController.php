<?php
class UserConfirmationController{

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
		$current_page="userConfirmation";
		require_once(PATH_VIEWS.'responsible/header.php');

		$notification='';
		$success='';
		$tab_users = $this->_db->select_users_unregistred();


		if (!empty($_POST['form_user'])) {
			if(empty($_POST['user'])){
				$notification = "Selectionnez un membre !";
			}else{
				$user = $_POST['user'];

				foreach ($user as $i){
					$this->_db->confirm_user($tab_users[$i]->id());
				}
				$success = "Vous avez validé ".count($user)." membres ! ";

				$tab_users = $this->_db->select_users_unregistred();
			}

		}
		
		if (!empty($_POST['form_user_delete'])) {
			if(empty($_POST['user'])){
				$notification = "Selectionnez un membre !";
			}else{
				$user = $_POST['user'];

				foreach ($user as $i){
					$this->_db->delete_user($tab_users[$i]->email());
				}
				$success = "Vous avez Supprimé ".count($user)." membres ! ";

				$tab_users = $this->_db->select_users_unregistred();
			}

		}

		require_once(PATH_VIEWS . 'responsible/user_confirmation.php');
	}

}
?>
