<?php
class Main extends CI_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('user_model');		
		$this->load->model('game_model');		

		$this->load->library('fb_ignited');
		$this->load->library('memory_game');
		$this->load->library('Cache');
			
		$this->fb_me = $this->fb_ignited->fb_get_me('user');
		$this->user_data =  $this->memory_game->createUserArray($this->user_model->existence_user_by_fb_id($this->fb_me['id']));
	}

	function index()
	{
		$signed_data = $this->cache->get('signed_data'.$this->user_data['user_fb_id']);		
		
		$games = $this->game_model->existence_game_by_page_id($signed_data['page']['id']);	
		
		if(!$games){			
			$this->load->view('user/ready_view');
		}
		else{
			$data['game_data'] = $games[0];	
			$this->load->view('user/main_view',$data);
		}
		
		
	}


}