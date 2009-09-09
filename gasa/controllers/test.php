<?php
class Test extends Controller{
	function __construct(){
		parent::__construct();
                $this->load->helper('statusproducto');
	}
	function index(){
	      echo 'STATUS-->'.statusproducto_id(1);
	
	}


}
?>
