<?php
class Main extends CI_Controller{

	function __construct()
	{
		parent::__construct();	
		$this->load->helper('url');		
		$this->load->model('admin_model');		
		$this->load->model('image_model');		
		$this->load->library('fb_ignited');		
		$this->load->library('memory_game');		
		$this->fb_me = $this->fb_ignited->fb_get_me('admin');	
		$this->fb_app = $this->fb_ignited->fb_get_app();	
		$this->admin_data =  $this->memory_game->createAdminArray($this->admin_model->existence_user_by_fb_id($this->fb_me['id']));
	}
	
	function index()
	{					
		//$image_count = $this->image_model->get_images_count($this->admin_data['admin_fb_id']);
		//var_dump($image_count);
		
		//$level_data = $this->memory_game->getLevelData($image_count);
		
		//var_dump($level_data);
		
		$this->load->view('admin/main_view');
		
	}
	
	function photo()
	{			
		$admin_id = ($this->admin_data['admin_fb_id']);
		$fb_my_photos = $this->fb_ignited->fb_get_my_photos($admin_id);
				
		foreach ($fb_my_photos as $row)
		{			
			$image_data = $this->image_model->existence_image_by_id($row['object_id']);
			if (!$image_data){				
				$data['admin_fb_id'] = $this->fb_me['id'];
				$data['image_fb_id'] =  $row['object_id'];
				$data['src'] = $row['src'];
				$data['src_small'] = $row['src_small'];			
				$this->image_model->insert_image($data);
			}			
		}
		redirect('/admin/main', 'refresh');							
		//$this->load->view('admin/photo_view');
	}
}