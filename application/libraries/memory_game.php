<?php
class Memory_game{


	public function __construct() {
	}
	
	public function createUserArray($data){
		$userdata['user_id'] = $data[0]->user_id;
		$userdata['user_fb_id'] = $data[0]->user_fb_id;
		$userdata['user_name'] = $data[0]->user_name;
		
		return $userdata;
	}
	public function createAdminArray($data){
		$userdata['admin_id'] = $data[0]->admin_id;
		$userdata['admin_fb_id'] = $data[0]->admin_fb_id;
		$userdata['admin_name'] = $data[0]->admin_name;
		$userdata['buy_status'] = $data[0]->buy_status;		
		$userdata['game_count'] = $data[0]->game_count;
		return $userdata;
	}
	public function getLevelData($image_count){
		if ($image_count>=50){
			$result = array(1 => 'Basics', 2=>'Middle', 3=>'High', 4=>'God');
		}
		else if ($image_count>=32){
			$result = array(1 => 'Basics', 2=>'Middle', 3=>'High');
		}
		else if ($image_count>=18){
			$result = array(1 => 'Basics', 2=>'Middle');
		}
		else if ($image_count>=8){
			$result = array(1 => 'Basics');
		}
		else {
			$result = false;
		}
		return $result;
	}
	public function getEndNumber($level){
		switch ($level) {
			case 1:
				$end_number = 8;
				break;
			case 2:
				$end_number = 18;
				break;
			case 3:
				$end_number = 32;
				break;
			case 4:
				$end_number = 50;
				break;
			default:
				$end_number = 0;
				break;
		}
		return $end_number;
	}
	public function getDbConfig(){
		/*$config['hostname'] = "localhost";
		$config['username'] = "root";
		$config['password'] = "apmsetup";
		$config['database'] = "memory_game";*/

		$config['hostname'] = "localhost";
		$config['username'] = "mobileworks";
		$config['password'] = "mhrinc01";
		$config['database'] = "mobileworks";

		$config['dbdriver'] = "mysql";
		$config['dbprefix'] = "memorygame_";
		$config['pconnect'] = FALSE;
		$config['db_debug'] = TRUE;
		$config['cache_on'] = FALSE;
		$config['cachedir'] = "";
		$config['char_set'] = "utf8";
		$config['dbcollat'] = "utf8_general_ci";
		return $config;
	}
	
}