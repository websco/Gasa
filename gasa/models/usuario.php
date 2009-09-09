<?php
class Usuario extends Model{
	
	function __construct(){
		parent::Model();
		$this->tabla = "users";
	}

	function getUsuarios($id_user){
		
		 return $this->db->query('select u.username,u.password,u.full_name,u.last_access,u.status,u.rol,u.sucursal,s.nombre nombre_sucursal from users u join sucursales s ON u.sucursal = s.id where u.username not in("'.$id_user.'") and rol in(2,3)');
		
		
	}
	
	function insertar($data)
    {
      // $data['created'] = date("Y-m-d H:i:s");
      // $data['updated'] = date("Y-m-d H:i:s");
       if($this->db->insert($this->tabla, $data))
       {
         $inserted          = $this->db->insert_id();
		 /*
         $evento['aviso']   = "Nuevo ".$this->objeto." creado";
         $evento['fecha']   = $data['created'];
         $evento['url']     = $this->controlador."/editar/".$inserted;
         $evento['created'] = $data['created'];
         $evento['updated'] = $data['created'];
         
         $this->Evento->insertar($evento);
		 */
       }
       return true;
    }

    function actualizar($data,$username)
    { 
      //$data['updated'] = date("Y-m-d H:i:s");
      if($this->db->update($this->tabla, $data, array('username' => $username)))
      {
			/*
         $evento['aviso']   = $this->objeto." actualizado";
         $evento['fecha']   = $data['updated'];
         $evento['url']     = $this->controlador."/editar/".$id;
         $evento['created'] = $data['updated'];
         $evento['updated'] = $data['updated'];
         
         $this->Evento->insertar($evento);
		 */
       }      
      return true;      
    }
    
    function borrar($username)
    {
		//$username="'".$username."'";
		$this->db->delete($this->tabla,array('username' => $username));

      return true;
    } 
	
	
}
?>