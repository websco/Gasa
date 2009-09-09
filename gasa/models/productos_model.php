<?php
class Productos_model
 extends Model{

	function __construct(){
		parent::Model();
		$this->tabla = "productos";
	}

	function insertar($data)
    {
       $data['created'] = date("Y-m-d H:i:s");
       $data['updated'] = date("Y-m-d H:i:s");
       $this->db->insert($this->tabla, $data);
       return true;
    }

    function actualizar($data,$codigo)
    { 
      $data['updated']    = date("Y-m-d H:i:s");

      $this->db->update($this->tabla, $data, array('codigo' => $codigo));    
      return true;      
    }
	
	function actualizar_ds($data,$id)
	{
	 
	  $user = $this->native_session->userdata('user');
      $data['updated']    = date("Y-m-d H:i:s");
	  $data['updated_by'] = $user['username'];
      $this->db->update("detalles_solicitud", $data, array('id' => $id));    
      return true;      
    
	}
	function getProductosRenta($dato)
	{
		$query='';
		
		if($dato['sucursal']=='')
		{
			$query.=' AND suc.id = '.$dato['user']['sucursal_id'];
		}
			
		if($dato['sucursal'] && $dato['sucursal']!='0')
		{
			$query.=' AND suc.id = '.$dato['sucursal'];
		}

		if($dato['categoria'] && $dato['categoria']!='')
		{
			$query.=' AND cat.id = '.$dato['categoria'];
		}
		if(($dato['status'] && $dato['status']!='' && $dato['status']!=NULL))
		{
			if($dato['status']==5){
			$query.=' AND p.status = 0';
			}else{
				$query.=' AND p.status = '.$dato['status'];
			}
		}
		if($dato['producto']&& $dato['producto']!='')
		{
			$query.='  AND p.nombre LIKE("%'.$dato['producto'].'%")  ';
			
		}

		if(($dato['codigo'])&& $dato['codigo']!='')
		{
			$query.= ' AND p.codigo = "'.$dato['codigo'].'"';
			
		}
		/*
				return $this->db->query("
		SELECT 
			  p.codigo 		AS codigo
			, p.nombre      AS nombre
			, p.status      AS status
			, cat.categoria AS categoria
			, suc.nombre    AS sucursal
			, IFNULL(
					(
					NULL
					)
					,0
				) AS dias
        FROM productos AS p 
        INNER JOIN sucursales AS suc 
			ON suc.id  = p.sucursal_id  
        INNER JOIN categorias AS cat 
			ON cat.id  = p.categoria_id
        WHERE 1 = 1 ".$query." 
		ORDER BY p.codigo ASC");*/
		
		return $this->db->query("
		SELECT 
			  p.codigo 		AS codigo
			, p.nombre      AS nombre
			, p.status      AS status
			, cat.categoria AS categoria
			, suc.nombre    AS sucursal
			, IFNULL(
					(
					SELECT 
						-- (IF( DATEDIFF(CURDATE(),ds.fecha_promesa) >=0,DATEDIFF(CURDATE(),ds.fecha_promesa),0) + ds.dias_retraso) AS dias
						IF( DATEDIFF(CURDATE(),ds.fecha_promesa) >=0,DATEDIFF(CURDATE(),ds.fecha_promesa),0) AS dias
						FROM productos AS ps 
						INNER JOIN sucursales AS s 
							ON  ps.sucursal_id = s.id  
						INNER JOIN categorias AS c 
							ON  ps.categoria_id = c.id 
						INNER JOIN detalles_solicitud  AS ds 
							ON ds.codigo_producto = ps.codigo
						WHERE ps.codigo = p.codigo 
							AND ds.proceso_devol = '".P_PENDIENTE."'
							AND ds.proceso_mante = '".P_PENDIENTE."' 
							AND ds.fecha_entrada IN('0000-00-00 00:00:00')
					),0
				) AS dias
        FROM productos AS p 
        INNER JOIN sucursales AS suc 
			ON suc.id  = p.sucursal_id  
        INNER JOIN categorias AS cat 
			ON cat.id  = p.categoria_id
        WHERE 1 = 1 ".$query." 
		ORDER BY p.codigo ASC");
		
		
	}
	
	
	function getProductoInfoRentado($codigo)
	{
		return $this->db->query("
		SELECT
			  ds.id             AS id 
			, p.codigo 			AS codigo
			, p.nombre 			AS nombre
			, p.descripcion 	AS descripcion
			, p.status 			AS status
			, s.nombre 			AS sucursal 
			, c.categoria 		AS categoria
			, cl.nombre 		AS cliente
			, cl.telefono 		AS telefono
			, cl.celular 		AS celular
			, ds.fecha_entrada 	AS fecha_entrada
			, ds.fecha_promesa 	AS fecha_promesa
			, ds.fecha_salida 	AS fecha_salida
			-- , (IF( DATEDIFF(CURDATE(),ds.fecha_promesa) >=0,DATEDIFF(CURDATE(),ds.fecha_promesa),0) + ds.dias_retraso) AS dias
			, IF( DATEDIFF(CURDATE(),ds.fecha_promesa) >=0,DATEDIFF(CURDATE(),ds.fecha_promesa),0) AS dias
			, sol.created_by 	AS created_by
			, sol.updated_by	AS updated_by
		FROM productos AS p 
			INNER JOIN sucursales AS s 
				ON p.sucursal_id  = s.id  
			INNER JOIN categorias AS c
				ON p.categoria_id = c.id 
			INNER JOIN detalles_solicitud AS ds
				ON ds.codigo_producto = p.codigo
			INNER JOIN solicitudes AS sol 
				ON sol.id = ds.solicitud_id
			INNER JOIN clientes AS cl
				ON cl.id = sol.cliente_id
		WHERE p.status =".EN_RENTA."
			AND p.codigo  = '".$codigo."'
			AND ds.proceso_devol= '".P_PENDIENTE."'
			AND ds.proceso_mante= '".P_PENDIENTE."'
			AND ds.fecha_entrada  IN('0000-00-00 00:00:00')	
			LIMIT 1");
							
							
	}
	
	function getProductoInfo($codigo)
	{
		$where= " WHERE p.codigo = '".$codigo."'";
		$where .= " LIMIT 1";
		return $this->db->query('
		SELECT
			  p.codigo		AS codigo
			, p.nombre		AS nombre
			, p.descripcion	AS descripcion
			, p.status		AS status
			, c.categoria 	AS categoria
			, s.nombre 		AS sucursal
		FROM productos AS p 
		INNER JOIN sucursales AS s 
			ON s.id = p.sucursal_id  
		INNER JOIN categorias AS c
			ON c.id = p.categoria_id '.$where); 	
	
	}
	
	function search($codigo){
		return $this->db->query("
		SELECT 
			  p.codigo		AS codigo
			, p.nombre		AS nombre
			, s.nombre 		AS sucursal
			, s.id     		AS sucursal_id
			, p.status 		AS status
			, p.descripcion	AS descripcion
		FROM productos AS p 
		INNER JOIN sucursales AS s
			ON p.sucursal_id = s.id 
		WHERE (p.codigo = '".$codigo."' OR p.nombre LIKE('%".$codigo."%')) 
		AND p.status = ".DISPONIBLE);
	}
	function getInfo($codigo){
	    
		$this->db->select('codigo,nombre, sucursal_id as sucursal,status,descripcion');
		$this->db->where("codigo ='".$codigo."'" );
		return $this->db->get('productos');
	}
	function getDireCliente($cliente_id)
	{
		$this->db->select("direccion");
		$query = $this->db->get_where("clientes",array('id' => $cliente_id));
		$query= $query->row();
		return $query->direccion;
		
	}
	function procesar_orden($cliente_id=null ,$carrito = null,$fechas = null){
		//validamos que los datos hayan llegado y sean del tipo correcto
		if($cliente_id == null && $carrito == null){return null;}
	        if( !is_array($carrito)){return null;}
			 $user = $this->native_session->userdata('user');
	         
	         $d_solicitud['created'] = date("Y-m-d H:i:s");
             $d_solicitud['updated'] = date("Y-m-d H:i:s");
			 $d_solicitud['status']  = 0;
			 $d_solicitud['cliente_id']  = $cliente_id;
			 $d_solicitud['created_by']  = $user['username'];
			 $d_solicitud['updated_by']  = $user['username'];
			 
			 $this->db->insert('solicitudes',$d_solicitud);
		
  		$solicitud_id = $this->db->insert_id();
  		$direccion_cliente = $this->getDireCliente($cliente_id);
  		foreach($carrito as $item){
  		        $entrada['solicitud_id'] = $solicitud_id;
  		        $entrada['codigo_producto'] = $item['codigo'];
  		        $entrada['fecha_salida']= date('Y-m-d H:i:s');
                $entrada['fecha_promesa']= $item['fecha'];
                $entrada['fecha_entrada']= 'null';
                $entrada['status']= EN_RENTA;
				if($item['direccion']==''){
                $entrada['domicilio']= $direccion_cliente;
				}else{
					$entrada['domicilio']= $item['direccion'];
				}
				$entrada['envio']= $item['envio'];
                $entrada['created']= date("Y-m-d H:i:s");
                $entrada['updated']= date("Y-m-d H:i:s");
				$entrada['created_by']  = $user['username'];
			    $entrada['updated_by']  = $user['username'];
			$this->db->insert('detalles_solicitud',$entrada);
			
			$update['status']= EN_RENTA;
			$update['updated'] = date("Y-m-d H:i:s");
			$this->db->where('codigo', $item['codigo']);
			$this->db->update('productos',$update);
			
		}
	        
	      return $solicitud_id;  

	}
}
?>
