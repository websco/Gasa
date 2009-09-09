<?php
class Salidas extends MY_Controller {

	function __construct()
	{
		parent::__construct();
  		$this->load->model(array('productos_model','clientes_model','Solicitud','Sucursal'));
		$this->load->helper(array('statusproducto'));
		$this->controlador_name = 'salidas';
		$this->user   = $this->native_session->userdata('user');
		$this->output->enable_profiler(false);
	}
	function index()
	{
	

		$search = $this->input->post('ncliente');
		$dato['clientes'] = array();
		$dato['total_clientes']=0;

		if($search){
			$dato['clientes'] = $this->clientes_model->search($search);
			$dato['total_clientes'] = $dato['clientes']->num_rows();
 		}
 		
		$data['contenido']= $this->load->view('rentas/clientes_view',$dato,true);
		$data['user']=$this->native_session->userdata('user');
		$data['menu'] = 'salidas';
		$this->load->view('template',$data);
	
	}
	
	function cliente_nuevo()
	{
		//Checando la session del usuario
		
		//if(($this->user['rol'] ==NULL)||($this->user['rol'] ==2))redirect('catalogo');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nombre', 'Nombre del cliente', 'required');
		$this->form_validation->set_rules('direccion', 'Dirección', 'required');
		$this->form_validation->set_rules('telefono', 'Teléfono', 'required');
		$this->form_validation->set_rules('celular', 'Celular', '');
		$this->form_validation->set_rules('email', 'Email', 'valid_email');
		$this->form_validation->set_rules('id_type', 'Tipo de identificación', 'required');
		$this->form_validation->set_rules('id_num', 'identificación', 'required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		if(isset($_POST['nombre'])){
			if($this->form_validation->run() ==TRUE)
			{

			  $a_cliente['nombre'] = $this->input->post('nombre',true);		 
			  $a_cliente['telefono'] =$this->input->post('telefono',true);
			  $a_cliente['celular'] =$this->input->post('celular',true);
			  $a_cliente['direccion'] =$this->input->post('direccion',true);
			  $a_cliente['email'] =$this->input->post('email',true);
			  $a_cliente['id_type'] =$this->input->post('id_type',true);
			  $a_cliente['id_num'] =$this->input->post('id_num',true);
			  
				if($this->clientes_model->insertar($a_cliente)){
					redirect("salidas");
				}
			}
		}	

		$data['contenido']= $this->load->view('clientes/cliente_nuevo',null,true);
		$data['user']=$this->native_session->userdata('user');
		$data['menu'] = 'salidas';
		$this->load->view('template',$data);
	}
	
	function cliente_editar($id)
	{
		//Checando la session del usuario
		//if(($this->user['rol'] ==NULL)||($this->user['rol'] ==2))redirect('catalogo');
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nombre', 'Nombre del cliente', 'required');
		$this->form_validation->set_rules('direccion', 'Dirección', 'required');
		$this->form_validation->set_rules('telefono', 'Teléfono', 'required');
		$this->form_validation->set_rules('celular', 'Celular', '');
		$this->form_validation->set_rules('email', 'Email', 'valid_email');
		$this->form_validation->set_rules('id_type', 'Tipo de identificación', 'required');
		$this->form_validation->set_rules('id_num', 'identificación', 'required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		if(isset($_POST['nombre'])){
		
			if($this->form_validation->run() ==TRUE){
			
		
			  $a_cliente['nombre'] =$this->input->post('nombre',true);
			  $a_cliente['telefono'] =$this->input->post('telefono',true);
			  $a_cliente['celular'] =$this->input->post('celular',true);
			  $a_cliente['direccion'] =$this->input->post('direccion',true);
			  $a_cliente['email'] =$this->input->post('email',true);
			  $a_cliente['id_type'] =$this->input->post('id_type',true);
			  $a_cliente['id_num'] =$this->input->post('id_num',true);
			  
			 
				if($this->clientes_model->actualizar($a_cliente,$id))
				{
					redirect('salidas');
				}
			}
		}
		
		 $query01 = $this->db->get_where('clientes',array('id' => $id));
         
		
         foreach ($query01->result() as $row){
			$dato['id']             = $row->id;
            $dato['nombre']         = $row->nombre;
			$dato['telefono']       = $row->telefono;
			$dato['celular']        = $row->celular;
			$dato['direccion']      = $row->direccion;
			$dato['email']          = $row->email;
			$dato['id_type']        = $row->id_type;
			$dato['id_num']         = $row->id_num;
			
           }

		$data['contenido']= $this->load->view('clientes/cliente_editar',$dato,true);
		$data['user']=$this->native_session->userdata('user');
		$data['menu'] = 'salidas';
		$this->load->view('template',$data);
      	
	}
	
