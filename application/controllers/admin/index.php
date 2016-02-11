<?php
class Index extends CI_Controller{

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
		if($this->admin_data['buy_status']==false){
			$this->load->view('admin/buy_view');			
		}
		else{
			$this->load->view('admin/main_view');
		}		
	}
	
	public function buy(){
		$this->getInstance();		
		$this->admin_data = $this->memory_game->createAdminArray($this->admin_model->existence_user_by_fb_id($this->fb_me['id']));
		if($this->input->post('buy_status')){					
			//echo 1;
			$this->admin_data['buy_status'] = true;		
			$this->admin_model->update_admin($this->admin_data);
			//get image data
			redirect('/admin/main/photo', 'refresh');					
		}
		
		
	}
	
	private function getInstance() {
		$this->fb_me = $this->fb_ignited->fb_get_me('admin');
		$this->admin_data = $this->memory_game->createAdminArray($this->admin_model->existence_user_by_fb_id($this->fb_me['id']));
	}
	
	
}