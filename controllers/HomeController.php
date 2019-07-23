<?php
class HomeController{

	private $_db;

	public function __construct($db) {
		$this->_db = $db;
	}

	public function run(){

		$responsible = $this->_db->select_user("jozef.sako@student.vinci.be");

		$XXX='';
		$YYY='';
		$VVV='';

		$pictures = array();
		$random_picture = "";

		$myfile = fopen(PATH_CONF."/config.properties", "r") or die("Unable to open file!");
		// Output one character until end-of-file
		while(!feof($myfile)) {
			$line = fgets($myfile);

			if(substr($line,0,3)=="XXX"){
				$XXX = substr($line,5,-2);
			}elseif (substr($line,0,3)=="YYY") {
				$YYY = substr($line,5,-2);
			}elseif (substr($line,0,3)=="VVV") {
				$VVV = substr($line,5,-2);
			}elseif (substr($line,0,12)=="HOME_PICTURE"){
				$pictures[] = substr($line,14,-2);
			}
		}
		fclose($myfile);


		$random_picture = PATH_HOME_PICTURES.$pictures[rand(0,count($pictures)-1)];

		require_once(PATH_VIEWS . 'home.php');
	}

}
?>
