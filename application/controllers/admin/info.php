<?php
class Info extends CI_Controller{

	function __construct()
	{
		parent::__construct();			
		$this->load->helper('url');		
	}

	function index()
	{	
		$this->load->view('admin/info_view');
	}
}