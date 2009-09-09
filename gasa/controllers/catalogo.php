<?php
class Catalogo extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('Productos_model'));
		$this->load->helper(array('statusproducto','form','url','countdiasretraso'));
		$this->controlador_name = 'catalogo';
		$this->user   = $this->native_session->userdata('user');
		$this->output->enable_profiler(false);
	}

	function index()
	{
		$dato['productos']='';
		$dato['producto']    = $this->input->post('producto',true);
		$dato['codigo']      = $this->input->post('codigo',true);
		$dato['sucursal']    = $this->input->post('sucursal_id',true);
		$dato['categoria']   = $this->input->post('categoria_id',true);
		$dato['status']      = $this->input->post('status_id',true);
		$dato['user']        = $this->native_session->userdata('user');
		
		if(
			  (($dato['producto']     == true)      ||  ($dato['producto']      ==''))
			||(($dato['codigo']       == true)      ||  ($dato['codigo']        ==''))
			||($dato['categoria']     == true       ||  ($dato['categoria']     ==''))
			||(($dato['status']       == true)      ||  ($dato['status'] ==''))
			||($dato['sucursal']      == true)
		   )
			{
				$dato['productos'] = $this->Productos_model->getProductosRenta($dato);
			}

		$statuses = array(
							array('id' =>5,'nombre'=>'No Disponible'),
							array('id' =>1,'nombre'=>'Disponible'),
							array('id' =>2,'nombre'=>'En Renta'),
							array('id' =>3,'nombre'=>'Devuelto'),
							array('id' =>4,'nombre'=>'Mantenimiento')
							);
							
		$data['breadcrums'] = 'CATALOGO >';
		$dato['categorias'] = $this->db->get('categorias');
		$dato['sucursales'] = $this->db->get('sucursales');
		$dato['statuses'] = $statuses;
		$dato['total'] = $dato['productos']->num_rows(); 
		$datoProducto['infoproducto'] = false;
		$dato['info_producto']= $this->load->view('info_producto_view',$datoProducto,true);
		$data['contenido']= $this->load->view('catalogo',$dato,true);
		$data['user']=$this->native_session->userdata('user');
		$data['menu'] = 'catalogo';
		$this->load->view('template',$data);


	}
	
	function agregar()
	{
		if(($this->user['rol'] ==NULL)||($this->user['rol'] ==2)||($this->user['rol'] ==3))redirect('catalogo');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('codigo', 'codigo', 'required|callback_codigo_check');
		$this->form_validation->set_rules('producto', 'producto', 'required');
		$this->form_validation->set_rules('descripcion', 'descripcion', 'required');
		$this->form_validation->set_rules('dia', 'dia', 'numeric');
		$this->form_validation->set_rules('mes', 'mes', 'numeric');
		$this->form_validation->set_rules('anio', 'año', 'numeric');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$dato['hoy']=date('m/d/y');
		$dato['mensaje']=$this->native_session->flashdata('mensaje');
		$dato['meses']=array('Enero'=>1,'Febrero'=>2,'Marzo'=>3,'Abril'=>4,'Mayo'=>5,'Junio'=>6,'Julio'=>7, 'Agosto'=>8,'Septiembre'=>9,'Octubre'=>10,'Noviembre'=>11,'Diciembre'=>12);
		$dato['categorias']=$this->db->get('categorias');
		$dato['sucursales']=$this->db->get('sucursales');
		
		if ($this->form_validation->run() == FALSE)
		{
		}else
		{
			$data=array(
				'codigo' 	 => $this->input->post('codigo'),
				'nombre'	 => $this->input->post('producto'),
				'descripcion'	 => $this->input->post('descripcion'),
				'created'	 => $this->input->post('anio').'/'.$this->input->post('mes').'/'.$this->input->post('dia'),
				'sucursal_id'	 => $this->input->post('sucursal_id'),
				'categoria_id'	 => $this->input->post('categoria'),
				'status'     => DISPONIBLE
				);
			//$this->db->insert('productos',$data);
			$this->Productos_model->insertar($data);
			$this->native_session->set_flashdata('mensaje','<div id="mensaje" >Articulo agregado</div>');
			//redirect('catalogo/agregar');
			redirect('catalogo');
		}
		$data['breadcrums'] = 'CATALOGO > AGREGAR';
		$data['contenido']= $this->load->view('catalogo_agregar',$dato,true);
		$data['user']=$this->native_session->userdata('user');
		$data['menu'] = 'catalogo';
		$this->load->view('template',$data);
	}
	function modificar()
	{
		if(($this->user['rol'] ==NULL)||($this->user['rol'] ==2))redirect('catalogo');
		$ID = $this->uri->segment(3);
		$this->db->where('codigo',$ID);
		$dato['producto']= $this->db->get('productos')->row();
		
		$this->load->library('form_validation');
		//$this->form_validation->set_rules('codigo', 'codigo', 'required|callback_codigo_check');
		$this->form_validation->set_rules('producto', 'producto', 'required');
		$this->form_validation->set_rules('descripcion', 'descripcion', 'required');
		//$this->form_validation->set_rules('dia', 'dia', 'numeric');
		//$this->form_validation->set_rules('mes', 'mes', 'numeric');
		//$this->form_validation->set_rules('anio', 'año', 'numeric');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$dato['hoy']=date('m/d/y');
		$dato['mensaje']=$this->native_session->flashdata('mensaje');
		//$dato['meses']=array('Enero'=>1,'Febrero'=>2,'Marzo'=>3,'Abril'=>4,'Mayo'=>5,'Junio'=>6,'Julio'=>7, 'Agosto'=>8,'Septiembre'=>9,'Octubre'=>10,'Noviembre'=>11,'Diciembre'=>12);
		$dato['categorias']=$this->db->get('categorias');
		$dato['sucursales']=$this->db->get('sucursales');
		
		if ($this->form_validation->run() == FALSE)
		{
		}else
		{
			$data=array(
				'codigo' 	 => $this->input->post('codigo'),
				'nombre'	 => $this->input->post('producto'),
				'descripcion'	 => $this->input->post('descripcion'),
				//'created'	 => $this->input->post('anio').'/'.$this->input->post('mes').'/'.$this->input->post('dia'),
				'sucursal_id'	 => $this->input->post('sucursal_id'),
				'categoria_id'	 => $this->input->post('categoria')
				);
			//$this->db->insert('productos',$data);
			$this->Productos_model->actualizar($data,$ID);
			//$this->native_session->set_flashdata('mensaje','<div id="mensaje" >Articulo editar</div>');
			redirect('catalogo');
		}
		$dato['user']=$this->native_session->userdata('user');
		$data['contenido']= $this->load->view('catalogo_editar',$dato,true);
		$data['user']=$this->native_session->userdata('user');
		$data['menu'] = 'catalogo';
		$this->load->view('template',$data);
	}
	
	function codigo_check($str)
	{
		if(($this->user['rol'] ==NULL)||($this->user['rol'] ==2)||($this->user['rol'] ==3))redirect('catalogo');
		$this->db->where('codigo',$str);
		$registros=$this->db->get('productos');
		
		if ($registros->num_rows() > 0)
		{
			$this->form_validation->set_message('codigo_check', 'Este c&oacute;digo ya existe');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function viewInfoProducto()
	{
		$this->output->enable_profiler(false);
		$codigo = $this->input->post('codigo',true);
		$status = $this->input->post('status',true);
		if($status == EN_RENTA)
		{
			$query = $this->Productos_model->getProductoInfoRentado($codigo);
			if($query->num_rows()>0)
			{
				$dato['infoproducto'] =$query;
			}
		}
		else
		{
			$query = $this->Productos_model->getProductoInfo($codigo);
			if($query->num_rows()>0)
			{
				$dato['infoproducto'] =$query;
			}
		}
		
		echo  $this->load->view('info_producto_view',$dato,true);
	}
	
	function vistaRenovacionProducto()
	{
		$this->output->enable_profiler(false);
		$codigo = $this->input->post('codigo',true);
	
			$query = $this->Productos_model->getProductoInfoRentado($codigo);
			if($query->num_rows()>0)
			{
				$dato['infoproducto'] =$query;
			}
		
			
		
		echo  $this->load->view('renovar_producto_view',$dato,true);
	}
	
	function renovar_producto()
	{
	
		$id           = $this->input->post('id');
		$ndias        = $this->input->post('f_dia');
		$dias_retraso = $this->input->post('dias_retraso');
		$fecha        = $this->aumenta_dias($ndias);
		
		$data['fecha_promesa'] = $fecha;
		$data['dias_retraso'] = $dias_retraso;
		
		if($this->Productos_model->actualizar_ds($data,$id))
			redirect('catalogo');
	}
	


	function borrar()
	{
		if(($this->user['rol'] ==NULL)||($this->user['rol'] ==2)||($this->user['rol'] ==3))redirect('catalogo');
		$codigo = $this->uri->segment(3);
		if($codigo){
			$this->db->where('codigo',$codigo);
			$this->db->delete('productos');
			redirect('catalogo');
			
		}
		
	}
	
	function aumenta_dias($ndias)
	{
		$mes = date("m");
		$anio = date("Y");
		$dia = date("d");
		$nueva = mktime(0,0,0, $mes,$dia,$anio) + $ndias * 24 * 60 * 60;
		$nuevafecha=date("Y-m-d",$nueva);
	return $nuevafecha;
	}
}
