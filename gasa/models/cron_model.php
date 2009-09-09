<?php
class Cron_model extends Model{
	
	function __construct(){
		parent::Model();
			
	}


	function getProductosRetrasadosEmail()
	{
		return $query = $this->db->query("
			select p.codigo,p.nombre,s.id sucursal_id,s.nombre as sucursal ,c.categoria 
			,ds.fecha_salida,ds.fecha_promesa,DATEDIFF(CURDATE(),ds.fecha_promesa) dias
			from productos p 
			join sucursales s on p.sucursal_id=s.id  
			join categorias c on p.categoria_id = c.id 
			join detalles_solicitud ds on ds.codigo_producto= p.codigo
			where ds.proceso_devol='p'
			and (
					(DATEDIFF(CURDATE(),ds.fecha_promesa) >0)
										
				)
			and ds.proceso_mante='p' 
			and ds.fecha_entrada in('0000-00-00 00:00:00') 
			and p.status=2 
			order by s.nombre,ds.fecha_promesa   asc
		");
		
	}
	function getUsuariosSucursal($sucursal_id)
	{
		return $query = $this->db->query("
			select u.username,u.email,s.nombre as sucursal 
			from  users u 
			join sucursales s on s.id = u.sucursal
			where u.status =1
			and s.id =".$sucursal_id." 
			order by s.nombre,u.username  asc
		");
	
	
	}
	
	function getProductosARetrasarEmail()
	{
		return $query = $this->db->query("
			select p.codigo,p.nombre,s.nombre as sucursal,s.direccion,s.telefono,cl.nombre cliente,cl.email
			,ds.fecha_salida,ds.fecha_promesa,DATEDIFF(ds.fecha_promesa,CURDATE()) dias
			from productos p 
			join sucursales s on p.sucursal_id=s.id  
			join detalles_solicitud ds on ds.codigo_producto= p.codigo
			join solicitudes sol on sol.id= ds.solicitud_id
			join clientes    cl  on cl.id = sol.cliente_id
			where ds.proceso_devol='p'
			and (
					(DATEDIFF(ds.fecha_promesa,CURDATE()) <3) and (DATEDIFF(ds.fecha_promesa,CURDATE()) >0)
										
			     )
			and ds.proceso_mante='p' 
			and ds.fecha_entrada in('0000-00-00 00:00:00') 
			and p.status=2 
			and cl.email !=''
			order by cl.nombre,ds.fecha_promesa   asc
		");
		
	}
	
	
	
}
?>