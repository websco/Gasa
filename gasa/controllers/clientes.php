<?php
class Clientes extends MY_Controller {

	function __construct()
	{
		parent::__construct();
  		$this->load->model(array('productos_model','clientes_model','Solicitud'));
		$this->load->helper(array('statusproducto'));
		$this->controlador_name = 'clientes';
		$this->user   = $this->native_session->userdata('user');
		$this->output->enable_profiler(false);
	}
	function index()
	{
		$search = $this->input->post('ncliente');
		$dato['clientes'] = array();
		$dato['total_clientes']=0;

		if($search){
			$dato['clientes'] = $this->clientes_model->search($search);
			$dato['total_clientes'] = $dato['clientes']->num_rows();
 		}
 		
		$data['contenido']= $this->load->view('clientes/clientes_view',$dato,true);
		$data['user']=$this->native_session->userdata('user');
		$data['menu'] = 'clientes';
		$this->load->view('template',$data);
	
	}
	
	function cliente_nuevo()
	{
		//Checando la session del usuario
		
		//if(($this->user['rol'] ==NULL)||($this->user['rol'] ==2))redirect('catalogo');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nombre', 'Nombre del cliente', 'required');
		$this->form_validation->set_rules('direccion', 'Dirección', 'required');
		$this->form_validation->set_rules('telefono', 'Teléfono', 'required');
		$this->form_validation->set_rules('celular', 'Celular', '');
		$this->form_validation->set_rules('email', 'Email', 'valid_email');
		$this->form_validation->set_rules('id_type', 'Tipo de identificación', 'required');
		$this->form_validation->set_rules('id_num', 'identificación', 'required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		if(isset($_POST['nombre'])){
			if($this->form_validation->run() ==TRUE)
			{

			  $a_cliente['nombre'] = $this->input->post('nombre',true);		 
			  $a_cliente['telefono'] =$this->input->post('telefono',true);
			  $a_cliente['celular'] =$this->input->post('celular',true);
			  $a_cliente['direccion'] =$this->input->post('direccion',true);
			  $a_cliente['email'] =$this->input->post('email',true);
			  $a_cliente['id_type'] =$this->input->post('id_type',true);
			  $a_cliente['id_num'] =$this->input->post('id_num',true);
			  
				if($this->clientes_model->insertar($a_cliente)){
					redirect("clientes");
				}
			}
		}	

		$data['contenido']= $this->load->view('clientes/cliente_nuevo',null,true);
		$data['user']=$this->native_session->userdata('user');
		$data['menu'] = 'clientes';
		$this->load->view('template',$data);
	}
	
	function cliente_editar($id)
	{
		//Checando la session del usuario
		//if(($this->user['rol'] ==NULL)||($this->user['rol'] ==2))redirect('catalogo');
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nombre', 'Nombre del cliente', 'required');
		$this->form_validation->set_rules('direccion', 'Dirección', 'required');
		$this->form_validation->set_rules('telefono', 'Teléfono', 'required');
		$this->form_validation->set_rules('celular', 'Celular', '');
		$this->form_validation->set_rules('email', 'Email', 'valid_email');
		$this->form_validation->set_rules('id_type', 'Tipo de identificación', 'required');
		$this->form_validation->set_rules('id_num', 'identificación', 'required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		if(isset($_POST['nombre'])){
		
			if($this->form_validation->run() ==TRUE){
			
		
			  $a_cliente['nombre'] =$this->input->post('nombre',true);
			  $a_cliente['telefono'] =$this->input->post('telefono',true);
			  $a_cliente['celular'] =$this->input->post('celular',true);
			  $a_cliente['direccion'] =$this->input->post('direccion',true);
			  $a_cliente['email'] =$this->input->post('email',true);
			  $a_cliente['id_type'] =$this->input->post('id_type',true);
			  $a_cliente['id_num'] =$this->input->post('id_num',true);
			  
			 
				if($this->clientes_model->actualizar($a_cliente,$id))
				{
					redirect('clientes');
				}
			}
		}
		
		 $query01 = $this->db->get_where('clientes',array('id' => $id));
         
		
         foreach ($query01->result() as $row){
			$dato['id']             = $row->id;
            $dato['nombre']         = $row->nombre;
			$dato['telefono']       = $row->telefono;
			$dato['celular']        = $row->celular;
			$dato['direccion']      = $row->direccion;
			$dato['email']          = $row->email;
			$dato['id_type']        = $row->id_type;
			$dato['id_num']         = $row->id_num;
			
           }

		$data['contenido']= $this->load->view('clientes/cliente_editar',$dato,true);
		$data['user']=$this->native_session->userdata('user');
		$data['menu'] = 'clientes';
		$this->load->view('template',$data);
      	
	}
	

}
