<?php
class Clientes_model
 extends Model{

	function __construct(){
		parent::Model();
			$this->tabla = "clientes";
	}

	function insertar($data)
    {
       $data['created'] = date("Y-m-d H:i:s");
       $data['updated'] = date("Y-m-d H:i:s");
       $this->db->insert($this->tabla, $data);
       return true;
    }

    function actualizar($data,$id)
    { 
      $data['updated'] = date("Y-m-d H:i:s");
      $this->db->update($this->tabla, $data, array('id' => $id));    
      return true;      
    }
    
	
	function search($nombre){
		$this->db->select('id,nombre,telefono,celular,direccion');
		$this->db->where("nombre like('%".$nombre."%')");
		return $this->db->get('clientes');
	}
	
	function getCliente($id)
	{
		return $this->db->get_where("clientes",array('id' => $id));
	}
	

}
?>
