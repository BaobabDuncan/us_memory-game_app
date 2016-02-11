<?php
class Admin_model extends CI_Model{
	
	private $_admin_db = 'admin';
	
	function __construct()
	{
		parent::__construct();		
		$this->load->library('memory_game');
		$dbConfig = $this->memory_game->getDbConfig();	
		$this->load->database($dbConfig);
	} 	
	function insert_user($data)
    {    	
    	$this->db->insert($this->_admin_db, $data);     	    	
    }
	function existence_user_by_fb_id($fb_id)
	{
		$query = $this->db->get_where($this->_admin_db, array('admin_fb_id' => $fb_id));
    	return $query->result();
	}   
	function update_admin($data)
    {    	
    	$this->db->where('admin_id', $data['admin_id']);
		$this->db->update($this->_admin_db, $data); 
    }	
	
	
	function existence_user_by_page_id($page_id)
	{
		$query = $this->db->get_where($this->_admin_db, array('page_id' => $page_id));
    	return $query->result();
	}
	
    
}