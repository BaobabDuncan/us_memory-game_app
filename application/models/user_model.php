<?php
class User_model extends CI_Model{
	
	private $_user_db = 'user';
	
	function __construct()
	{
		parent::__construct();	
		$this->load->library('memory_game');	
		$dbConfig = $this->memory_game->getDbConfig();	
		$this->load->database($dbConfig);
	} 	
	function existence_user_by_fb_id($fb_id)
	{
		$query = $this->db->get_where($this->_user_db, array('user_fb_id' => $fb_id));
    	return $query->result();
	}   
	function insert_user($data)
    {    	
    	$this->db->insert($this->_user_db, $data);     	    	
    }
    
}