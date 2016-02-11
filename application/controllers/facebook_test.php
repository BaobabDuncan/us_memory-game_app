<?php
class Facebook_test extends CI_Controller {

	function __construct()
	{
		parent::__construct();			
		$this->load->library('fb_ignited');		
		$this->fb_me = $this->fb_ignited->fb_get_me();	
		
	}

	function index($type="")
	{	
		
	}
}