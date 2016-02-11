<?php
class Loading extends CI_Controller{

	public function __construct()
	{
		parent::__construct();			
		$this->load->helper('url');		
		$this->load->model('admin_model');
		$this->load->library('fb_ignited');		
		$this->load->library('memory_game');				
	}

	public function index()
	{	
		$this->getInstance();		
		
		$admin_data = $this->admin_model->existence_user_by_fb_id($this->fb_me['id']);		
		if (!$admin_data){
			$data['admin_fb_id'] = $this->fb_me['id'];
			$data['admin_name'] = $this->fb_me['name'];
			$data['game_count'] = 0;
			$data['buy_status'] = false;
			$this->admin_model->insert_user($data);
		}		
		$this->load->view('admin/loading');
	}
	
	
	
	private function getInstance() {
		$this->fb_me = $this->fb_ignited->fb_get_me('admin');
	}
	
	
}