	function elegir_cliente($id_cliente)
	{
		
		$_SESSION['cliente']['id'] = $id_cliente;
		$query=$this->clientes_model->getCliente($id_cliente);
		if ($query->num_rows()>0){
			$query= $query->row();
			$_SESSION['cliente']['nombre'] = $query->nombre;
			redirect("salidas/rentar");
		}else{
			redirect("salidas");
		}
	}
	
	function rentar()
	{

		$dato['cliente']=$this->native_session->userdata('cliente');
	 	$codigo = $this->input->post('codigo');
		$dato['productos'] = array();
		$dato['total_productos']=0;

		$dato_c['carrito'] = $this->native_session->userdata('carrito');
		if($codigo){
			$dato['productos'] = $this->productos_model->search($codigo);
			$dato['total_productos'] = $dato['productos']->num_rows();
 		}
 		$dato['v_carrito']  = $this->load->view('rentas/carrito_view',$dato_c,true);
		$dato['user']=$this->native_session->userdata('user');
		$data['contenido']= $this->load->view('rentas/renta_view',$dato,true);
		$data['user']=$this->native_session->userdata('user');
		$data['menu'] = 'salidas';
		$this->load->view('template',$data);
	}
	
	
	function agregar(){
	    $this->output->enable_profiler(FALSE);
		//$item = $this->uri->segment(3);
		
		$codigo       = $this->input->post('codigo');
		$ndias        = $this->input->post('f_dia');
		$fecha        = $this->aumenta_dias($ndias);
		//$fecha_dia    = $this->input->post('f_dia');
		//$fecha_mes    = $this->input->post('f_mes');
		//$fecha_anio   = $this->input->post('f_anio');
		//$fecha = $fecha_anio.'-'.$fecha_mes.'-'.$fecha_dia;
		$query =$this->productos_model->getInfo($codigo);
		$query = $query->row();

		$nuevoItem = array('codigo'=>$codigo,'fecha'=>$fecha,'nombre'=>$query->nombre,'ndias'=>$ndias);
		
		$carrito = $this->native_session->userdata('carrito');
		if(!is_array($carrito)){
			$carrito=array();
		}

		if(!in_array($nuevoItem,$carrito)){
			array_push($carrito,$nuevoItem);
				$dato_c['carrito'] = $carrito;
				echo( $this->load->view('rentas/carrito_view',$dato_c,true)); 
			
		
		}
	
		
		$this->native_session->set_userdata('carrito',$carrito);

	}
	
	function quitar(){
	  $this->output->enable_profiler(FALSE);
		//$item = $this->uri->segment(3);
			$carrito = $this->native_session->userdata('carrito');
			$codigo      = $this->input->post('codigo');
			$nuevoItem = array('codigo'=>$codigo);
		/*
			// array ejemplo
			$array=array("algo","cosa","nose");

			$posicion=array_keys($array,"cosa"); // obtener la clave del elemento (= posición en este tipo de array)
			echo $posicion[0]."<br>";
			array_splice($array,$posicion[0],1); // array_splice($array,indice_elemento_comienzo,desplazamiento)

		*/
		if(is_array($carrito)){
		        $carrito = array_diff($carrito,array($nuevoItem));
				
		}
		
		$this->native_session->set_userdata('carrito',$carrito);
	}

