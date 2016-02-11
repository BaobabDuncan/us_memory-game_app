<?php
class Game extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('game_model');
		$this->load->model('page_model');
		$this->load->model('admin_model');	
		$this->load->model('image_model');	
		$this->load->model('ranking_model');			
		$this->load->library('fb_ignited');		
		$this->load->library('memory_game');	
		
		$this->fb_me = $this->fb_ignited->fb_get_me('admin');	
		$this->admin_data = $this->memory_game->createAdminArray($this->admin_model->existence_user_by_fb_id($this->fb_me['id']));
			
	}
	public function initial()
	{				
		if($this->input->post('page_id'))
		{				
			$data = array(
			   'page_id' => $this->input->post('page_id'),
			   'admin_id' => $this->fb_me['id'],
			   'page_status' => false
			);	
			
			$page_data = $this->fb_ignited->get_pages();		
			
			foreach ($page_data['data'] as $row){				
				if ($this->input->post('page_id')==$row['id']){
					$data['page_title'] = $row['name'];
					break;
				}				
			}
			$this->page_model->insert_page($data);
			
		}
		redirect('/user/index', 'refresh');	
	}
	public function index()
	{		
		$games = $this->game_model->get_games();
		$data['games'] = $games;
		$this->load->view('admin/game_view',$data);
	}

	public function created()
	{
		if($this->input->post('title'))
		{						
			$title = $this->input->post('title');
			$detail = $this->input->post('detail');
			$level = $this->input->post('level');
			$page_id = $this->input->post('page_id');
			$feed_message = $this->input->post('feed_message');
			
			
			
			$data = array(
			   'admin_id' => $this->admin_data['admin_fb_id'],
			   'page_id' => $page_id,
			   'title' => $title ,
			   'detail' => $detail ,
			   'level' => $level,
			   'feed_message' => $feed_message,
			   'join_count' => 0,
			   'active' => false		
			);
			
			//echo $page_id;
			if ($page_id){
				$page_data = array(
					'page_id' => $page_id,
					'page_status' => true
				);
				$this->page_model->update_page($page_data);		
				$data['active'] = true;	
				
				$page = $this->fb_ignited->getPageInfo($page_id);
				$this->fb_ignited->sendCreateGameFeed($page);
			}

			$this->game_model->insert_game($data);
			
			$this->admin_data['game_count']++;		
			$this->admin_model->update_admin($this->admin_data);
			
			redirect('/admin/game', 'refresh');			
		}
		$image_count = $this->image_model->get_images_count($this->admin_data['admin_fb_id']);
		$level_data = $this->memory_game->getLevelData($image_count);
		
		$data['level_data'] = $level_data;
		$data['page_data'] = $this->page_model->get_pages_by_admin_id($this->admin_data['admin_fb_id']);
		
		$this->load->view('admin/game_created_view',$data);
	}
	
	public function edit()
	{
		if($this->input->get('game_id'))
		{
			$games = $this->game_model->existence_game_by_id($this->input->get('game_id'));					
			$data['games'] = $games;					
		}
		if($this->input->post('game_id'))
		{
			$games = $this->game_model->existence_game_by_id($this->input->post('game_id'));			
			$title = $this->input->post('title');
			$detail = $this->input->post('detail');			
			$page_id = $this->input->post('page_id');
			$feed_message = $this->input->post('feed_message');
			
			
			
			$data = array(
               'title' => $title,
               'detail' => $detail,
			   'feed_message' => $feed_message,
               'level' => $games[0]->level,
			   'page_id' => $page_id
            );
			if ($page_id){
				$page_data = array(
					'page_id' => $page_id,
					'page_status' => true
				);
				$this->page_model->update_page($page_data);			
				$data['active'] = true;			
								
				$page = $this->fb_ignited->getPageInfo($page_id);
				$this->fb_ignited->sendCreateGameFeed($page);
			}
            $this->game_model->update_game($data,$this->input->post('game_id'));
           	
            
			
			redirect('/admin/game', 'refresh');			
		}
		$data['page_data'] = $this->page_model->get_pages_by_admin_id($this->admin_data['admin_fb_id']);
		$this->load->view('admin/game_edit_view',$data);
	}
	
	public function delete()
	{
		if($this->input->get('game_id'))
		{
			$games = $this->game_model->existence_game_by_id($this->input->get('game_id'));			
			$this->game_model->delete_game_by_id($this->input->get('game_id'));
			//var_dump($games);
			$page_data = $this->page_model->existence_page_by_id($games[0]->page_id);
			$this->page_model->delete_page_by_id($games[0]->page_id);
			//var_dump($page_data);
			$rankings = $this->ranking_model->get_order_rankings($this->input->get('game_id'));
			$this->ranking_model->delete_ranking_by_game_id($this->input->get('game_id'));
			//var_dump($rankings);
			$this->admin_data['game_count']--;		
			$this->admin_model->update_admin($this->admin_data);			
			redirect('/admin/game', 'refresh');	
		}
		$this->index();
		//redirect('/admin/game', 'refresh');
	}
}