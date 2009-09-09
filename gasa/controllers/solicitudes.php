<?php
class Solicitudes extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('Solicitud'));
		$this->load->helper(array('form','url'));
		$this->controlador_name = 'solicitudes';
		$this->user   = $this->native_session->userdata('user');
		$this->output->enable_profiler(false);
	}
	
	function index()
	{

		if(($this->user['rol'] ==NULL)||($this->user['rol'] ==2)||($this->user['rol'] ==3))redirect('catalogo');
		
		$data['user'] = $this->user;    // celular de ianiz 9991112984
		$username = $data['user']['username'];
		
		$solicitudes           = $this->Solicitud->getSolicitudes();
		$dato['solicitudes']   = $solicitudes;
		$data['breadcrums']    = 'Solicitudes >';
		$dato['controlador']  = $this->controlador_name;
		
		$dato['ventana']      = $ventana =$this->load->view('ventana_psolicitudes',null,true); 
		
		$data['contenido']    = $this->load->view('lista_solicitudes_view',$dato,true);
		$data['user']         = $this->native_session->userdata('user');
		$data['menu'] = 'solicitudes';
		$this->load->view('template',$data);
		
	}

	function bringProductos()
	{
		if(($this->user['rol'] ==NULL)||($this->user['rol'] ==2)||($this->user['rol'] ==3))redirect('catalogo');
		$this->output->enable_profiler(false);
		$id_solicitud      = $this->input->post('elid');
		$query01           = $this->Solicitud->getProductos_bySolId($id_solicitud);
		/*
		foreach ($query01->result() as $row)
        {
			$producto_e['codigo']        = $row->codigo;
			$producto_e['categoria']     = $row->categoria;
            $producto_e['nombre']        = $row->nombre;
			$producto_e['descripcion']   = $row->descripcion;
			$producto_e['fecha_salida']  = $row->fecha_salida;
			$producto_e['fecha_promesa'] = $row->fecha_promesa;
			
		}*/
		$data['productos']= $query01;
		$ventana =$this->load->view('ventana_psolicitudes',$data,true); 
		echo $ventana;
	}

	

}
?>