	function confirmar()
	{

			$codigos          = $this->input->post('p_codigo');
			$nombres          = $this->input->post('p_nombre');
			$fechas           = $this->input->post('p_fecha');
			$nsdias           = $this->input->post('p_ndias');
			$envios           = $this->input->post('p_envio');
			$direcciones      = $this->input->post('p_direccion');
			
			$cliente = $this->native_session->userdata('cliente');	
	
		$q_cliente= $this->clientes_model->getCliente($cliente['id']);
		
		if($q_cliente->num_rows()>0){
			foreach($q_cliente->result() as $d_cliente){
				$dato['nombre_cliente'] = $d_cliente->nombre;
				$dato['telefono_cliente'] = $d_cliente->telefono;
				$dato['celular_cliente'] = $d_cliente->celular;
				$dato['direccion_cliente'] = $d_cliente->direccion;
				$dato['email_cliente'] = $d_cliente->email;

			}
		
		}
			
			 if(is_array($codigos))
             {
				$total_elementos = count($codigos);
				$total_e = $total_elementos -1;
				$matriz_carrito = array();
				for($i=0;$i<=$total_e;$i++)
				{
					$hoy   = date("Y-m-d");
					if($envios[$i]=='Si' && $direcciones[$i]==''){ $direcciones[$i]=$dato['direccion_cliente'];}
					$nuevoItem = array('codigo'=>$codigos[$i],'fecha'=>$fechas[$i],'f_renta'=>$hoy,'ndias'=>$nsdias[$i] ,'nombre'=>$nombres[$i],'envio'=>$envios[$i],'direccion'=>$direcciones[$i]);
					array_push($matriz_carrito,$nuevoItem);
					//array_push($matriz_carrito,$nuevoItem);
				}

					$this->native_session->set_userdata('carrito',$matriz_carrito);
             }
			 
	   
		
	    $dato['carrito'] = $this->native_session->userdata('carrito');
			
	    $data['user'] = $this->native_session->userdata('user');
		$data['contenido']= $this->load->view('rentas/prenta_view',$dato,true);
		$data['menu'] = 'salidas';
		$this->load->view('template',$data);

	}

	
	function procesar(){
 		if(!isset($_SESSION['cliente']) && !isset($_SESSION['carrito']) ){
			redirect('salidas');
		}
		$dato['cliente'] = $this->native_session->userdata('cliente');
		$dato['carrito'] = $this->native_session->userdata('carrito');
		$solicitud_id = $this->productos_model->procesar_orden($dato['cliente']['id'],$dato['carrito']);
		if($solicitud_id!=null){
			
			unset($_SESSION['carrito']);
			unset($_SESSION['cliente']);
			//$dato_solicitud['solicitud_id'] = $this->Solicitud->getInfoSolicitud($transaccion);
			$dato_solicitud['solicitud_id']  = $solicitud_id;
			$cliente_info  = $this->Solicitud->getInfoCliente_bySolId($solicitud_id);
			
			foreach($cliente_info->result() as $info)
			{
				$dato_solicitud['nombre_cliente'] = $info->nombre;
				$dato_solicitud['telefono_cliente'] = $info->telefono;
				$dato_solicitud['celular_cliente'] = $info->celular;
				$dato_solicitud['direccion_cliente'] = $info->direccion;
				$dato_solicitud['email_cliente'] = $info->email;
			}
					

			
			$dato_solicitud['productos']     = $this->Solicitud->getProductos_bySolId($solicitud_id);
			
			if($dato_solicitud['email_cliente']!='')
			{
				$email = "servicioclientes@mundomedico.com.mx";
				$headers = "MIME-Version: 1.0\r\n".
				"Content-type: text/html; charset=iso-8859-1\r\n".
				"From: Mundo Medico <".$email.">\r\n".
				"Return-Receipt-To: ".$email;
				//$message ="";
				$msg = "
					<html>
						<head>
							<title>Informacion de Renta </title>
						</head>
					<body>
					<p>Estimado(a) :".$dato_solicitud['nombre_cliente']."</p>
					<p>Antes que nada te queremos agradecer el habernos escogido a nosotros, Mundo Médico, 
						como la empresa dedicada a la recuperación de tu salud, que esperamos sea lo más 
						pronto posible.<br/>
						Este correo es para informarte de los artículos que rentaste y sus fechas de vencimiento: 
					</p>
					<p>Productos rentados</p>
					<table border='0' bordercolor='#999999'>
					<tr bgcolor='#0099FF'>
						<th><span style='color: #000000;'>Codigo</span></th>
						<th><span style='color:#000000;'>Producto</span></th>
						<th><span style='color:#000000;'>Fecha Salida</span></th>
						<th><span style='color:#000000;'>Fecha Promesa</span></th>
					</tr>";
				//Informacion de los productos
				foreach($dato_solicitud['productos']->result() as $row)
				{
					//$row->codigo;
					//$row->nombre;
					//$row->fecha_salida;
					//$row->fecha_promesa;
					$direccion = $row->direccion;
					//$message    .="\r\n Codigo: ".$row->codigo." | Producto: ".$row->nombre." | Fecha Renta: ".$row->fecha_salida." | Fecha Promesa: ".$row->fecha_promesa;
					$msg .= '<tr>
						<td><strong>'.$row->codigo.'</strong></td><td>'.$row->nombre.'</td><td>'.$row->fecha_salida.'</td><td>'.$row->fecha_promesa.'</td>
						</tr>';
				}

				$msg.="   </td>
      </tr>
    </table>
				<p>Te recordamos que estos articulos los rentaste en la tienda mundo medico ubicada en 
la dirección ".$direccion.", pero para tu comodidad, puedes devolver en 
cualquiera de nuestras sucursales</p><span align='center'>";
				$sucursales = $this->Sucursal->getSucursales();
				if($sucursales->num_rows()>0)
				{
					foreach($sucursales->result() as $sucursal)
					{
						$msg.=" Direccion: ".$sucursal->direccion." Telefono: ".$sucursal->telefono." <br />";
					}
				}
$msg.="</span>
<p>
Atentamente,
Mundo medico, mejoramos tu calidad de vida <br/>
En  mundo medico te agradecemos tu preferencia y esperamos tu pronta recuperaci&oacute;n
</p>
<table width='10%' cellspacing='0' cellpadding='0'>
      <tr>
        <td><img src='http://mundomedico.com.mx/images/index.gif' width='200' height='210' /></td>
      </tr>
      <tr>
        <td><p align='center'>&nbsp;</p>
          <p align='center' style='font-family: Arial, Helvetica, sans-serif;color: #666666;font-size: 12px;'>C. 60 # 360-B X 37   Y 39 Col. Centro, C.P. 97000<br />

            M&eacute;rida, Yucat&aacute;n,   M&eacute;xico<br />
          Tel: +52 (999) 920   82 96<br />
          Fax: +52 (999) 920   82 96<br />
          <br />
          <a href='mailto:info@mundomedico.com.mx'>info@mundomedico.com.mx</a><br/>
		  <a href='http://www.mundomedico.com.mx'>http://www.mundomedico.com.mx</a>
		  </p>
		</td>
		</tr>
		</table>
       	</body>
							</html>			";
				$titulo = "Informacion Renta Mundo Medico";
				$to = $dato_solicitud['email_cliente'];
				$subject = $titulo;
				//Informacion del cliente
				//$msg = "Nombre: $name\n\n";
				//$msg .= "Telefono:".$dato_solicitud['telefono_cliente']." \n\n";
				//$msg .= "celular:".$dato_solicitud['celular_cliente']."\n\n";
				//$msg .= "Direccion : ".$dato_solicitud['direccion_cliente']."\n\n";
				//$msg .= "Detalle de la Renta:$message\n\n"; 
				
					



				/*
				$headers = "MIME-Version: 1.0\r\n".
				   "Content-type: text/plain; charset=utf-8\r\n".
				   "From:".$email."<".$email.">\r\n".
				   "Return-Receipt-To: ".$email."\r\n".
				   "Reply-To:".$email;
				   */

				
				//Enviando email al cliente sobre los productos rentados
				if($to !='')
				{
					mail($to, $subject, $msg,$headers);
				}
			}
				
			
			$data['contenido']= $this->load->view('rentas/rentado_view',$dato_solicitud,true);
			$data['user']=$this->native_session->userdata('user');
			$data['menu'] = 'salidas';
			$this->load->view('template',$data);
		}else{
			$data['contenido']= $this->load->view('rentas/prenta_view',$dato,true);
			$data['user']=$this->native_session->userdata('user');
			$data['menu'] = 'salidas';
			$this->load->view('template',$data);
		}
	}
	
	function aumenta_dias($ndias)
	{
		$mes = date("m");
		$anio = date("Y");
		$dia = date("d");
		$nueva = mktime(0,0,0, $mes,$dia,$anio) + $ndias * 24 * 60 * 60;
		$nuevafecha=date("Y-m-d",$nueva);
	return $nuevafecha;
	}
}
