<?php
class Reporte extends Model{
	
	function __construct(){
		parent::Model();
		
	}
	
	function getCategorias()
	{
		return $this->db->get('categorias');
	}
	
	function getSucursales()
	{
		return $this->db->get('sucursales');
	}
	
		//Funcion que devuelve los productos que tienen estatus 1 - DISPONIBLE
	function getProductosDisponibles($dato)
	{
		$query='';
		
		if($dato['sucursal'] && $dato['sucursal']!='0')
		{
			$query.=' and s.id = '.$dato['sucursal'];
		}

		if($dato['categoria'] && $dato['categoria']!='')
		{
			$query.=' and c.id = '.$dato['categoria'];
		}

		if($dato['producto']&& $dato['producto']!='')
		{
			$query.='  and p.nombre like("%'.$dato['producto'].'%")  ';
		}

		if(($dato['codigo'])&& $dato['codigo']!='')
		{
			$query.= ' and p.codigo="'.$dato['codigo'].'"';
		}
		
		return $this->db->query("select p.codigo,p.nombre,p.status,s.nombre as sucursal ,c.categoria 
									from productos p 
									join sucursales s on p.sucursal_id=s.id  
									join categorias c on p.categoria_id = c.id 
									where p.status=".DISPONIBLE.$query);
								
						
	
	}
	
	function getProductosInfoDisponibles($codigo)
	{
	return $this->db->query("select p.codigo,p.nombre,p.descripcion,p.status,s.nombre as sucursal ,c.categoria 
							from productos p 
							join sucursales s on p.sucursal_id=s.id  
							join categorias c on p.categoria_id = c.id 
							where p.status=".DISPONIBLE."
							and p.codigo  ='".$codigo."'
							limit 1");
	}
	
	
	//Funcion que devuelve los productos que tienen estatus 3 - DEVUELTO
	function getProductosDevueltos($dato)
	{
		$query='';
		/*
		if($dato['sucursal']=='')
		{
			$query.=' and s.id = '.$dato['user']['sucursal_id'];
		}
			*/
		if($dato['sucursal'] && $dato['sucursal']!='0')
		{
			$query.=' and s.id = '.$dato['sucursal'];
		}

		if($dato['categoria'] && $dato['categoria']!='')
		{
			$query.=' and c.id = '.$dato['categoria'];
		}
			
		if(($dato['fecha_e'] && $dato['fecha_e']!=''))
		{
			$dato['fecha_e'] = $this->fecha_parseada($dato['fecha_e']);
			$query.=' and ds.fecha_entrada  like("%'.$dato['fecha_e'].'%")';
		}

		if($dato['producto']&& $dato['producto']!='')
		{
			$query.='  and p.nombre like("%'.$dato['producto'].'%")  ';
		}

		if(($dato['codigo'])&& $dato['codigo']!='')
		{
			$query.= ' and p.codigo="'.$dato['codigo'].'"';
		}
		
		return $this->db->query("select p.codigo,p.nombre,p.status,s.nombre as sucursal ,c.categoria ,ds.fecha_entrada
									from productos p 
									join sucursales s on p.sucursal_id=s.id  
									join categorias c on p.categoria_id = c.id 
									join detalles_solicitud ds on ds.codigo_producto= p.codigo
									where ds.proceso_devol='".P_TERMINADO."'
									and ds.proceso_mante='".P_PENDIENTE."' 
									and ds.f_mante_entrada  in('0000-00-00 00:00:00')
									and p.status=".DEVUELTO.$query.' order by ds.fecha_entrada asc');
								
						
	
	}
	
	function getProductosInfoDevueltos($codigo)
	{
	return $this->db->query("select p.codigo,p.nombre,p.descripcion,p.status,s.nombre as sucursal ,c.categoria ,cl.nombre cliente,cl.telefono,cl.celular,ds.fecha_entrada,ds.fecha_promesa,ds.fecha_salida,DATEDIFF(ds.fecha_entrada,ds.fecha_promesa) dias,sol.created_by,sol.updated_by
							from productos p 
							join sucursales s on p.sucursal_id=s.id  
							join categorias c on p.categoria_id = c.id 
							join detalles_solicitud ds on ds.codigo_producto= p.codigo
							join solicitudes sol on sol.id = ds.solicitud_id
							join clientes cl on cl.id = sol.cliente_id
							where p.status=".DEVUELTO."
							and p.codigo  ='".$codigo."'
							and ds.proceso_devol='".P_TERMINADO."'
							and ds.proceso_mante='".P_PENDIENTE."'
							and ds.f_mante_entrada  in('0000-00-00 00:00:00')	
							limit 1");
	}
	function getProductosInfoRenta($codigo)
	{
		return $this->db->query("select p.codigo,p.nombre,p.descripcion,p.status,s.nombre as sucursal 
								,c.categoria ,cl.nombre cliente,cl.telefono,cl.celular
								,ds.fecha_entrada,ds.fecha_promesa,ds.fecha_salida
								-- ,(IF( DATEDIFF(CURDATE(),ds.fecha_promesa) >=0,DATEDIFF(CURDATE(),ds.fecha_promesa),0) + ds.dias_retraso) dias
								, IF( DATEDIFF(CURDATE(),ds.fecha_promesa) >=0,DATEDIFF(CURDATE(),ds.fecha_promesa),0) AS dias
								,sol.created_by,sol.updated_by
							from productos p 
							join sucursales s on p.sucursal_id=s.id  
							join categorias c on p.categoria_id = c.id 
							join detalles_solicitud ds on ds.codigo_producto= p.codigo
							join solicitudes sol on sol.id = ds.solicitud_id
							join clientes cl on cl.id = sol.cliente_id
							where p.status=".EN_RENTA."
							and p.codigo  ='".$codigo."'
							and ds.proceso_devol='".P_PENDIENTE."'
							and ds.proceso_mante='".P_PENDIENTE."'
							and ds.fecha_entrada  in('0000-00-00 00:00:00')	
							limit 1");
							
							
	}
	function getProductosInfoRetraso($codigo)
	{
		return $this->db->query("select p.codigo,p.nombre,p.descripcion,p.status,s.nombre as sucursal 
							,c.categoria ,cl.nombre cliente,cl.telefono,cl.celular,ds.fecha_entrada
							-- ,(IF( DATEDIFF(CURDATE(),ds.fecha_promesa) >=0,DATEDIFF(CURDATE(),ds.fecha_promesa),0) + ds.dias_retraso) dias
							, IF( DATEDIFF(CURDATE(),ds.fecha_promesa) >=0,DATEDIFF(CURDATE(),ds.fecha_promesa),0) AS dias
							,sol.created_by,sol.updated_by
							from productos p 
							join sucursales s on p.sucursal_id=s.id  
							join categorias c on p.categoria_id = c.id 
							join detalles_solicitud ds on ds.codigo_producto= p.codigo
							join solicitudes sol on sol.id = ds.solicitud_id
							join clientes cl on cl.id = sol.cliente_id
							where p.status=".EN_RENTA."
							and DATEDIFF(CURDATE(),ds.fecha_promesa) >0
							and p.codigo  ='".$codigo."'
							and ds.proceso_devol='".P_PENDIENTE."'
							and ds.proceso_mante='".P_PENDIENTE."'
							and ds.fecha_entrada  in('0000-00-00 00:00:00')	
							limit 1");
							
							
	}
	function getProductosRenta($dato)
	{
		$query='';
		/*
		if($dato['sucursal']=='')
		{
			$query.=' and s.id = '.$dato['user']['sucursal_id'];
		}
			*/
		if($dato['sucursal'] && $dato['sucursal']!='0')
		{
			$query.=' and s.id = '.$dato['sucursal'];
		}

		if($dato['categoria'] && $dato['categoria']!='')
		{
			$query.=' and c.id = '.$dato['categoria'];
		}
			
		if(($dato['fecha_r'] && $dato['fecha_r']!=''))
		{
			$dato['fecha_r'] = $this->fecha_parseada($dato['fecha_r']);
			$query.=' and ds.fecha_salida like("%'.$dato['fecha_r'].'%")';
		}

		if($dato['producto']&& $dato['producto']!='')
		{
			$query.='  and p.nombre like("%'.$dato['producto'].'%")  ';
		}

		if(($dato['codigo'])&& $dato['codigo']!='')
		{
			$query.= ' and p.codigo="'.$dato['codigo'].'"';
		}
		
		return $this->db->query("select p.codigo,p.nombre,p.status,s.nombre as sucursal ,c.categoria ,ds.fecha_salida,ds.fecha_promesa
									from productos p 
									join sucursales s on p.sucursal_id=s.id  
									join categorias c on p.categoria_id = c.id 
									join detalles_solicitud ds on ds.codigo_producto= p.codigo
									where ds.proceso_devol='".P_PENDIENTE."'
									and ds.proceso_mante='".P_PENDIENTE."' 
									and ds.fecha_entrada in('0000-00-00 00:00:00') 
									and p.status=".EN_RENTA.$query.' order by ds.fecha_salida asc');
	}
	
	
	
	function getProductosRetrasados($dato)
	{
		$query = '';
		$dias  = '';
		/*
		if($dato['sucursal']=='')
		{
			$query.=' and s.id = '.$dato['user']['sucursal_id'];
		}
			*/
		if($dato['sucursal'] && $dato['sucursal']!='0')
		{
			$query.=' and s.id = '.$dato['sucursal'];
		}

		if($dato['categoria'] && $dato['categoria']!='')
		{
			$query.=' and c.id = '.$dato['categoria'];
		}
			
		if(($dato['fecha_p'] && $dato['fecha_p']!=''))
		{
		$dato['fecha_p'] = $this->fecha_parseada($dato['fecha_p']);
			
			$query.=' and ds.fecha_promesa like("%'.$dato['fecha_p'].'%")';
		}

		if($dato['producto']&& $dato['producto']!='')
		{
			$query.='  and p.nombre like("%'.$dato['producto'].'%")  ';
		}

		if(($dato['codigo'])&& $dato['codigo']!='')
		{
			$query.= ' and p.codigo="'.$dato['codigo'].'"';
		}
		if(($dato['dias'])&& $dato['dias']!='')
		{
			$dias.= "   or IF( DATEDIFF(CURDATE(),ds.fecha_promesa) >=0,DATEDIFF(CURDATE(),ds.fecha_promesa),0) =".$dato['dias'].") ";
		}
		
		return $this->db->query("select p.codigo,p.nombre,p.status,s.nombre as sucursal ,c.categoria 
								,ds.fecha_salida,ds.fecha_promesa
								-- ,(IF( DATEDIFF(CURDATE(),ds.fecha_promesa) >=0,DATEDIFF(CURDATE(),ds.fecha_promesa),0) + ds.dias_retraso) dias
									, IF( DATEDIFF(CURDATE(),ds.fecha_promesa) >=0,DATEDIFF(CURDATE(),ds.fecha_promesa),0) AS dias
									from productos p 
									join sucursales s on p.sucursal_id=s.id  
									join categorias c on p.categoria_id = c.id 
									join detalles_solicitud ds on ds.codigo_producto= p.codigo
									where ds.proceso_devol='".P_PENDIENTE."'
									and (
										   (IF( DATEDIFF(CURDATE(),ds.fecha_promesa) >=0,DATEDIFF(CURDATE(),ds.fecha_promesa),0) >0)".$dias."
										
										)
									and ds.proceso_mante='".P_PENDIENTE."' 
									and ds.fecha_entrada in('0000-00-00 00:00:00') 
									and p.status=".EN_RENTA.$query.' order by ds.fecha_promesa asc');
	}
	
	
	function getProductosMantenimiento($dato)
	{
		$query='';
		if($dato['sucursal']=='')
		{
			$query.=' and s.id = '.$dato['user']['sucursal_id'];
		}
			
		if($dato['sucursal'] && $dato['sucursal']!='0')
		{
			$query.=' and s.id = '.$dato['sucursal'];
		}

		if($dato['categoria'] && $dato['categoria']!='')
		{
			$query.=' and c.id = '.$dato['categoria'];
		}
			
		if(($dato['fecha_m'] && $dato['fecha_m']!=''))
		{

			$dato['fecha_m'] = $this->fecha_parseada($dato['fecha_m']);
			
			$query.=' and ds.f_mante_entrada like("%'.$dato['fecha_m'].'%")';
		}

		if($dato['producto']&& $dato['producto']!='')
		{
			$query.='  and p.nombre like("%'.$dato['producto'].'%")  ';
		}

		if(($dato['codigo'])&& $dato['codigo']!='')
		{
			$query.= ' and p.codigo="'.$dato['codigo'].'"';
		}
		
		return $this->db->query("select p.codigo,p.nombre,p.status,s.nombre as sucursal ,c.categoria ,ds.fecha_entrada,ds.f_mante_entrada 
									from productos p 
									join sucursales s on p.sucursal_id=s.id  
									join categorias c on p.categoria_id = c.id 
									join detalles_solicitud ds on ds.codigo_producto= p.codigo
									where ds.proceso_devol='".P_TERMINADO."'
									and ds.proceso_mante='".P_PENDIENTE."' 
									and ds.f_mante_salida in('0000-00-00 00:00:00') 
									and ds.f_mante_entrada not in('0000-00-00 00:00:00')
									and p.status=".EN_MANTENIMIENTO.$query.' order by ds.f_mante_entrada asc');
	
	}
	
	function getProductosInfoMante($codigo)
	{
	return $this->db->query("select p.codigo,p.nombre,p.status,p.descripcion,s.nombre as sucursal ,c.categoria ,cl.nombre cliente,cl.telefono,cl.celular,ds.fecha_entrada,ds.f_mante_entrada 
							from productos p 
							join sucursales s on p.sucursal_id=s.id  
							join categorias c on p.categoria_id = c.id 
							join detalles_solicitud ds on ds.codigo_producto= p.codigo
							join solicitudes sol on sol.id = ds.solicitud_id
							join clientes cl on cl.id = sol.cliente_id
							where ds.proceso_devol='".P_TERMINADO."'
							and p.codigo  ='".$codigo."'
							and ds.proceso_mante='".P_PENDIENTE."' 
							and ds.f_mante_salida in('0000-00-00 00:00:00') 
							and ds.f_mante_entrada not in('0000-00-00 00:00:00')
							and p.status=".EN_MANTENIMIENTO." limit 1");
	}
	
	function getSolicitudId($producto)
	{

		$query= $this->db->query("select ds.solicitud_id from detalles_solicitud ds 
								where ds.codigo_producto= '".$producto['codigo']."'
								 and ds.proceso_devol ='".P_PENDIENTE."'
								 and ds.proceso_mante ='".P_PENDIENTE."'
								 order by ds.created desc limit 1");
		$query= $query->row();
		return $query->solicitud_id;
	}

	function countProd_by_SolId($solicitud_id)
	{
		$query= $this->db->query("select id from detalles_solicitud where solicitud_id= ".$solicitud_id);
		return $query->num_rows();
	}
	
	function countProd_devueltos($solicitud_id)
	{
	
		$query= $this->db->query('select ds.codigo_producto codigo from detalles_solicitud ds  where ds.solicitud_id ='.$solicitud_id.' and ds.status ='.DEVUELTO);
		return $query->num_rows();
	
	}
	
	function updSolicitud($solicitud_id)
	{
		$user = $this->native_session->userdata('user');
		$data['updated_by'] = $user['username'];
		$data['status'] = CERRADA;
		$data['updated'] = date("Y-m-d H:i:s");
		
		$this->db->update('solicitudes', $data, array('id' => $solicitud_id));
		return true;
	}
	
	function getSolicitudes()
	{
		$today = date("Y-m-d");
		return $this->db->query("select s.id,cl.nombre,cl.telefono,cl.celular
				from solicitudes s 
				join detalles_solicitud ds on ds.solicitud_id = s.id  
				join clientes cl on s.cliente_id = cl.id where ds.fecha_promesa <='".$today."' and ds.status=2 group by ds.solicitud_id order by ds.fecha_promesa asc");
	}
	
	function updProducto($producto,$status){
		$updated = date("Y-m-d H:i:s");
		$this->db->query("update productos set status = ".$status.", sucursal_id =".$producto['sucursal_id'].", updated ='".$updated."' where codigo='".$producto['codigo']."'");
		return true;
	}
	
	function updDetProducto($producto,$status)
	{
		$updated = date("Y-m-d H:i:s");
		 $user = $this->native_session->userdata('user');
		$this->db->query("update detalles_solicitud ds 
							set ds.status = ".$status.", ds.fecha_entrada = '".$updated."'
							, ds.updated ='".$updated."' 
							,ds.updated_by='".$user['username']."' 
							, ds.proceso_devol='".P_TERMINADO."' 
							where ds.codigo_producto='".$producto['codigo']."' 
							and ds.proceso_devol='".P_PENDIENTE."'");
		return true;
	}
	
	
	
	function updDetMantProducto($producto)
	{
		$updated = date("Y-m-d H:i:s");
		$this->db->query("update detalles_solicitud ds
							set ds.f_mante_entrada ='".$updated."' , ds.updated = '".$updated."'
							where ds.codigo_producto ='".$producto['codigo']."' 
							and ds.proceso_devol ='".P_TERMINADO."'
							and ds.proceso_mante='".P_PENDIENTE."'
							and ds.status=".DEVUELTO."
							and ds.fecha_entrada not in('0000-00-00 00:00:00') limit 1");
		return true;
	}
	
	function updDetMantSalProducto($producto)
	{
		$updated = date("Y-m-d H:i:s");
		$this->db->query("update detalles_solicitud ds
							set ds.f_mante_salida ='".$updated."' , ds.updated = '".$updated."' , ds.proceso_mante='".P_TERMINADO."'
							where ds.codigo_producto ='".$producto['codigo']."' 
							and ds.proceso_devol ='".P_TERMINADO."'
							and ds.proceso_mante='".P_PENDIENTE."'
							and ds.status=".DEVUELTO."
							and ds.f_mante_salida in('0000-00-00 00:00:00') limit 1");
		return true;
	}
	
	function getProductos_bySolId($solicitud_id)
	{	
		
		return $this->db->query("select p.codigo,c.categoria, p.nombre,p.descripcion,ds.fecha_salida,ds.fecha_promesa,ds.envio,ds.domicilio from productos p join detalles_solicitud ds on ds.codigo_producto = p.codigo join categorias c on p.categoria_id = c.id where  ds.solicitud_id = ".$solicitud_id." order by ds.fecha_promesa,ds.status asc");
	}
	
	function getInfoCliente_bySolId($solicitud_id)
	{
		return $this->db->query("select  c.nombre,c.telefono,c.celular,c.direccion,c.email,c.id_type,c.id_num from solicitudes s join clientes c on s.cliente_id=c.id where s.id=".$solicitud_id);
	}
	
	function fecha_parseada($fecha)
	{
				$parseador = split('-',$fecha);
				$anio = $parseador[2];
				$mes  = $parseador[1];
				$dia  = $parseador[0];
				return $fecha = $anio."-".$mes."-".$dia;
	}
}
?>