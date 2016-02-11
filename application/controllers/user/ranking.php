<?php
class Ranking extends CI_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->library('fb_ignited');
		$this->load->library('memory_game');
		$this->load->library('Cache');
		$this->load->model('user_model');
		$this->load->model('game_model');
		$this->load->model('ranking_model');
		$this->load->helper('url');
		
		$this->fb_me = $this->fb_ignited->fb_get_me('user');
		$this->user_data =  $this->memory_game->createUserArray($this->user_model->existence_user_by_fb_id($this->fb_me['id']));
	}

	function index()
	{
		$signed_data = $this->cache->get('signed_data'.$this->user_data['user_fb_id']);
		$games = $this->game_model->existence_game_by_page_id($signed_data['page']['id']);				
		$rankings = $this->ranking_model->get_order_rankings($games[0]->game_id);
		$data['rankings'] = $rankings;
		$this->load->view('user/ranking_view',$data);
	}
	function end()
	{
		$signed_data = $this->cache->get('signed_data'.$this->user_data['user_fb_id']);
		$games = $this->game_model->existence_game_by_page_id($signed_data['page']['id']);			
		
		
		if($this->input->post('count'))
		{
			$ranking_data = $this->ranking_model->existence_by_user_id_and_game_id($this->user_data['user_fb_id'],$this->input->post('game_id'));
			
			if(!$ranking_data){
				$data = array(
					'game_id' => $this->input->post('game_id') ,
					'user_fb_id' => $this->user_data['user_fb_id'] ,
					'user_name' => $this->user_data['user_name'] ,
					'game_time' => $this->input->post('game_time'),
					'click_count' => $this->input->post('count'),
					'game_score' => $this->input->post('game_real_time') * $this->input->post('count')
				);			 	
				$this->ranking_model->insert_ranking($data);
				$ranking_data = $this->ranking_model->existence_by_user_id_and_game_id($this->user_data['user_fb_id'],$this->input->post('game_id'));
				$ranking_data[0]->save_status = true;
			}
			else{					
				$new_game_score = $this->input->post('game_real_time') * $this->input->post('count');
				if ($new_game_score<$ranking_data[0]->game_score){
					$ranking_data[0]->ranking_id = $ranking_data[0]->ranking_id;
					$ranking_data[0]->update_at = date("Y-m-d H:i:s");
					$ranking_data[0]->game_time = $this->input->post('game_time');
					$ranking_data[0]->click_count = $this->input->post('count');
					$ranking_data[0]->game_score = $new_game_score;					
					$this->ranking_model->update_ranking($ranking_data[0]);				
					$ranking_data[0]->save_status = true;					
				}
				else{
					//$data['new_ranking_data'] = $ranking_data[0];	
					$ranking_data[0]->save_status = false;
				}				
			}
			$data['ranking_data'] = $ranking_data[0];				
			$page = $this->fb_ignited->getPageInfo($signed_data['page']['id']);
			$this->fb_ignited->sendResultFeed($ranking_data[0],$page,$games[0]->feed_message);		
		
		}
		
		//$this->index();
		$this->load->view('user/end_view',$data);
	}
}
