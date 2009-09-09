<?php
class Sucursal extends Model{
	
	function __construct(){
		parent::Model();
		$this->tabla = "sucursales";
	}

	function getSucursales()
	{
		return $this->db->query("SELECT s.id,s.nombre,s.direccion,s.telefono,p.codigo FROM sucursales s left join productos p on p.sucursal_id = s.id group by s.id");
	}
	
	function insertar($data)
    {

       if($this->db->insert($this->tabla, $data))
       {
         $inserted          = $this->db->insert_id();
	
       }
       return $inserted;
    }

    function actualizar($data,$id)
    { 
   
      $this->db->update($this->tabla, $data, array('id' => $id));
    
      return true;      
    }
    
    function borrar($id)
    {
		$this->db->delete($this->tabla,array('id' => $id));

      return true;
    } 
	
	
}
?>