<?php
class ContributionController{

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
		$current_page="contribution";
		require_once(PATH_VIEWS.'responsible/header.php');

		$errors=array();
		$success='';
		$date_contribution=$_SESSION['year'];
		$tab_user_contributions = $this->_db->select_all_contributions_not_paid($date_contribution);
		$SMTP_username = '200a10abd870706acc405671924f4b13';
		$SMTP_password = '63b2616547e170a5c56645c1def45930';


		if (!empty($_POST['form_contribution'])) {

			if (empty($_POST['year'])) {
				$errors[]='Entrez une période non vide !';
			}
			if (empty($_POST['cost'])) {
				$errors[]='Entrez un montant non vide !';
			}else {
				$cost = $_POST['cost'];
				if($cost<0){
					$errors[]='Entrez un montant positif';
				}
				if ($this->_db->contribution_exists(htmlspecialchars($_POST['year']))) {
					$errors[]='Il y a déjà une contribution pour cette période !';
				}else if(empty($errors)){

					if($this->_db->insert_contribution(htmlspecialchars($_POST['year']),htmlspecialchars($_POST['cost']))){
						$success='Votre nouvelle cotisations a été ajouté avec succes !';
					}

					# Read the bank account info from Config/properties;
					$bank_account="";

					$myfile = fopen(PATH_CONF."/config.properties", "r") or die("Unable to open file!");
					// Output one character until end-of-file

					while(!feof($myfile)) {
						$line = fgets($myfile);

						if(substr($line,0,6)=="compte"){
							$bank_account = substr($line,8,-2);
						}
					}
					fclose($myfile);

					if(!empty($bank_account)){
						# Info : le montant et le numéro de compte pour le versement.
						$message = "Debut d'une nouvelle annee de cotisation : ".htmlspecialchars($_POST['year'])
						."\r\n"."Montant a payer : ".htmlspecialchars($_POST['cost'])." EURO "
						."\r\n"."Compte Banque : ".htmlspecialchars($bank_account)."\xA";

						# Envoi d'un email sur base des informations du formulaire transmises par la méthode POST
						$notification='';

						require_once(PATH_CONTROLLERS.'PHPMailer/PHPMailer.php');
						require_once(PATH_CONTROLLERS.'PHPMailer/SMTP.php');

						$mail = new PHPMailer(true);                       // true active les exceptions
						try {
							//Server settings
							$mail->SMTPDebug = 0;                          // Disable verbose debug output (=2 pour activer)
							$mail->isSMTP();                               // Set mailer to use SMTP
							$mail->Host = 'in-v3.mailjet.com';         	   // Specify main SMTP server
							$mail->SMTPAuth = true;                        // Enable SMTP authentication
							$mail->Username = $SMTP_username;         	   // SMTP username
							$mail->Password = $SMTP_password;          		 // SMTP password
							$mail->SMTPSecure = 'tls';                     // Enable TLS encryption, 'ssl' also accepted
							$mail->Port = 587;                             // TCP port to connect to

							//Recipients
							$mail->setFrom('jozef.sako@student.vinci.be', 'Mailjet Mailer');
							//$mail->addAddress('jozef.sako@gmail.com', 'Jozef Sako');				// Add a recipient
							//$mail->addReplyTo(htmlspecialchars($_POST['email']), 'Mailer');

							//$mail->addCC('cc@example.com');
							$list_mails = array();
							$list_mails[] = "jozef.sako@gmail.com";
							$list_mails[] = "jozef.sako@student.vinci.be";

							for( $i=0; $i<count($list_mails); $i++){
								$mail->addBCC($list_mails[$i]);
							}

							/*	SENDING MAILS TO USERS FROM DB;

							$list_usersMail = $this->_db->select_confirmed_user();

							foreach ($list_usersMail as $i => $user) {
								$mail->addBCC($user->email());
							}

							*/

							//Attachments
							//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
							//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

							//Content
							$mail->isHTML(true);                                  // Set email format to HTML
							$mail->Subject = 'Mail du site Gestion de Coureurs';
							$mail->Body    = htmlspecialchars($message);
							//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

							$mail->send();
							$notification='Vos informations ont été transmises avec succès.';
						} catch (Exception $e) {
							$notification='Vos informations n\'ont pas été transmises. '.'Mailer Error: '.$mail->ErrorInfo;
						}
					}

				}
			}
		}

		$notification_date='';
		if(!empty($_POST['date_contribution'])){
			$date_contribution=htmlspecialchars($_POST['date_contribution']);
			$_SESSION['year']=$date_contribution;
			if($this->_db->contribution_exists($date_contribution)){

			}else{
				$notification_date = "Il n'a pas de contribution pour l'année : ".$date_contribution;
			}
		}

		$notification_contribution='';
		$success_contribution='';

		if(!empty($_POST['form_user_contribution'])) {
			if(!empty($_POST['user'])){
				$user = $_POST['user'];
				$counter = 0;
				foreach ($user as $i){
					if(!empty($_POST[$i.'amount_payement'])){
						$counter+=1;
						$this->_db->insert_user_contribution($tab_user_contributions[$i][0],$tab_user_contributions[$i][2],htmlspecialchars($_POST[$i.'amount_payement']),DATE_DB);
					}
				}
				$success_contribution = "Vous avez validé ".$counter." cotisations";
			}else{
				$notification_contribution='Erreur 01 : Aucun membre selectionné !';
			}
		}

		if(!empty($_POST['list_user'])){
			$users = $this->_db->select_all_contributions_not_paid($date_contribution);
		}

		$tab_user_contributions = $this->_db->select_all_contributions_not_paid($date_contribution);
		require_once(PATH_VIEWS . 'responsible/contribution.php');
	}

}
?>
