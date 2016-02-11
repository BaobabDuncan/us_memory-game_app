<?php
class Index extends CI_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->library('fb_ignited');
		$this->load->library('memory_game');
		$this->load->library('Cache');
		$this->load->helper('url');
		$this->load->model('user_model');
		$this->load->model('page_model');

		$this->fb_me = $this->fb_ignited->fb_get_me('user');
		$this->user_data =  $this->memory_game->createUserArray($user_data = $this->user_model->existence_user_by_fb_id($this->fb_me['id']));
	}

	function index()
	{
		$signed_data = $this->cache->get('signed_data'.$this->user_data['user_fb_id']);
		$page_data = $this->page_model->existence_page_by_id($signed_data['page']['id']);
		if (!$page_data && $signed_data['page']['admin']){
			$this->initialPage($signed_data['page']['id']);
		}
		
		else if(!$signed_data['page']['admin'] && !$page_data){			
			$this->readyPage();
		}
		else{
			$this->mainPage($signed_data['page']['id']);
		}
		
	}
	function initialPage($page_id)
	{
		$data['page_id'] = $page_id;
		$this->load->view('admin/initial_view',$data);
	}
	function readyPage()
	{
		$this->load->view('user/ready_view');
	}
	function mainPage()
	{		
		redirect('/user/main/', 'refresh');		
	}

}