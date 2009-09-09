<?php
class Login extends Controller{
    public $error_msg;
    function __construct(){
        parent::controller();
    }
    function Index(){
        $data['error_msg']='';
        $this->load->view('login_view',$data);
    }
    function loginto(){

        $user = $this->input->post('user',true);
        $pass = $this->input->post('pass',true);
        
		$this->db->join('sucursales','sucursales.id = users.sucursal');
        $this->db->where('username',$user);
        $this->db->where('password',sha1($pass));

        $result = $this->db->get('users');
        if($result->num_rows() == 1)
		{
			$activo= $result->row();
			$activo = $activo->status;
			if($activo==1)
			{
	            $result = $result->row_array();
	            $_SESSION['user']['username'] = $result['username'];
	            $_SESSION['user']['full_name'] = $result['full_name'];
	            $_SESSION['user']['rol'] = $result['rol'];
				$_SESSION['user']['sucursal_nombre'] = $result['nombre'];
				$_SESSION['user']['sucursal_id'] = $result['sucursal'];
				            
	            header('location:'.base_url().'catalogo');
			}
			else
			{
				$data['error_msg']='Tu cuenta ha sido desactivada';
				
			}
        }
		else
		{
			$data['error_msg']='Datos incorrectos';
        }
		$this->load->view('login_view',$data);
    }
    function logout(){
        $this->native_session->destroy();
        redirect('login');
    }
}
?>
