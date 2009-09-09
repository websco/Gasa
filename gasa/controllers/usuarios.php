<?php
class Usuarios extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('Usuario'));
		$this->load->helper(array('form','url'));
		$this->controlador_name = 'usuarios';
		$this->user   = $this->native_session->userdata('user');
		$this->output->enable_profiler(false);
	}

	function index()
	{
	if(($this->user['rol'] ==NULL)||($this->user['rol'] ==2)||($this->user['rol'] ==3))redirect('catalogo');
		$data['user']=$this->user;
		$username = $data['user']['username'];
		
		$usuarios = $this->Usuario->getUsuarios($username);
		$dato['usuarios'] = $usuarios;
		$data['breadcrums'] = 'Usuarios >';
		$dato['controlador']  =$this->controlador_name;
		$data['contenido']= $this->load->view('lista_usuarios_view',$dato,true);
		$data['user']=$this->native_session->userdata('user');
		$data['menu'] = 'usuarios';
		$this->load->view('template',$data);
	}
	
	function nuevo()
	{
		//Checando la session del usuario
		
		if(($this->user['rol'] ==NULL)||($this->user['rol'] ==2)||($this->user['rol'] ==3))redirect('catalogo');
		
		if(isset($_POST['username'])){
			//if($this->validation->run() ==TRUE){
			  $username = $_POST['username'];
			  $a_usuario['password'] =sha1($this->input->post('password'));
			  $a_usuario['rol'] =$this->input->post('rol');
			  $a_usuario['username'] =$this->input->post('username');
			  $a_usuario['full_name'] =$this->input->post('full_name');
			  $a_usuario['status'] =$this->input->post('status');
			  $a_usuario['sucursal'] =$this->input->post('sucursal');
			   $a_usuario['email'] =$this->input->post('email');
			  
				if($this->Usuario->insertar($a_usuario)){
					//redirect($this->controlador_name."/editar/".$username);
						redirect('usuarios');
				//}
			}
		}	
		$dato['sucursales'] = $this->db->get('sucursales');  
		$data['breadcrums'] = 'Nuevo usuario >';
		$dato['controlador']  =$this->controlador_name;
		$data['contenido']= $this->load->view('nuevo_usuario_view',$dato,true);
		$data['user']= $this->native_session->userdata('user');
        $data['menu'] = 'usuarios';
		$this->load->view('template',$data);
	}
	
	function editar($username)
	{
		//Checando la session del usuario
		if(($this->user['rol'] ==NULL)||($this->user['rol'] ==2)||($this->user['rol'] ==3))redirect('catalogo');
		
		if(isset($_POST['username'])){
			//if($this->validation->run() ==TRUE){
			
			$pass=$this->input->post('password');
             if($pass){
             //$b = ',pass='.sha1($pass);
			 $a_usuario['password'] =sha1($pass);
              }
			  $a_usuario['username'] =$this->input->post('username');
			  $a_usuario['rol'] =$this->input->post('rol');
			  $a_usuario['full_name'] =$this->input->post('full_name');
			  $a_usuario['status'] =$this->input->post('status');
			  $a_usuario['sucursal'] =$this->input->post('sucursal');
			  $a_usuario['email'] =$this->input->post('email');
			  
				//$_POST['password']=sha1($_POST['password']);
				if($this->Usuario->actualizar($a_usuario,$username))
				{
					//redirect($this->controlador_name.'/editar/'.$username);
					redirect('usuarios');
				}
			//}
		}
		
		 $query01 = $this->db->get_where('users',array('username' => $username));
         
		
         foreach ($query01->result() as $row){
            $dato['username']         = $row->username;
			$dato['password']         = $row->password;
			$dato['full_name']        = $row->full_name;
			$dato['status']           = $row->status;
			$dato['sucursal']         = $row->sucursal;
			$dato['rol']              = $row->rol;
			$dato['email']            = $row->email;
           }
		   
		$dato['sucursales'] = $this->db->get('sucursales');  
		$data['breadcrums'] = 'Editar usuario >';
		$dato['controlador']  =$this->controlador_name;
        $data['contenido']               = $this->load->view('editar_usuario_view',$dato,true);
		$data['user']                    = $this->native_session->userdata('user');
		$data['menu'] = 'usuarios';
		$this->load->view('template',$data);
      	
	}
	

		
	function borrar(){

		if(($this->user['rol'] ==NULL)||($this->user['rol'] ==2)||($this->user['rol'] ==3))redirect('catalogo');
		$username=$this->input->post('elidz');
		//Borrando los registros de la tabla
		
		$this->Usuario->borrar($username);
		//Redireccionando a la pagina  principal
		//redirect('zones');
	
	}
	

}
?>
