<?php
class MembreController{

	private $_db;

	public function __construct($db) {
		$this->_db = $db;
	}

	public function run(){

		if (empty($_SESSION['authenticated'])) {
			header("Location: index.php?action=login");
			die();
		}

		$notification = '';
		$user = $this->_db->select_user($_SESSION['login']);
		$confirmed = $user->confirmed();

		if($confirmed==0){
			$notification = "Votre compte n'a pas encore été confirmé par un responsable";
		}
		require_once(PATH_VIEWS.'responsible/header.php');
		require_once(PATH_VIEWS . 'membre.php');

	}


}
?>
