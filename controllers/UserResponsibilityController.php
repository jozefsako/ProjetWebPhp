<?php
class UserResponsibilityController{

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

		$current_page="userResponsibility";
		require_once(PATH_VIEWS.'responsible/header.php');

		$success="";
		$errors=array();


		$tab_users=$this->_db->select_confirmed_user();

		if (!empty($_POST['form_responsibility'])) {
			if(empty($_POST['user'])){
				$notification = "Erreur 01 : Aucun membre disponible !";
			}else{

				$user = $_POST['user'];
				$counter = 0;

				foreach ($user as $i){
					if($_POST[$i.'type']!="m"){
						$counter += 1;
					}
				}
				if($counter==0){
					$notification = "Erreur 02 : Il faut au moins un membre responsable !";
				}else{
					foreach ($user as $i){
						$this->_db->update_user_responsibility($tab_users[$i]->id(),$_POST[$i.'type'],htmlspecialchars($_POST[$i.'role']));
					}
					$current_user = $this->_db->select_user($_SESSION['login']);
					$_SESSION['type'] = $current_user->type();
					$success = "Vous avez modifié ".count($user)." membres ! ";
				}
			}
			$tab_users=$this->_db->select_confirmed_user();
		}
		require_once(PATH_VIEWS . 'responsible/user_responsibility.php');
	}

}
?>
