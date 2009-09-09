<?php
class Entrada extends Model{
	
	function __construct(){
		parent::Model();
			
	}
	function getStatusProducto($codigo)
	{
		$query = $this->db->query("select p.status from productos p where p.codigo='".$codigo."'");
		if($query->num_rows()>0)
		{
		$query = $query->row();
		return $query->status;
		}else
		{
			return "-1";
		}
	}
	
	
	function getProductosRentados()
	{
	$where .= " and ds.proceso_devol='".P_PENDIENTE."'
						and ds.proceso_mante='".P_PENDIENTE."' 
						and ds.fecha_entrada in('0000-00-00 00:00:00')";
						
	return $this->db->query('select p.codigo,p.nombre,p.descripcion,p.status,s.nombre sucursal,c.categoria ,ds.fecha_salida,ds.fecha_promesa,ds.fecha_entrada  
									from productos p 
									join sucursales s on s.id = p.sucursal_id  
									join categorias c on p.categoria_id = c.id 
									join detalles_solicitud ds on ds.codigo_producto = p.codigo 
									where p.status ='.EN_RENTA.$where.' limit 1'); 
	
	}
	
	
	function getProductoInfo($codigo,$status){
		$where= " and p.codigo ='".$codigo."'";
		//$where=" and (p.codigo ='".$codigo."' or p.nombre like'%".$codigo."%') ";
		return $this->db->query("select p.codigo,p.nombre,p.descripcion,p.status,s.nombre sucursal
									,''  fecha_salida,'' fecha_promesa,'' fecha_entrada  
                                    from productos p 
                                    join sucursales s on s.id = p.sucursal_id  
                                    where p.status = ".$status.$where. ' limit 1 ');
	}
	
	function getProductoUser($codigo,$status){
		$where= " and p.codigo ='".$codigo."'";
		 	//$where=" and (p.codigo ='".$codigo."' or p.nombre like'%".$codigo."%') ";
		 switch($status){
			case EN_RENTA:
			$where .= " and ds.proceso_devol='".P_PENDIENTE."'
						and ds.proceso_mante='".P_PENDIENTE."' 
						and ds.fecha_entrada in('0000-00-00 00:00:00')";
			break;
			case DEVUELTO:
			$where .= " and ds.proceso_devol='".P_TERMINADO."'
						and ds.proceso_mante='".P_PENDIENTE."'
						and ds.f_mante_entrada  in ('0000-00-00 00:00:00')";
			break;
			case EN_MANTENIMIENTO:
			$where .= " and ds.proceso_devol='".P_TERMINADO."'
						and ds.proceso_mante='".P_PENDIENTE."' 
						and ds.f_mante_entrada not in('0000-00-00 00:00:00')
						and ds.f_mante_salida  in ('0000-00-00 00:00:00')";
						
			break;
			}						
		 return $this->db->query('select p.codigo,p.nombre,p.descripcion,p.status,s.nombre sucursal,c.categoria ,ds.fecha_salida,ds.fecha_promesa,ds.fecha_entrada  
									from productos p 
									join sucursales s on s.id = p.sucursal_id  
									join categorias c on p.categoria_id = c.id 
									join detalles_solicitud ds on ds.codigo_producto = p.codigo 
									where p.status ='.$status.$where.' limit 1'); 	
	}
	
	function getProductoAdmin($codigo,$status){
		$where= " and p.codigo ='".$codigo."'";
		 	//$where=" and (p.codigo ='".$codigo."' or p.nombre like'%".$codigo."%') ";
		 switch($status){
			case EN_RENTA:
			$where .= " and ds.proceso_devol='".P_PENDIENTE."'
						and ds.proceso_mante='".P_PENDIENTE."' 
						and ds.fecha_entrada in('0000-00-00 00:00:00')";
			break;
			case DEVUELTO:
			$where .= " and ds.proceso_devol='".P_TERMINADO."'
						and ds.proceso_mante='".P_PENDIENTE."'
						and ds.f_mante_entrada  in ('0000-00-00 00:00:00')";
			break;
			case EN_MANTENIMIENTO:
			$where .= " and ds.proceso_devol='".P_TERMINADO."'
						and ds.proceso_mante='".P_PENDIENTE."' 
						and ds.f_mante_entrada not in('0000-00-00 00:00:00')
						and ds.f_mante_salida  in ('0000-00-00 00:00:00')";
						
			break;
			}						
		 return $this->db->query('select p.codigo,p.nombre,p.descripcion,p.status,s.nombre sucursal,c.categoria ,ds.fecha_salida,ds.fecha_promesa,ds.fecha_entrada  
									from productos p 
									join sucursales s on s.id = p.sucursal_id  
									join categorias c on p.categoria_id = c.id 
									join detalles_solicitud ds on ds.codigo_producto = p.codigo 
									where p.status ='.$status.$where.' limit 1'); 	
	}
	
	function updProducto($producto,$status){
		$updated = date("Y-m-d H:i:s");
		$this->db->query("update productos set status = ".$status.", sucursal_id =".$producto['sucursal_id'].", updated ='".$updated."' where codigo='".$producto['codigo']."'");
		return true;
	}
	
	/*
	function updDetProducto($detalles)
	{
		$updated = date("Y-m-d H:i:s");
		$this->db->query("update detalles_solicitud set status = ".$detalles['status'].", fecha_entrada = '".$updated."', updated ='".$updated."' where codigo_producto='".$producto['codigo']."'");
		return true;
	}
	*/
	
	function updDetProducto($producto,$status){
		$updated = date("Y-m-d H:i:s");
		 $user = $this->native_session->userdata('user');
		$this->db->query("update detalles_solicitud ds
							set ds.status = ".$status.", ds.fecha_entrada = '".$updated."', ds.updated ='".$updated."'
							,ds.updated_by='".$user['username']."' 
							, ds.proceso_devol='".P_TERMINADO."' 
							where ds.codigo_producto='".$producto['codigo']."' and ds.proceso_devol='".P_PENDIENTE."'");
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
	//Actualizando el status del producto por la disponibilidad
	function updDetDispProducto($producto)
	{
		$updated = date("Y-m-d H:i:s");
		$this->db->query("update detalles_solicitud ds
							set ds.f_mante_salida ='".$updated."' , ds.updated = '".$updated."', ds.proceso_mante ='".P_TERMINADO."'
							where ds.codigo_producto ='".$producto['codigo']."' 
							and ds.proceso_devol ='".P_TERMINADO."'
							and ds.proceso_mante='".P_PENDIENTE."'
							and ds.status=".DEVUELTO."
							and ds.fecha_entrada not in('0000-00-00 00:00:00')
							and ds.f_mante_entrada not in('0000-00-00 00:00:00')	limit 1");
		return true;
	}
	
	function getSolicitudId($codigo_producto)
	{

		$query= $this->db->query("select ds.solicitud_id from detalles_solicitud ds 
								where ds.codigo_producto= '".$codigo_producto."'
								 and ds.proceso_devol ='".P_PENDIENTE."'
								 and ds.proceso_mante ='".P_PENDIENTE."'
								 order by ds.created desc limit 1
								");
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
		//$query= $this->db->query('select p.codigo from productos p join detalles_solicitud ds on ds.codigo_producto = p.codigo where ds.solicitud_id ='.$solicitud_id.' and ds.status = 3');
		$query= $this->db->query('select ds.codigo_producto codigo from detalles_solicitud ds  where ds.solicitud_id ='.$solicitud_id.' and ds.status ='.DEVUELTO);
		return $query->num_rows();
	
	}
	
	function updSolicitud($solicitud_id)
	{
		$data['status'] = CERRADA;
		$data['updated'] = date("Y-m-d H:i:s");
		$this->db->update('solicitudes', $data, array('id' => $solicitud_id));
		return true;
	}
	
}
?>