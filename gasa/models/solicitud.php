<?php
class Solicitud extends Model{
	
	function __construct(){
		parent::Model();
		
	}

	function getSolicitudes()
	{
		$today = date("Y-m-d");
		return $this->db->query("select s.id,cl.nombre,cl.telefono,cl.celular
				from solicitudes s 
				join detalles_solicitud ds on ds.solicitud_id = s.id  
				join clientes cl on s.cliente_id = cl.id where ds.fecha_promesa <='".$today."' and ds.status=2 group by ds.solicitud_id order by ds.fecha_promesa asc");
	}
	
	function getProductos_bySolId($solicitud_id)
	{	
		
		return $this->db->query("select p.codigo,c.categoria, p.nombre,p.descripcion,ds.fecha_salida,ds.fecha_promesa
,ds.envio,ds.domicilio,DATEDIFF(ds.fecha_promesa,ds.fecha_salida) ndias,s.direccion,s.telefono
from productos p 
join detalles_solicitud ds on ds.codigo_producto = p.codigo 
join categorias c on p.categoria_id = c.id 
join users u on u.username =ds.created_by
join sucursales s on u.sucursal = s.id
where  ds.solicitud_id = ".$solicitud_id."
order by ds.fecha_promesa,ds.status asc");
	}
	function getInfoCliente_bySolId($solicitud_id)
	{
		return $this->db->query("select  c.nombre,c.telefono,c.celular,c.direccion,c.email,c.id_type,c.id_num from solicitudes s join clientes c on s.cliente_id=c.id where s.id=".$solicitud_id);
	}
}
?>