<?php
class Page_model extends CI_Model{

	private $_page_db = 'page';

	function __construct()
	{
		parent::__construct();
		$this->load->library('memory_game');
		$dbConfig = $this->memory_game->getDbConfig();	
		$this->load->database($dbConfig);
	}
	function existence_page_by_id($page_id)
	{
		$query = $this->db->get_where($this->_page_db, array('page_id' => $page_id));
		return $query->result();
	}
	function insert_page($data)
	{
		return $this->db->insert($this->_page_db, $data);
	}
	function get_pages_by_admin_id($admin_id)
	{
		//$this->db->where('page_status', true); 
		$this->db->where('page_status', false); 
		$query = $this->db->get_where($this->_page_db, array('admin_id' => $admin_id));
		return $query->result();
	}
	function update_page($data)
    {    	
    	$this->db->where('page_id', $data['page_id']);
		$this->db->update($this->_page_db, $data); 
    }
	function delete_page_by_id($page_id)
	{
		return $this->db->delete($this->_page_db, array('page_id' => $page_id));
	}

}