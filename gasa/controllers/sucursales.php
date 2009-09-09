<?php
class Sucursales extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('Sucursal'));
		$this->load->helper(array('form','url'));
		$this->controlador_name = 'sucursales';
		$this->user   = $this->native_session->userdata('user');
		$this->output->enable_profiler(false);
	}
	
	function index()
	{

		if(($this->user['rol'] ==NULL)||($this->user['rol'] ==2)||($this->user['rol'] ==3))redirect('catalogo');
		
		$data['user']=$this->user;
		$username = $data['user']['username'];
		
		$sucursales           = $this->Sucursal->getSucursales();
		$dato['sucursales']   = $sucursales;
		$data['breadcrums']   = 'Sucursales >';
		$dato['controlador']  = $this->controlador_name;
		$data['contenido']    = $this->load->view('lista_sucursales_view',$dato,true);
		$data['user']         = $this->native_session->userdata('user');
		$data['menu'] = 'sucursales';
		$this->load->view('template',$data);
		
	}
	
	function nuevo()
	{
		//Checando la session del usuario
		
		if(($this->user['rol'] ==NULL)||($this->user['rol'] ==2)||($this->user['rol'] ==3))redirect('catalogo');
		
		if(isset($_POST['nombre'])){
			//if($this->validation->run() ==TRUE){
				$id = $this->Sucursal->insertar($_POST);
				if($id >0){
					redirect($this->controlador_name."/editar/".$id);
				//}
			}
		}	
		
		$data['breadcrums'] = 'Nueva sucursal >';
		$dato['controlador']  =$this->controlador_name;
		$data['contenido']= $this->load->view('nueva_sucursal_view',$dato,true);
		$data['user']= $this->native_session->userdata('user');
		$data['menu'] = 'sucursales';
		$this->load->view('template',$data);
	}
	
	function editar($id)
	{
		//Checando la session del usuario
		if(($this->user['rol'] ==NULL)||($this->user['rol'] ==2)||($this->user['rol'] ==3))redirect('catalogo');
		
		if(isset($_POST['nombre'])){
			//if($this->validation->run() ==TRUE){
				//$id =$_POST['id']);
				if($this->Sucursal->actualizar($_POST,$id))
				{
					redirect($this->controlador_name.'/editar/'.$id);
				}
			//}
		}
		
		 $query01 = $this->db->get_where('sucursales',array('id' => $id));
         
		
         foreach ($query01->result() as $row)
		 {
			$dato['id']             = $row->id;
            $dato['nombre']         = $row->nombre;
			$dato['direccion']      = $row->direccion;
			$dato['telefono']       = $row->telefono;
			
         }
		   
		
		$data['breadcrums']   = 'Editar sucursal >';
		$dato['controlador']  = $this->controlador_name;
        $data['contenido']    = $this->load->view('editar_sucursal_view',$dato,true);
		$data['user']         = $this->native_session->userdata('user');
		$data['menu'] = 'sucursales';
		$this->load->view('template',$data);
      	
	}
	

		
	function borrar(){

		if(($this->user['rol'] ==NULL)||($this->user['rol'] ==2)||($this->user['rol'] ==3))redirect('catalogo');
		$id=$this->input->post('elidz');
		//Borrando los registros de la tabla
		
		$this->Sucursal->borrar($id);
		//Redireccionando a la pagina  principal
		//redirect('zones');
	
	}
	

}
?>
