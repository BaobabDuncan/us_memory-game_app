<?php
class Ranking extends CI_Controller{

	function __construct()
	{
		parent::__construct();			
		$this->load->helper('url');		
	}

	function index()
	{			
		$this->load->model('ranking_model');
		$rankings = $this->ranking_model->get_order_rankings($this->input->get('game_id'));
		$data['rankings'] = $rankings;
		$this->load->view('admin/ranking_view',$data);
	}
	
}