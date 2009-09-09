<?php
class Filtros_model extends Model{
	
	function __construct(){
		parent::Model();
	}

	function getPrecios($n = 5){
		return $this->db->get('precios',$n,0);
	}
	
	
	function getMarcaOfModelo($modelo){
		$this->db->where('modelo',$modelo);
		$query = $this->db->get('modelos');
		$query = $query->row();
		return $query->id_marca;
		
	}
	function getVehiculoById($pId){
		$this->db->where('id',$pId);
		$item = $this->db->get('seminuevos');
		return $item->row_array();
	}
	
	function filtroMarcas($campos=NULL){
		$where='';
		if(is_array($campos)){
			$where='where 1=1 ';
			foreach($campos as $key=>$value){
				if($value != '%'){
					switch ($key){
						case 'precio':
							$where .= 'and s.precio<="'.$value.'"';	
						break;
						case 'precio_desde':
							$where .= 'and s.precio>="'.$value.'"';	
						break;
						case 'precio_hasta':
							$where .= 'and s.precio<="'.$value.'"';	
						break;
						default:
							$where .= 'and s.'.$key.'="'.$value.'"';
						break;
					}
				}
			}
		}
		return $this->db->query('select m.id,m.marca,count(m.marca) as total from seminuevos s join marcas m on s.marca=m.id  '.$where.' group by m.marca limit 5');
	}
	function filtroModelos($campos=NULL){
		$where='';
		if(is_array($campos)){
			$where='where 1=1 ';
			foreach($campos as $key=>$value){
				if($value != '%'){
					switch ($key){
						case 'precio':
							$where .= 'and s.precio<="'.$value.'"';	
						break;
						case 'precio_desde':
							$where .= 'and s.precio>="'.$value.'"';	
						break;
						case 'precio_hasta':
							$where .= 'and s.precio<="'.$value.'"';	
						break;
						default:
							$where .= 'and s.'.$key.'="'.$value.'"';
						break;
					}
				}
			}
		}
		return $this->db->query('select m.id,m.modelo,count(m.modelo) as total from seminuevos s join modelos m on m.id=s.modelo  '.$where.' group by m.modelo limit 5');
	}
	function filtroCategorias($campos=NULL){
		$where='';
		if(is_array($campos)){
			$where='where 1=1 ';
			foreach($campos as $key=>$value){
				if($value != '%'){
					switch ($key){
						case 'precio':
							$where .= 'and s.precio<="'.$value.'"';	
						break;
						case 'precio_desde':
							$where .= 'and s.precio>="'.$value.'"';	
						break;
						case 'precio_hasta':
							$where .= 'and s.precio<="'.$value.'"';	
						break;
						default:
							$where .= 'and s.'.$key.'="'.$value.'"';
						break;
					}
				}
			}
		}
		return $this->db->query('select c.id,c.categoria,count(c.categoria) as total from seminuevos s join categorias c on c.id=s.categoria  '.$where.' group by c.categoria limit 5');
	}
	
	function filtroEstados($campos=NULL){
		$where='';
		if(is_array($campos)){
			$where='where 1=1 ';
			foreach($campos as $key=>$value){
				if($value != '%'){
					switch ($key){
						case 'precio':
							$where .= 'and s.precio<="'.$value.'"';	
						break;
						case 'precio_desde':
							$where .= 'and s.precio>="'.$value.'"';	
						break;
						case 'precio_hasta':
							$where .= 'and s.precio<="'.$value.'"';	
						break;
						default:
							$where .= 'and s.'.$key.'="'.$value.'"';
						break;
					}
				}
			}
		}
		return $this->db->query('select es.id,es.estado,count(es.estado) as total from seminuevos s join estados es on es.id=s.estado  '.$where.' group by es.estado limit 5');
	}
	
	function getTarjetas($f=false,$lim,$offset){
		if($f != false){
			if($f['precio'] != "%"){
				$this->db->where('s.precio <=',$f['precio']);
			}	
			if($f['marca'] != '%'){
				$this->db->where('s.marca',$f['marca']);
			}
			if($f['modelo'] != '%'){
				$this->db->where('s.modelo',$f['modelo']);
			}
			if($f['anio'] != '%'){
				$this->db->where('s.anio',$f['anio']);
			}
			if($f['estado'] != '%'){
				$this->db->where('s.estado',$f['estado']);
			}
			if($f['categoria'] != '%'){
				$this->db->where('s.categoria',$f['categoria']);
			}
			if($f['precio_desde'] != '%'){
				$this->db->where('s.precio >=',$f['precio_desde']);				
			}
			if($f['precio_hasta'] != '%'){
				$this->db->where('s.precio <=',$f['precio_hasta']);
			}			
		}
		$this->db->join('marcas m','s.marca=m.id');
		$this->db->join('modelos mo','s.modelo=mo.id');
		$this->db->select('s.id, mo.modelo, m.marca, s.anio, s.precio,s.categoria');
		
		return $this->db->get('seminuevos s',$lim,$offset);	
	}
	function countTarjetas($f=false){
		if($f != false){
			if($f['precio'] != "%"){
				$this->db->where('precio <=',$f['precio']);
			}	
			if($f['marca'] != '%'){
				$this->db->where('marca',$f['marca']);
			}
			if($f['modelo'] != '%'){
				$this->db->where('modelo',$f['modelo']);
			}
			if($f['anio'] != '%'){
				$this->db->where('anio',$f['anio']);
			}
			if($f['precio_desde'] != '%'){
				$this->db->where('precio >=',$f['precio_desde']);				
			}
			if($f['precio_hasta'] != '%'){
				$this->db->where('precio <=',$f['precio_hasta']);
			}		
			if($f['estado'] != '%'){
				$this->db->where('estado',$f['estado']);
			}
			if($f['categoria'] != '%'){
				$this->db->where('categoria',$f['categoria']);
			}			
	
		}
		return $this->db->count_all_results('seminuevos');			
	}
}
?>