<?php
class Cron extends Model{
	
	function __construct(){
		parent::Model();
			
	}


	function getProductosRetrasadosEmail()
	{
		return $query = $this->db->query("
			select u.username,u.email,p.codigo,p.nombre,s.nombre as sucursal ,c.categoria 
			,ds.fecha_salida,ds.fecha_promesa,DATEDIFF(CURDATE(),ds.fecha_promesa) dias
			from productos p 
			join sucursales s on p.sucursal_id=s.id  
			join categorias c on p.categoria_id = c.id 
			join detalles_solicitud ds on ds.codigo_producto= p.codigo
			join users u on s.id = u.sucursal
			where ds.proceso_devol='p'
			and (
					(DATEDIFF(CURDATE(),ds.fecha_promesa) >0)
										
				)
			and ds.proceso_mante='p' 
			and ds.fecha_entrada in('0000-00-00 00:00:00') 
			and p.status=2 
			order by u.username,ds.fecha_promesa   asc"
		);
		
	}
	
	
	
	
}
?>