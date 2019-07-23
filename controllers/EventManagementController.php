<?php
class EventManagementController{

	private $_db;
	private $_raw_html;

	public function __construct($db) {
		$this->_db = $db;
		$this->_raw_html = '';
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

		$view = "";
		$tab_events = "";
		$page = (isset($_GET['page'])) ? $_GET['page'] : 'default';
		$event = (isset($_GET['event'])) ? $_GET['event'] : NULL;

		switch ($page) {
			case 'create':
			$view = "events_management.php";
			break;
			case 'coming':
			$view = "coming_events.php";
			$tab_events = $this->_db->select_coming_events();
			break;
			case 'old':
			$view = "old_events.php";
			$tab_events = $this->_db->select_old_events();
			break;
		}

		$success='';
		$errors = array();
		$current_page="eventsManagement";
		$API_KEY_JOZEF="PUT_API_KEY_HERE";

		require_once(PATH_VIEWS.'responsible/header.php');


		if($this->mustProcessForm()){
			$this->processForm();
		}

		if(!empty($_POST['form_add_event'])){
			if(empty(htmlspecialchars($_POST['title']))){
				$errors[] = "Erreur 01 : Le titre de l'évènement est manquant ";
			}
			if(empty(htmlspecialchars($_POST['start_date']))){
				$errors[] = "Erreur 02 : La date de début est manquante ";
			}
			if(empty(htmlspecialchars($_POST['longitude']))){
				$errors[] = "Erreur 03 : La latitude est manquante ";
			}
			if(empty(htmlspecialchars($_POST['latitude']))){
				$errors[] = "Erreur 04 : La longitude est manquante ";
			}
			if($_POST['cost']<0){
				$errors[] = "Erreur 05 : Le montant inséré n'est pas valide ";
			}else if(empty($errors)){
				$this->_db->insert_event(htmlspecialchars($_POST['title']),htmlspecialchars($_POST['start_date']),htmlspecialchars($_POST['end_date']),htmlspecialchars($_POST['html_input']),htmlspecialchars($_POST['latitude']),htmlspecialchars($_POST['longitude']),htmlspecialchars($_POST['url']),htmlspecialchars($_POST['cost']));
				$success='Votre Evenement '.htmlspecialchars($_POST['title']).' a été ajouté !';
			}
		}

		$notification_empty_events = "Il n'y a aucun évènement disponible ";

		/*  hashmap	*/
		if(!empty($tab_events)){
			$tab_events2 = array();
			foreach ($tab_events as $i => $e) {
				$tab_events2[$e->id()] = $e;
			}
			$tab_events = $tab_events2;
		}

		if(empty($selected_event_id) && !empty($tab_events)){
			$selected_event = array_values($tab_events)[0];
			$selected_event_id=$selected_event->id();
		}

		if(!empty($_POST['event_i'])){
			preg_match('/([0-9]*) - (.*)/', $_POST['event_i'], $pos);

			$selected_event = $tab_events[$pos[1]];
			$selected_event_id = $selected_event->id();

			if(empty($tab_events[$pos[1]]) || is_null($tab_events[$pos[1]]) ){

				$selected_event = array_values($tab_events)[0];
				$selected_event_id=$selected_event->id();
				$_SESSION['pos'] = $selected_event_id;

			}
			$_SESSION['pos'] = $pos[1];
		}

		$notification='';
		$success_modify="";
		if(!empty($_POST['modify_event'])){

			$date_start = DateTime::createFromFormat('Y-m-d', htmlspecialchars($_POST['start_date']));
			$date_end = DateTime::createFromFormat('Y-m-d', htmlspecialchars($_POST['end_date']));

			if($date_start > $date_end){
				$errors[] = "Erreur 01 : La Date de départ > Date de fin !";
			}
			if(intval(htmlspecialchars($_POST['cost']))<0){
				$errors[] = "Erreur 02 : Le Cout doit etre > 0 € ";
			}
			if(empty($errors)){

				$this->_db->update_event(
					htmlspecialchars($_POST['id_event']),
					htmlspecialchars($_POST['title']),
					htmlspecialchars($_POST['start_date']),
					htmlspecialchars($_POST['end_date']),
					htmlspecialchars($_POST['html_input']),
					htmlspecialchars($_POST['lat_event']),
					htmlspecialchars($_POST['lng_event']),
					htmlspecialchars($_POST['url']),
					htmlspecialchars($_POST['picture']),
					htmlspecialchars($_POST['cost']));

					$success_modify = "Votre Evènement ".$_POST['title']." a été modifié avec succes !";
					$selected_event_id = $_POST['id_event'];

					if($page == "coming"){
						$tab_events = $this->_db->select_coming_events();
					}
					if($page == "old"){
						$tab_events = $this->_db->select_old_events();
					}
					/*	re-create the hashed map */
					$tab_events2 = array();
					foreach ($tab_events as $i => $e) {
						$tab_events2[$e->id()] = $e;
					}
					$tab_events = $tab_events2;

					/*	if the modified event doesn't exists in the current array() */
					if(empty($tab_events[$_SESSION['pos']]) || is_null($tab_events[$_SESSION['pos']]) ){
						$selected_event = array_values($tab_events)[0];
						$_SESSION['pos'] = $selected_event->id();
					}else{
						$selected_event = $tab_events[$_POST['id_event']];
						$_SESSION['pos'] = $_POST['id_event'];
					}
				}
			}

			$users_from_event = "";
			if(!empty($_POST['list_users'])){
				$users_from_event = $this->_db->select_users_by_event2($_POST['id_event']);
				$selected_event_id = $_POST['id_event'];
				$_SESSION['pos'] = $_POST['id_event'];
				$selected_event = $tab_events[$_POST['id_event']];
			}

			$user_subscripted ='';
			if(!empty($_POST['subscripted'])){
				if(!empty($_POST['id_event'])){
					$selected_event_id = $_POST['id_event'];
					$user_subscripted = $this->_db->select_subscripted_by_event($_POST['id_event']);
					$success = 'Il y a '.count($user_subscripted).' membres inscrits pour : '.htmlspecialchars($_POST['title']);
					$_SESSION['pos'] = $_POST['id_event'];
					$selected_event = $tab_events[$_POST['id_event']];
				}else{
					$notification = "Selectionnez un évènement !";
				}
			}

			$user_interested = '';
			if(!empty($_POST['interested'])){
				if(!empty($_POST['id_event'])){
					$selected_event_id = $_POST['id_event'];
					$user_interested = $this->_db->select_interests_by_event($_POST['id_event']);
					$success = 'Il y a '.count($user_interested).' membres interessés pour : '.htmlspecialchars($_POST['title']);
					$_SESSION['pos'] = $_POST['id_event'];
					$selected_event = $tab_events[$_POST['id_event']];
				}else{
					$notification = "Selectionnez un évènement !";
				}
			}

			$all_users = '';
			if(!empty($_POST['both'])){
				if(!empty($_POST['id_event'])){
					$selected_event_id = $_POST['id_event'];
					$all_users = $this->_db->select_users_by_event($_POST['id_event']);
					$success = 'Il y a '.count($all_users).' membres interessés & inscrits pour : '.htmlspecialchars($_POST['title']);
					$_SESSION['pos'] = $_POST['id_event'];
					$selected_event = $tab_events[$_POST['id_event']];
				}else{
					$notification = "Selectionnez un évènement !";
				}
			}

			if(!empty($_SESSION['pos']) && $page!="create"){
				if(empty($tab_events[$_SESSION['pos']]) || is_null($tab_events[$_SESSION['pos']]) ){
					$selected_event = array_values($tab_events)[0];
				}
			}

			require_once(PATH_VIEWS . 'responsible/'. $view);
		}

		private function mustProcessForm(){
			return isset($_POST['result_wysiwyg']);
		}

		private function processForm(){
			$this->_raw_html = $_POST['html_input'];
		}

		private function renderView(){
			include(PATH_VIEWS . 'responsible/'.$view);
		}

		// view private methods
		private function getRawHtml(){
			return $this->_raw_html;
		}

		private function getEscapedHtml(){
			return htmlentities($this->_raw_html);
		}
	}
	?>
