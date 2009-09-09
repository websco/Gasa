<?php
class Reportes extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('Reporte','Solicitud'));
		$this->load->helper(array('statusproducto','form','url'));
	    $this->controlador_name = 'reportes';
		$this->user             = $this->native_session->userdata('user');
		$this->output->enable_profiler(false);
	}
	
	function imprimir_devueltos()
	{
		if(($this->user['rol'] ==NULL)||($this->user['rol'] ==2))redirect('catalogo');
		$this->load->library('cezpdf');
		$this->load->helper('pdf');
		
		prep_pdf(); // creates the footer for the document we are creating.
		
		
		$dato['producto']      = $this->input->post('pproducto',true);
		$dato['codigo']        = $this->input->post('pcodigo',true);
		$dato['sucursal']      = $this->input->post('psucursal_id',true);
		$dato['categoria']     = $this->input->post('pcategoria_id',true);
		$dato['fecha_e']       = $this->input->post('pfecha_entrega',true);
		
	
		
		if(
			  (($dato['producto']     == true)      ||  ($dato['producto']      ==''))
			||(($dato['codigo']       == true)      ||  ($dato['codigo']        ==''))
			||($dato['categoria']     == true       ||  ($dato['categoria']     ==''))
			||(($dato['fecha_e']      == true)      ||  ($dato['fecha_e'] ==''))
			||($dato['sucursal']      == true)
		   )
			{
				$query = $this->Reporte->getProductosDevueltos($dato);
			}
			
			foreach($query->result() as $row)
			{
					
				$db_data[] = array(
									'cuadro'            => '[    ]',
									'codigo' 			=> $row->codigo,
									'nombre' 			=> $row->nombre,
									'sucursal' 			=> $row->sucursal,
									'categoria' 		=> $row->categoria,
									'fecha_entrada' 	=> date("d/m/Y H:i:s",strtotime($row->fecha_entrada))
									);
		
			}
			
		$col_names = array(
			'cuadro' => '',
			'codigo' => 'Codigo',
			'nombre' => 'Nombre',
			'sucursal' => 'Sucursal',
			'categoria' => 'Categoria',
			'fecha_entrada' => 'Fecha Entrada'
		);
		$options = array(
			'shadeCol'=>array(0.9,0.9,0.9),
			'xOrientation'=>'center',
			'width'=>550
		); 
		
		$this->cezpdf->ezText("Mundo Medico ",18);
		$this->cezpdf->ezText("<b>Fecha:</b> ".date("d/m/Y"),10);
		$this->cezpdf->ezText("<b>Hora:</b> ".date("H:i:s")."\n",10);
		$this->cezpdf->ezText("Total productos devueltos: ".$query->num_rows()."\n",10);
		
		$this->cezpdf->ezTable($db_data, $col_names, 'Productos Devueltos', $options);
		$this->cezpdf->ezStream();
		
	}
	
	function imprimir_disponibles()
	{
		if(($this->user['rol'] ==NULL)||($this->user['rol'] ==2))redirect('catalogo');
		$this->load->library('cezpdf');
		$this->load->helper('pdf');
		
		prep_pdf(); // creates the footer for the document we are creating.
		
		
		$dato['producto']      = $this->input->post('pproducto',true);
		$dato['codigo']        = $this->input->post('pcodigo',true);
		$dato['sucursal']      = $this->input->post('psucursal_id',true);
		$dato['categoria']     = $this->input->post('pcategoria_id',true);
		//$dato['fecha_e']       = $this->input->post('pfecha_entrega',true);
		
	
		
		if(
			  (($dato['producto']     == true)      ||  ($dato['producto']      ==''))
			||(($dato['codigo']       == true)      ||  ($dato['codigo']        ==''))
			||($dato['categoria']     == true       ||  ($dato['categoria']     ==''))
			//||(($dato['fecha_e']      == true)      ||  ($dato['fecha_e'] ==''))
			||($dato['sucursal']      == true)
		   )
			{
				$query = $this->Reporte->getProductosDisponibles($dato);
			}
			
			foreach($query->result() as $row)
			{
					
				$db_data[] = array(
									'cuadro'            => '[    ]',
									'codigo' 			=> $row->codigo,
									'nombre' 			=> $row->nombre,
									'sucursal' 			=> $row->sucursal,
									'categoria' 		=> $row->categoria
									
									);
		
			}
			
		$col_names = array(
			'cuadro' => '',
			'codigo' => 'Codigo',
			'nombre' => 'Nombre',
			'sucursal' => 'Sucursal',
			'categoria' => 'Categoria'
			
		);
		$options = array(
			'shadeCol'=>array(0.9,0.9,0.9),
			'xOrientation'=>'center',
			'width'=>550
		); 
		
		$this->cezpdf->ezText("Mundo Medico ",18);
		$this->cezpdf->ezText("<b>Fecha:</b> ".date("d/m/Y"),10);
		$this->cezpdf->ezText("<b>Hora:</b> ".date("H:i:s")."\n",10);
		$this->cezpdf->ezText("Total productos : ".$query->num_rows()."\n",10);
		
		$this->cezpdf->ezTable($db_data, $col_names, 'Productos Disponibles', $options);
		$this->cezpdf->ezStream();
		
	}
	
	function imprimir_rentados()
	{
		if(($this->user['rol'] ==NULL)||($this->user['rol'] ==2))redirect('catalogo');
		$this->load->library('cezpdf');
		$this->load->helper('pdf');
		
		prep_pdf(); // creates the footer for the document we are creating.
		
		
		$dato['producto']      = $this->input->post('pproducto',true);
		$dato['codigo']        = $this->input->post('pcodigo',true);
		$dato['sucursal']      = $this->input->post('psucursal_id',true);
		$dato['categoria']     = $this->input->post('pcategoria_id',true);
		$dato['fecha_r']       = $this->input->post('pfecha_renta',true);
		//$dato['user']          = $this->native_session->userdata('user');
		
		
		if(
			  (($dato['producto']     == true)      ||  ($dato['producto']      ==''))
			||(($dato['codigo']       == true)      ||  ($dato['codigo']        ==''))
			||($dato['categoria']     == true       ||  ($dato['categoria']     ==''))
			||(($dato['fecha_r']      == true)      ||  ($dato['fecha_r'] ==''))
			||($dato['sucursal']      == true)
		   )
			{
				$query = $this->Reporte->getProductosRenta($dato);
			}

			 
			foreach($query->result() as $row)
			{
					
				$db_data[] = array(
									'cuadro'            => '[    ]',
									'codigo' 			=> $row->codigo,
									'nombre' 			=> $row->nombre,
									'sucursal' 			=> $row->sucursal,
									'categoria' 		=> $row->categoria,
									'fecha_salida'   	=> date("d/m/Y H:i:s",strtotime($row->fecha_salida)),
									'fecha_promesa'   	=> date("d/m/Y ",strtotime($row->fecha_promesa))
									);
		
			}
			
		$col_names = array(
			'cuadro' => '',
			'codigo' => 'Codigo',
			'nombre' => 'Nombre',
			'sucursal' => 'Sucursal',
			'categoria' => 'Categoria',
			'fecha_salida' => 'Fecha Renta',
			'fecha_promesa' => 'Fecha Promesa'
		);
		$options = array(
			'shadeCol'=>array(0.9,0.9,0.9),
			'xOrientation'=>'center',
			'width'=>550
		); 
		
		$this->cezpdf->ezText("Mundo Medico ",18);
		$this->cezpdf->ezText("<b>Fecha:</b> ".date("d/m/Y"),10);
		$this->cezpdf->ezText("<b>Hora:</b> ".date("H:i:s")."\n",10);
		$this->cezpdf->ezText("Total productos rentados: ".$query->num_rows()."\n",10);
		
		$this->cezpdf->ezTable($db_data, $col_names, 'Productos Rentados', $options);
		$this->cezpdf->ezStream();
		
	}
	
	function imprimir_mantenimiento()
	{
		if(($this->user['rol'] ==NULL)||($this->user['rol'] ==2))redirect('catalogo');
		$this->load->library('cezpdf');
		$this->load->helper('pdf');
		
		prep_pdf(); // creates the footer for the document we are creating.
		
		
		$dato['producto']      = $this->input->post('pproducto',true);
		$dato['codigo']        = $this->input->post('pcodigo',true);
		$dato['sucursal']      = $this->input->post('psucursal_id',true);
		$dato['categoria']     = $this->input->post('pcategoria_id',true);
		$dato['fecha_m']       = $this->input->post('pfecha_mante',true);
		//$dato['user']          = $this->native_session->userdata('user');
		
		
		if(
			  (($dato['producto']     == true)      ||  ($dato['producto']      ==''))
			||(($dato['codigo']       == true)      ||  ($dato['codigo']        ==''))
			||($dato['categoria']     == true       ||  ($dato['categoria']     ==''))
			||(($dato['fecha_m']      == true)      ||  ($dato['fecha_m'] ==''))
			||($dato['sucursal']      == true)
		   )
			{
				$query = $this->Reporte->getProductosMantenimiento($dato);
			}
		
			foreach($query->result() as $row)
			{
					
				$db_data[] = array(
									'cuadro'            => '[    ]',
									'codigo' 			=> $row->codigo,
									'nombre' 			=> $row->nombre,
									'sucursal' 			=> $row->sucursal,
									'categoria' 		=> $row->categoria,
									'fecha_entrada' 	=> date("d/m/Y H:i:s",strtotime($row->fecha_entrada)),
									'f_mante_entrada'   => date("d/m/Y H:i:s",strtotime($row->f_mante_entrada))
									);
		
			}
			
		$col_names = array(
			'cuadro' => '',
			'codigo' => 'Codigo',
			'nombre' => 'Nombre',
			'sucursal' => 'Sucursal',
			'categoria' => 'Categoria',
			'fecha_entrada' => 'Fecha Entrada',
			'f_mante_entrada'   => 'Fecha Mantenimiento'
		);
		$options = array(
			'shadeCol'=>array(0.9,0.9,0.9),
			'xOrientation'=>'center',
			'width'=>550
		); 		
		
		$this->cezpdf->ezText("Mundo Medico ",18);
		$this->cezpdf->ezText("<b>Fecha:</b> ".date("d/m/Y"),10);
		$this->cezpdf->ezText("<b>Hora:</b> ".date("H:i:s")."\n",10);
		$this->cezpdf->ezText("Total productos en mantenimiento: ".$query->num_rows()."\n",10);
		
		$this->cezpdf->ezTable($db_data, $col_names, 'Productos en Mantenimiento', $options);
		$this->cezpdf->ezStream();
		
	}
	function imprimir_retrasos()
	{
		if(($this->user['rol'] ==NULL)||($this->user['rol'] ==2))redirect('catalogo');
		$this->load->library('cezpdf');
		$this->load->helper('pdf');
		
		prep_pdf(); // creates the footer for the document we are creating.
		
		
		$dato['producto']      = $this->input->post('pproducto',true);
		$dato['codigo']        = $this->input->post('pcodigo',true);
		$dato['sucursal']      = $this->input->post('psucursal_id',true);
		$dato['categoria']     = $this->input->post('pcategoria_id',true);
		$dato['fecha_p']       = $this->input->post('pfecha_promesa',true);
		$dato['dias']          = $this->input->post('pdias',true);
		//$dato['user']          = $this->native_session->userdata('user');
		
		
		if(
			  (($dato['producto']     == true)      ||  ($dato['producto']      ==''))
			||(($dato['codigo']       == true)      ||  ($dato['codigo']        ==''))
			||($dato['categoria']     == true       ||  ($dato['categoria']     ==''))
			||(($dato['fecha_r']      == true)      ||  ($dato['fecha_r'] ==''))
			||(($dato['dias']         == true)      ||  ($dato['dias'] ==''))
			||($dato['sucursal']      == true)
		   )
			{
				$query = $this->Reporte->getProductosRetrasados($dato);
			}
			
			
			foreach($query->result() as $row)
			{
					
				$db_data[] = array(
									'cuadro'            => '[    ]',
									'codigo' 			=> $row->codigo,
									'nombre' 			=> $row->nombre,
									'sucursal' 			=> $row->sucursal,
									'categoria' 		=> $row->categoria,
									'fecha_salida' 	    => date("d/m/Y H:i:s",strtotime($row->fecha_salida)),
									'fecha_promesa' 	=> date("d/m/Y ",strtotime($row->fecha_promesa)),
									'dias' 	            => $row->dias
									);
		
			}
			
		$col_names = array(
			'cuadro' => '',
			'codigo' => 'Codigo',
			'nombre' => 'Nombre',
			'sucursal' => 'Sucursal',
			'categoria' => 'Categoria',
			'fecha_salida' 	    => 'Fecha Renta',
			'fecha_promesa' 	=> 'Fecha Promesa',
			'dias' 	            => 'Dias'
		);
		$options = array(
			'shadeCol'=>array(0.9,0.9,0.9),
			'xOrientation'=>'center',
			'width'=>550
		); 		
		
		$this->cezpdf->ezText("Mundo Medico ",18);
		$this->cezpdf->ezText("<b>Fecha:</b> ".date("d/m/Y"),10);
		$this->cezpdf->ezText("<b>Hora:</b> ".date("H:i:s")."\n",10);
		$this->cezpdf->ezText("Total productos con retraso: ".$query->num_rows()."\n",10);
		
		$this->cezpdf->ezTable($db_data, $col_names, 'Productos Retrasados', $options);
		$this->cezpdf->ezStream();
		
	}
	
	//Por defaul cargamos la vista de Productos Devueltos
	function index()
	{
		if(($this->user['rol'] ==NULL)||($this->user['rol'] ==2))redirect('catalogo');
		$dato['productos']     = '';
		$dato['producto']      = $this->input->post('producto',true);
		$dato['codigo']        = $this->input->post('codigo',true);
		$dato['sucursal']      = $this->input->post('sucursal_id',true);
		$dato['categoria']     = $this->input->post('categoria_id',true);
		$dato['fecha_e']       = $this->input->post('fecha_entrega',true);
		$dato['user']          = $this->native_session->userdata('user');
		
		
		if(
			  (($dato['producto']     == true)      ||  ($dato['producto']      ==''))
			||(($dato['codigo']       == true)      ||  ($dato['codigo']        ==''))
			||($dato['categoria']     == true       ||  ($dato['categoria']     ==''))
			||(($dato['fecha_e']== true)            ||  ($dato['fecha_e'] ==''))
			||($dato['sucursal']      == true)
		   )
			{
				$dato['productos'] = $this->Reporte->getProductosDevueltos($dato);
			}

		$dato['categorias'] = $this->Reporte->getCategorias();
		$dato['sucursales'] = $this->Reporte->getSucursales();
		
		$datoProducto['infoproducto'] = false;
		$dato['info_producto']= $this->load->view('reportes/info_producto_view',$datoProducto,true);
		$dato['total'] = $dato['productos']->num_rows(); 
		$data['contenido']= $this->load->view('reportes/reportes_dev_view',$dato,true);
		$data['user'] = $this->native_session->userdata('user');
		$data['menu'] = 'reportes';
		$this->load->view('template',$data);


	}
	
	//Por defaul cargamos la vista de Productos Devueltos
	function disponibles()
	{
		if(($this->user['rol'] ==NULL)||($this->user['rol'] ==2))redirect('catalogo');
		$dato['productos']     = '';
		$dato['producto']      = $this->input->post('producto',true);
		$dato['codigo']        = $this->input->post('codigo',true);
		$dato['sucursal']      = $this->input->post('sucursal_id',true);
		$dato['categoria']     = $this->input->post('categoria_id',true);
		//$dato['fecha_e']       = $this->input->post('fecha_entrega',true);
		$dato['user']          = $this->native_session->userdata('user');
		
		
		if(
			  (($dato['producto']     == true)      ||  ($dato['producto']      ==''))
			||(($dato['codigo']       == true)      ||  ($dato['codigo']        ==''))
			||($dato['categoria']     == true       ||  ($dato['categoria']     ==''))
			//||(($dato['fecha_e']== true)            ||  ($dato['fecha_e'] ==''))
			||($dato['sucursal']      == true)
		   )
			{
				$dato['productos'] = $this->Reporte->getProductosDisponibles($dato);
			}

		$dato['categorias'] = $this->Reporte->getCategorias();
		$dato['sucursales'] = $this->Reporte->getSucursales();
		
		$datoProducto['infoproducto'] = false;
		$dato['info_producto']= $this->load->view('reportes/info_producto_view',$datoProducto,true);
		$dato['total'] = $dato['productos']->num_rows(); 
		$data['contenido']= $this->load->view('reportes/reportes_disp_view',$dato,true);
		$data['user'] = $this->native_session->userdata('user');
		$data['menu'] = 'reportes';
		$this->load->view('template',$data);


	}
	
	//funcion que obtiene los productos en mantenimiento 
	
	function mantenimientos()
	{
		if(($this->user['rol'] ==NULL)||($this->user['rol'] ==2))redirect('catalogo');
		$dato['productos']     = '';
		$dato['producto']      = $this->input->post('producto',true);
		$dato['codigo']        = $this->input->post('codigo',true);
		$dato['sucursal']      = $this->input->post('sucursal_id',true);
		$dato['categoria']     = $this->input->post('categoria_id',true);
		$dato['fecha_m']       = $this->input->post('fecha_mante',true);
		$dato['user']          = $this->native_session->userdata('user');
		
		
		if(
			  (($dato['producto']     == true)      ||  ($dato['producto']      ==''))
			||(($dato['codigo']       == true)      ||  ($dato['codigo']        ==''))
			||($dato['categoria']     == true       ||  ($dato['categoria']     ==''))
			||(($dato['fecha_m']      == true)      ||  ($dato['fecha_m'] ==''))
			||($dato['sucursal']      == true)
		   )
			{
				$dato['productos'] = $this->Reporte->getProductosMantenimiento($dato);
			}

		$dato['categorias'] = $this->Reporte->getCategorias();
		$dato['sucursales'] = $this->Reporte->getSucursales();
		
		$datoProducto['infoproducto'] = false;
		$dato['info_producto']= $this->load->view('reportes/info_producto_view',$datoProducto,true);
		$dato['total'] = $dato['productos']->num_rows(); 
		$data['contenido']= $this->load->view('reportes/reportes_mant_view',$dato,true);
		$data['user'] = $this->native_session->userdata('user');
		$data['menu'] = 'reportes';
		$this->load->view('template',$data);


	}
	
	function rentas()
	{
		if(($this->user['rol'] ==NULL)||($this->user['rol'] ==2))redirect('catalogo');
		$dato['productos']     = '';
		$dato['producto']      = $this->input->post('producto',true);
		$dato['codigo']        = $this->input->post('codigo',true);
		$dato['sucursal']      = $this->input->post('sucursal_id',true);
		$dato['categoria']     = $this->input->post('categoria_id',true);
		$dato['fecha_r']       = $this->input->post('fecha_renta',true);
		$dato['user']          = $this->native_session->userdata('user');
		
		
		if(
			  (($dato['producto']     == true)      ||  ($dato['producto']      ==''))
			||(($dato['codigo']       == true)      ||  ($dato['codigo']        ==''))
			||($dato['categoria']     == true       ||  ($dato['categoria']     ==''))
			||(($dato['fecha_r']      == true)      ||  ($dato['fecha_r'] ==''))
			||($dato['sucursal']      == true)
		   )
			{
				$dato['productos'] = $this->Reporte->getProductosRenta($dato);
			}

		$dato['categorias'] = $this->Reporte->getCategorias();
		$dato['sucursales'] = $this->Reporte->getSucursales();
		
		$datoProducto['infoproducto'] = false;
		$dato['info_producto']= $this->load->view('reportes/info_producto_view',$datoProducto,true);
		$dato['total'] = $dato['productos']->num_rows(); 
		$data['contenido']= $this->load->view('reportes/reportes_renta_view',$dato,true);
		$data['user'] = $this->native_session->userdata('user');
		$data['menu'] = 'reportes';
		$this->load->view('template',$data);


	}
	
	function retrasos()
	{
		if(($this->user['rol'] ==NULL)||($this->user['rol'] ==2))redirect('catalogo');
		$dato['productos']     = '';
		$dato['producto']      = $this->input->post('producto',true);
		$dato['codigo']        = $this->input->post('codigo',true);
		$dato['sucursal']      = $this->input->post('sucursal_id',true);
		$dato['categoria']     = $this->input->post('categoria_id',true);
		$dato['fecha_p']       = $this->input->post('fecha_promesa',true);
		$dato['dias']          = $this->input->post('dias',true);
		$dato['user']          = $this->native_session->userdata('user');
		
		
		if(
			  (($dato['producto']     == true)      ||  ($dato['producto']      ==''))
			||(($dato['codigo']       == true)      ||  ($dato['codigo']        ==''))
			||($dato['categoria']     == true       ||  ($dato['categoria']     ==''))
			||(($dato['fecha_r']      == true)      ||  ($dato['fecha_r'] ==''))
			||(($dato['dias']         == true)      ||  ($dato['dias'] ==''))
			||($dato['sucursal']      == true)
		   )
			{
				$dato['productos'] = $this->Reporte->getProductosRetrasados($dato);
			}

		$dato['categorias'] = $this->Reporte->getCategorias();
		$dato['sucursales'] = $this->Reporte->getSucursales();
		
		$datoProducto['infoproducto'] = false;
		$dato['info_producto']= $this->load->view('reportes/info_producto_view',$datoProducto,true);
		$dato['total'] = $dato['productos']->num_rows(); 
		$data['contenido']= $this->load->view('reportes/reportes_retrasos_view',$dato,true);
		$data['user'] = $this->native_session->userdata('user');
		$data['menu'] = 'reportes';
		$this->load->view('template',$data);


	}
	
	function viewInfoProducto()
	{
		if(($this->user['rol'] ==NULL)||($this->user['rol'] ==2))redirect('catalogo');
		$this->output->enable_profiler(false);
		$codigo = $this->input->post('codigo',true);
		$status = $this->input->post('status',true);
		switch($status)
		{
			case EN_RENTA:
			{
				$query = $this->Reporte->getProductosInfoRenta($codigo);
			}
			break;
			case DEVUELTO:
			{
				$query = $this->Reporte->getProductosInfoDevueltos($codigo);
			}
			break;
			case EN_MANTENIMIENTO:
			{
				$query = $this->Reporte->getProductosInfoMante($codigo);
			}
			break;
			case DISPONIBLE:
			{
				$query = $this->Reporte->getProductosInfoDisponibles($codigo);
			}
			break;

		}
		
		if($query->num_rows()>0)
		{
				$dato['infoproducto'] =$query;
		}

		echo  $this->load->view('reportes/info_producto_view',$dato,true);
	}
	
	function cambiarPaDevuelto()
	{
			if(($this->user['rol'] ==NULL)||($this->user['rol'] ==2))redirect('catalogo');
			$this->output->enable_profiler(false);
			$producto['sucursal_id'] = $this->user['sucursal_id'];
			$producto['codigo']      = $this->input->post('codigo',true);
			$id_solicitud = $this->Reporte->getSolicitudId($producto);
			//contando los productos de acuerdo al id solicitud
			$num_productos_solicitud = $this->Reporte->countProd_by_SolId($id_solicitud);
			$status= DEVUELTO;
			if($this->Reporte->updProducto($producto,$status)){
				if($this->Reporte->updDetProducto($producto,$status)){
				
					$num_prod_devueltos = $this->Reporte->countProd_devueltos($id_solicitud);
					if($num_productos_solicitud == $num_prod_devueltos)
					{
						$this->Reporte->updSolicitud($id_solicitud);
					
					}
						$resultado='true';
				}else{$resultado='false';}
			}
			
		echo $resultado;
	}
	
	function cambiarPaMantenimiento()
	{
		if(($this->user['rol'] ==NULL)||($this->user['rol'] ==2))redirect('catalogo');
		$this->output->enable_profiler(false);
		$producto['sucursal_id'] = $this->user['sucursal_id'];
		$producto['codigo']      = $this->input->post('codigo',true);

		$status= EN_MANTENIMIENTO;
			if($this->Reporte->updProducto($producto,$status)){
				if($this->Reporte->updDetMantProducto($producto)){
					
					$resultado='true';
					}else{ $resultado='false';}
			}
		echo $resultado;
	}
	function cambiarPaDisponibleSucursal()
	{
		if(($this->user['rol'] ==NULL)||($this->user['rol'] ==2))redirect('catalogo');
		$this->output->enable_profiler(false);
		$producto['sucursal_id'] = $this->input->post('sucursal_id',true);
		$producto['codigo']      = $this->input->post('codigo',true);

		$status= DISPONIBLE;
			if($this->Reporte->updProducto($producto,$status)){
				if($this->Reporte->updDetMantSalProducto($producto)){
					
					$resultado='true';
					}else{ $resultado='false';}
			}
		echo $resultado;
	}
	
	function cambiarPaDisponible()
	{
		if(($this->user['rol'] ==NULL)||($this->user['rol'] ==2))redirect('catalogo');
		$this->output->enable_profiler(false);
		$producto['sucursal_id'] = $this->user['sucursal_id'];
		$producto['codigo']      = $this->input->post('codigo',true);

		$status= DISPONIBLE;
			if($this->Reporte->updProducto($producto,$status)){
				if($this->Reporte->updDetMantSalProducto($producto)){
					
					$resultado='true';
					}else{ $resultado='false';}
			}
		echo $resultado;
	}
	
	/*	
	function index()
	{

		//if(($this->user['rol'] ==NULL)||($this->user['rol'] ==2))redirect('catalogo');
		
		$data['user'] = $this->user;   
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
*/
	function bringProductos()
	{
		if(($this->user['rol'] ==NULL)||($this->user['rol'] ==2))redirect('catalogo');
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
