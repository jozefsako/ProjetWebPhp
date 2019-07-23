<?php
	ob_start();
	session_start();

	define('PATH_VIEWS','views/');
	define('PATH_HOME_PICTURES','views/pictures/home/');
	define('PATH_USERS_PICTURES','views/pictures/users/');
	define('PATH_CONF','conf/');
	define('PATH_CONTROLLERS','controllers/');
	define('DATE_TODAY',date("j/m/Y"));
	define('DATE_DB',date("Y/m/j"));
	define('SESSION_ID',session_id());

	function loadClass($class) {
		require_once 'models/' . $class . '.class.php';
	}
	spl_autoload_register('loadClass');

	$db=Db::getInstance();

	if (!empty($_SESSION['authenticated'])){
		if($_SESSION['type']=="m"){
			$label = 'Membre';
		}elseif ($_SESSION['type']=="r") {
			$label = 'Responsable';
		}else{
			$label = 'Coach';
		}
	}else{
		$label="S'inscrire";
	}


	require_once(PATH_VIEWS.'header.php');

	$action = (isset($_GET['action'])) ? $_GET['action'] : 'default';

	switch($action) {

		case 'login':
			require_once(PATH_CONTROLLERS . 'LoginController.php');
			$controller = new LoginController($db);
			break;
		case 'responsible':
			require_once(PATH_CONTROLLERS . 'ResponsibleController.php');
			$controller = new ResponsibleController($db);
			break;
		case 'membre':
			require_once(PATH_CONTROLLERS . 'MembreController.php');
			$controller = new MembreController($db);
			break;
		case 'logout':
			require_once(PATH_CONTROLLERS . 'LogoutController.php');
			$controller = new LogoutController();
			break;
		case 'contribution':
			require_once(PATH_CONTROLLERS . 'ContributionController.php');
			$controller = new ContributionController($db);
			break;
		case 'eventsManagement':
			require_once(PATH_CONTROLLERS . 'EventManagementController.php');
			$controller = new EventManagementController($db);
			break;
		case 'userConfirmation':
			require_once(PATH_CONTROLLERS . 'UserConfirmationController.php');
			$controller = new UserConfirmationController($db);
			break;
		case 'userPayement':
			require_once(PATH_CONTROLLERS . 'UserPayementController.php');
			$controller = new UserPayementController($db);
			break;
		case 'userResponsibility':
			require_once(PATH_CONTROLLERS . 'UserResponsibilityController.php');
			$controller = new UserResponsibilityController($db);
			break;
		case 'trainingPlan':
			require_once(PATH_CONTROLLERS . 'TrainingPlanController.php');
			$controller = new TrainingPlanController($db);
			break;
		case 'setting':
			require_once(PATH_CONTROLLERS . 'SettingController.php');
			$controller = new SettingController($db);
			break;
		case 'wysiwyg':
	      require_once(PATH_CONTROLLERS . 'WysiwygController.php');
	      $controller = new WysiwygController();
	      break;
		default:
			require_once(PATH_CONTROLLERS.'HomeController.php');
			$controller = new HomeController($db);
			break;
	}

	$controller->run();

 //require_once(PATH_VIEWS . 'footer.php');
?>
