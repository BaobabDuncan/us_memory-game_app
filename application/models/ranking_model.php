<?php
class Ranking_model extends CI_Model{
	
	private $_ranking_db = 'ranking';
	
	function __construct()
	{
		parent::__construct();	
		$this->load->library('memory_game');	
		$dbConfig = $this->memory_game->getDbConfig();	
		$this->load->database($dbConfig);
	} 	
    	
    function insert_ranking($data)
    {    	
    	$this->db->set('update_at', 'NOW()', FALSE);
    	return $this->db->insert($this->_ranking_db, $data);     	    	
    }    
	function update_ranking($data)
    {    	
    	//$this->db->set('update_at', 'NOW()', FALSE);
    	//var_dump($data);
    	//echo $data->game_id;
    	$this->db->where('game_id', $data->game_id);
    	$this->db->where('user_fb_id', $data->user_fb_id);
		$this->db->update($this->_ranking_db, $data); 	    	
    }
    function existence_by_user_id_and_game_id($user_id,$game_id)
    { 
    	$query = $this->db->get_where($this->_ranking_db, array('user_fb_id' => $user_id,'game_id' => $game_id));
    	return $query->result(); 
    }
    function get_order_rankings($game_id)
    {    	
    	$this->db->where('game_id', $game_id); 
    	$this->db->order_by("game_score", "asc"); 	
    	$query = $this->db->get($this->_ranking_db,100);  
    	return $query->result();    	
    }    
	function delete_ranking_by_game_id($game_id)
	{
		return $this->db->delete($this->_ranking_db, array('game_id' => $game_id));
	}	
}