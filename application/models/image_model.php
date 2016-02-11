<?php
class Image_model extends CI_Model{
	
	private $_image_db = 'image';
	
	function __construct()
	{
		parent::__construct();		
		$this->load->library('memory_game');
		$dbConfig = $this->memory_game->getDbConfig();	
		$this->load->database($dbConfig);
	} 	
	function insert_image($data)
    {    	
    	try{
    		return $this->db->insert($this->_image_db, $data);
    	}
    	catch (Exception $e){
    		return false;
    	}     	    	
    }
    function existence_image_by_id($image_fb_id)
	{
		$query = $this->db->get_where($this->_image_db, array('image_fb_id' => $image_fb_id));
    	return $query->result();
	} 
	function get_game_by_fb_id($admin_fb_id)
	{
		$query = $this->db->get_where($this->_image_db, array('admin_fb_id' => $admin_fb_id));
    	return $query->result();
	}
	function get_images_count($admin_fb_id)
	{		
		$query = $this->db->get_where($this->_image_db, array('admin_fb_id' => $admin_fb_id));
    	return $query->num_rows();
	}
    
}