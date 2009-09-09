<?php

class Main extends MY_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$data['breadcrums'] = '';
		$data['user']=$this->native_session->userdata('user');
		
		$data['contenido']= $this->load->view('main_view',null,true);
		$this->load->view('main_template',$data);
	}
}