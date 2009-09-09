<?php

class Entradas extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('statusproducto','countdiasretraso'));
		$this->load->model(array('Entrada'));
		$this->controlador_name = 'entradas';
		$this->user   = $this->native_session->userdata('user');
		$this->output->enable_profiler(false);

	}

	function index()
	{
		$dato['codigo_producto'] = $this->input->post('codigo_producto',true);
		$dato['codigo_hidden'] = $this->input->post('codigo_hidden',true);
		$dato['btn_devolver'] = $this->input->post('btn_devolver',true);
		$dato['btn_mantenimiento'] = $this->input->post('btn_mantenimiento',true);
		$dato['btn_disponible'] = $this->input->post('btn_disponible',true);
		$rol_usuario = $this->user['rol'];
		if($dato['codigo_producto']){
			$dato['codigo_hidden']=$dato['codigo_producto'];
			$status_producto = $this->Entrada->getStatusProducto($dato['codigo_producto']);
			
			if($status_producto >=0)
			{
				if($rol_usuario==1){
				/*
					if($status_producto==EN_MANTENIMIENTO || $status_producto==DISPONIBLE || $status_producto==NO_DISPONIBLE)
					{
						$dato['productos'] = $this->Entrada->getProductoInfo($dato['codigo_producto'],$status_producto);
					}else{
					*/
							$dato['productos'] = $this->Entrada->getProductoAdmin($dato['codigo_producto'],$status_producto);
					//	}
				}else{
					/*
					if($status_producto==EN_MANTENIMIENTO || $status_producto==DISPONIBLE || $status_producto==NO_DISPONIBLE)
					{
						$dato['productos'] = $this->Entrada->getProductoInfo($dato['codigo_producto'],$status_producto);
					}else{
					*/
							$dato['productos'] = $this->Entrada->getProductoUser($dato['codigo_producto'],$status_producto);
					//	}
				}
			//$total= $dato['productos']->num_rows();		
					$dato['mensaje'] = '';
			}
			else
			{
				$dato['productos'] = '';
				$dato['mensaje'] = "<span class='normales'>Solo se acepta codigo del producto, intenta buscando en el cat&aacute;logo</span>";
			}
		}
	
		if($dato['btn_devolver']){
			
			
			$producto['sucursal_id'] = $this->user['sucursal_id'];
			$producto['codigo'] = $dato['codigo_hidden'];
			$id_solicitud = $this->Entrada->getSolicitudId($producto['codigo']);
			//contando los productos de acuerdo al id solicitud
			$num_productos_solicitud = $this->Entrada->countProd_by_SolId($id_solicitud);
			$status= DEVUELTO;
			if($this->Entrada->updProducto($producto,$status)){
				if($this->Entrada->updDetProducto($producto,$status)){
				
					$num_prod_devueltos = $this->Entrada->countProd_devueltos($id_solicitud);
					if($num_productos_solicitud == $num_prod_devueltos)
					{
						$this->Entrada->updSolicitud($id_solicitud);
					}
					$dato['status_actualizado'] = true;
					$dato['tipo_status'] = STATUS_P3;
					
				}
			}
			
		}
		
		if($dato['btn_mantenimiento']){
			
			
			$producto['sucursal_id'] = $this->user['sucursal_id'];
			$producto['codigo'] = $dato['codigo_hidden'];
		
			
			$status= EN_MANTENIMIENTO;
			if($this->Entrada->updProducto($producto,$status)){
				if($this->Entrada->updDetMantProducto($producto)){
					$dato['status_actualizado'] = true;
					$dato['tipo_status'] = STATUS_P4;
					}
			}
			
		}
		
		if($dato['btn_disponible']){
			
			
			$producto['sucursal_id'] = $this->user['sucursal_id'];
			$producto['codigo'] = $dato['codigo_hidden'];
			
			
			$status= DISPONIBLE;
			if($this->Entrada->updProducto($producto,$status)){
				if($this->Entrada->updDetDispProducto($producto)){
					$dato['status_actualizado'] = true;
					$dato['tipo_status'] = STATUS_P1;
					}
			
			}
			
		}

		
		$data['user']=$this->native_session->userdata('user');
		$dato['user']=$this->native_session->userdata('user');
		//$dato['breadcrums'] = 'Entradas >';
		$data['menu'] = 'entradas';
		$data['contenido']= $this->load->view('entradas_paso1_view',$dato,true);
		$this->load->view('template',$data);
	}
}