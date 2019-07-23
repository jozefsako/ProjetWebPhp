<?php
class SettingController{

	private $_db;

	public function __construct($db) {
		$this->_db = $db;
	}

	public function run(){
		if (empty($_SESSION['authenticated'])) {
			header("Location: index.php?action=login");
			die();
		}
		$current_page="setting";
		require_once(PATH_VIEWS.'responsible/header.php');
		
		$notification='';
		$success='';
		$user = $this->_db->select_user($_SESSION['login']);

		$errors=array();
		$success_password='';

		if (!empty($_POST['form_password'])){
			if(empty(htmlspecialchars($_POST['current_password']))){
				$errors[] = "Erreur 01 : Ancien Mot de Passe manquant !";
			}
			if(empty(htmlspecialchars($_POST['new_password']))){
				$errors[] = "Erreur 02 : Nouveau Mot de Passe manquant !";
			}
			if(empty(htmlspecialchars($_POST['confirmation']))){
				$errors[] = "Erreur 03 : Confirmation Mot de Passe manquante !";
			}else if(htmlspecialchars($_POST['new_password'])!=htmlspecialchars($_POST['confirmation'])){
				$errors[] = "Erreur 04 : Les Mots de Passes ne correspondent pas !";
			}
			else{
				if($this->_db->validate_user($_SESSION['login'],htmlspecialchars($_POST['current_password']))){
					$this->_db->update_user_password($user->id(),password_hash(htmlspecialchars($_POST['new_password']),PASSWORD_BCRYPT));
					$user = $this->_db->select_user($_SESSION['login']);
					$success_password = "Votre mot de Passe a été modifié !";
				}else{
					$errors[] = "Erreur 05 : Mot de Passe courrant n'est pas correcte ";
				}
			}
		}

		$success_setting='';

		if (!empty($_POST['form_setting'])) {
			$_SESSION['login']=htmlspecialchars($_POST['email']);
			$this->_db->update_user_info($user->id(),htmlspecialchars($_POST['lastname']),htmlspecialchars($_POST['firstname']),htmlspecialchars($_POST['phone']),htmlspecialchars($_POST['email']),htmlspecialchars($_POST['address']),htmlspecialchars($_POST['bank']));
			$success_setting = "Vos Informations ont bien été mis à jour !";
			$user = $this->_db->select_user($_SESSION['login']);
		}

		if (!empty($_POST['form_user_picture'])) {

			if (!empty($_FILES['profile_picture']['tmp_name'])) {

				$imageinfo = getimagesize($_FILES['profile_picture']['tmp_name']);

				if (($_FILES['profile_picture']['type']=='image/jpeg')  || ($_FILES['profile_picture']['type']=='image/png' )) {

					$old_picture = $user->picture();
					$horodatage=str_replace('.', '_',microtime(true));
					$origine = $_FILES['profile_picture']['tmp_name'];
					$destination = PATH_USERS_PICTURES . $horodatage . basename($_FILES['profile_picture']['name']);
					move_uploaded_file($origine,$destination);

					$this->_db->update_profile_picture($_SESSION['login'],$destination);
					$_SESSION['picture'] = $destination;

					if(!empty($old_picture) && file_exists($old_picture)){
						unlink($old_picture);
					}

					$success = 'Une nouvelle photo a été ajouté';

				} else {
					$notification = 'Le fichier uploadé doit être une image .jpg ou .png !';
				}
			}
		}

		require_once(PATH_VIEWS . 'setting.php');
	}
}
?>
