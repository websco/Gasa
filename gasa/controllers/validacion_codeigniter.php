<?php
//controller:
function ingresar(){
	$this->load->library('form_validation');

	//lleva 3 parametros, el primero es como se llama en tu formulario
	// el segundo es el texto que sale junto al mendaje de error
	// el tercero es el tipo de validacion
	
    $this->form_validation->set_rules('username', 'Nombre de usuario', 'required|numeric');
	$this->form_validation->set_rules('password', 'La contraseña', 'required');
	$this->form_validation->set_rules('email', 'El email', 'required|valid_email');

	if ($this->form_validation->run() == FALSE){
		//aqui se muestra la vista normal del fomulario
		$this->load->view('myform');
		
	}else{
	        // aqui realizas el insert
		$this->load->view('formsuccess');
	}


}
?>