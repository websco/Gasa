<?php
class MY_Controller extends Controller{
	protected $STATUS_PRODUCTOS;
    function __construct(){
        parent::__construct();

        if(!$this->native_session->userdata('user')){
            redirect('login');
        }
        
        /*Estatus de los productos*/
        $this->STATUS_PRODUCTOS[0] = 'No disponible';
        $this->STATUS_PRODUCTOS[1] = 'Disponible';
        $this->STATUS_PRODUCTOS[2] = 'En renta';
        $this->STATUS_PRODUCTOS[3] = 'Devuelto';
        $this->STATUS_PRODUCTOS[4] = 'En mantenimiento';
        
    }
}
?>
