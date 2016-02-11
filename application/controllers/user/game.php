<?php
class Game extends CI_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('user_model');		
		$this->load->model('game_model');	
		$this->load->model('image_model');	
		
		$this->load->library('fb_ignited');
		$this->load->library('memory_game');
		$this->load->library('Cache');
				
		$this->fb_me = $this->fb_ignited->fb_get_me('user');
		$this->user_data =  $this->memory_game->createUserArray($this->user_model->existence_user_by_fb_id($this->fb_me['id']));
	}

	function index()
	{		
		//$signed_data = $this->fb_ignited->parse_signed_request($_REQUEST['signed_request']);		
		$signed_data = $this->cache->get('signed_data'.$this->user_data['user_fb_id']);
		
		$games = $this->game_model->existence_game_by_page_id($signed_data['page']['id']);		
		
		
		$games[0]->join_count++;				
		$this->game_model->update_game($games[0],$games[0]->game_id);			
		
		$images = $this->image_model->get_game_by_fb_id($games[0]->admin_id);		
		
		//var_dump($images);
		//$end_number = $games[0]->level * 5;
		$end_number = $this->memory_game->getEndNumber($games[0]->level);
		//$end_number = 47;
		shuffle($images);
		$images = array_slice($images, 0, $end_number);	
		
		$data['found_count'] = $end_number;
		$data['game_id'] = $games[0]->game_id;
		$data['user_data'] = $this->user_data;
		$data['images_data'] = $images;
		$this->load->view('user/game_view',$data);
	}
	
	function end()
	{				
		if($this->input->get('count'))
		{			
			
			/*$this->load->model('ranking_model');
			$click_count = $this->input->get('count');			
			$game_time = $this->input->get('game_time');
			$game_real_time = $this->input->get('game_real_time');			
			
			$game_score = $game_real_time * $click_count;
			echo $game_real_time;
			echo $click_count;
			echo $game_score;
			$data = array(
			   'game_id' => $this->input->get('game_id') ,
			   'user_fb_id' => $this->user_data['user_fb_id'] ,
			   'user_name' => $this->user_data['user_name'] ,
			   'game_time' => $game_time,
			   'click_count' => $click_count,
			   'game_score' => $game_score
			);
			
			$this->ranking_model->insert_ranking($data);*/
		}
		echo 'Good';
		//$this->index();
		//$this->load->view('user/game');		
	}
}
