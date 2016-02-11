<?php
class Game_model extends CI_Model{

	private $_game_db = 'game';

	function __construct()
	{
		parent::__construct();
		$this->load->library('memory_game');
		$dbConfig = $this->memory_game->getDbConfig();			
		$this->load->database($dbConfig);
	}
	 
	function insert_game($data)
	{
		return $this->db->insert($this->_game_db, $data);
	}
	function get_games()
	{
		$query = $this->db->get($this->_game_db);
		return $query->result();
	}
	function existence_game_by_id($game_id)
	{
		$query = $this->db->get_where($this->_game_db, array('game_id' => $game_id));
		return $query->result();
	}
	function delete_game_by_id($game_id)
	{
		return $this->db->delete($this->_game_db, array('game_id' => $game_id));
	}
	function update_game($data,$game_id)
	{
		$this->db->where('game_id', $game_id);
		return $this->db->update($this->_game_db, $data);
	}
	function existence_game_by_page_id($page_id)
	{
		$query = $this->db->get_where($this->_game_db, array('page_id' => $page_id));
		return $query->result();
	}
	function get_games_by_fb_user_id($admin_id)
	{
		$query = $this->db->get_where($this->_game_db, array('admin_id' => $admin_id));
		return $query->result();
	}	

}