<?php
class Loading extends CI_Controller{

	public function __construct()
	{
		parent::__construct();		
		
		$this->load->library('fb_ignited');		
		$this->load->library('Cache');
		$this->load->library('memory_game');
		$this->load->helper('url');
		
		$this->load->model('user_model');
		$this->load->model('page_model');
		
		$signed_data = $this->fb_ignited->parse_signed_request($_REQUEST['signed_request']);		
		$page = $this->fb_ignited->getPageInfo($signed_data['page']['id']);
		
		//echo $page['link'];
		$this->fb_me = $this->fb_ignited->fb_get_me('user');	
					
	}

	public function index()
	{	
		$user_data = $this->user_model->existence_user_by_fb_id($this->fb_me['id']);
		if (!$user_data){
			$data['user_fb_id'] = $this->fb_me['id'];
			$data['user_name'] = $this->fb_me['name'];
			$this->user_model->insert_user($data);
			$user_data = $this->user_model->existence_user_by_fb_id($this->fb_me['id']);
		}
		
		$this->user_data =  $this->memory_game->createUserArray($user_data);
		$signed_data = $this->fb_ignited->parse_signed_request($_REQUEST['signed_request']);
		
		$this->cache->write($signed_data, 'signed_data'.$this->user_data['user_fb_id']);
				
		$this->load->view('user/loading');
	}
	
	
}