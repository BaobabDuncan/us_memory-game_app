<?php
class Addpage extends CI_Controller{

	function __construct()
	{
		parent::__construct();	
		$this->load->helper('url');		
		$this->load->model('admin_model');		
		$this->load->library('fb_ignited');		
		$this->load->library('memory_game');		
		$this->fb_me = $this->fb_ignited->fb_get_me('admin');	
		$this->admin_data =  $this->memory_game->createAdminArray($this->admin_model->existence_user_by_fb_id($this->fb_me['id']));
	}
	
	function index()
	{			
		$pages= $this->fb_ignited->get_pages();
		var_dump($pages);
		$this->load->view('admin/addpage_view');
	}
}