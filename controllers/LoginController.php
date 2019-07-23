<?php
class LoginController{

	private $_db;

	public function __construct($db) {
		$this->_db = $db;
	}

	public function run(){

		$view = "login.php";
		$page = (isset($_GET['page'])) ? $_GET['page'] : 'default';

		switch ($page) {
			case 'login':
				$view = "login.php";
				break;
			case 'signin':
				$view = "signin.php";
				break;
		}

		# Si un distrait écrit ?action=login en étant déjà authentifié
		if (!empty($_SESSION['authenticated'])) {
			if($_SESSION['type']=="r"){
				header("Location: index.php?action=userConfirmation");
				die();
			}elseif ($_SESSION['type']=="c") {
				header("Location: index.php?action=userConfirmation");
				die();
			}else{
				header("Location: index.php?action=membre");
				die();
			}
		}

		# Variables HTML dans la vue
		$errors = array();

		if(!empty($_POST['form_login'])){

			if(empty(htmlspecialchars($_POST['email']))){
				$errors[] = "Erreur 01 : Email manquant ";
			}
			if (empty(htmlspecialchars($_POST['password']))) {
				$errors[] = "Erreur 02 : Mot de passe manquant";
			}
		 	else if(!$this->_db->validate_user(htmlspecialchars($_POST['email']),htmlspecialchars($_POST['password']))) {
				$errors[] ="Vos données d'authentification ne sont pas correctes.";
			}
			else{

				$user = $this->_db->select_user(htmlspecialchars($_POST['email']));
				if($user->confirmed()=='0'){
					$errors[] = "En attente de confirmation par un responsable !";
				}else{
					$_SESSION['authenticated'] = 'authorized';
					$_SESSION['login'] = htmlspecialchars($_POST['email']);
					$_SESSION['type'] = $user->type();
					$_SESSION['picture'] = $user->picture();
					$_SESSION['pos']='';
					$_SESSION['year']=date('Y');

					$firstname = $user->firstname();
					$lastname =  $user->lastname();

					$_SESSION['label'] = substr($firstname,0,1) .'.'. strtolower(substr($lastname,0,1));

					switch ($user->type()) {
						case "r":
							header("Location: index.php?action=userConfirmation");
							die();
							break;
						case "c":
							header("Location: index.php?action=userConfirmation");
							die();
							break;
						case "m":
							header("Location: index.php?action=membre");
							die();
							break;
						default:
							header("Location: index.php?action=login");
							die();
							break;
					}
				}
			}

		}elseif(!empty($_POST['form_signin'])){

			$errors = array();
			$success ="";

			if(empty(htmlspecialchars($_POST['name']))){
				$errors[] = "Erreur 01 : nom manquant";
			}
			if(empty(htmlspecialchars($_POST['email']))){
				$errors[] = "Erreur 02 : email manquant";
			}
			if (empty(htmlspecialchars($_POST['password']))) {
				$errors[] = "Erreur 03 : mot de passe manquant";
			}
			if (empty(htmlspecialchars($_POST['confirm']))) {
				$errors[] = "Erreur 04 : confirmation du mot de passe manquant";
			}
			if ($_POST['confirm'] != htmlspecialchars($_POST['password'])) {
				$errors[] = "Erreur 05 : le mot de passe et la confirmation ne sont pas identiques";
			}else if($this->_db->email_exists(htmlspecialchars($_POST['email']))) {
				$errors[] = "Erreur 06 : email déjà utilisée ";
			} else if(empty($errors)){
				$this->_db->insert_user(htmlspecialchars($_POST['name']),htmlspecialchars($_POST['email']),password_hash(htmlspecialchars($_POST['password']),PASSWORD_BCRYPT));
				$success = "Votre inscription a été prise en compte !";
			}
			$view = "signin.php";
		}

		require_once(PATH_VIEWS . $view);
	}

}
?>
