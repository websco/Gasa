<?php
 class Recordatorio extends Controller {

	function __construct()
	{
		parent::__construct();
		if($_SERVER['SCRIPT_FILENAME'] != '/home/websco/gasa/scripts/recordatorio.php')
		exit;
		$this->load->model(array('Cron_model'));
		$this->output->enable_profiler(false);
	}
	
	function enviar_recordatorio()
	{
		$email = "lucks17@gmail.com";
		$CC_FB_SENDMAIL_EOL = "\r\n";
		
		$headers = "MIME-Version: 1.0\r\n".
		"Content-type: text/html; charset=iso-8859-1\r\n".
		"From: Mundo Medico <lucks17@gmail.com>\r\n".
		"Return-Receipt-To: lucks17@gmail.com";
		//$headers = 'MIME-Version: 1.0\r\n Content-Type: text/html; charset=iso-8859-1\r\n;
		
		$query = $this->Cron_model->getProductosARetrasarEmail();
		

		if($query->num_rows() >0)
		{
			$count_productos=0;
			$email_anterior="";
			//$sucursal_anterior="";
			$msg = "
			<html>
				<head>
					<title>Productos a entregar </title>
				</head>
				<body>
";
			$to ="";
			$msg_productos="";
			foreach($query->result() as $info)
			{
				
				
				$msg_productos .= '<tr>
						<td><strong>'.$info->codigo.'</strong></td><td>'.$info->nombre.'</td><td>'.$info->fecha_salida.'</td><td>'.$info->fecha_promesa.'</td><td>'.$info->dias.'</td>
						</tr>';

				if(($email_anterior != $email) &&($count_productos >0) )
				{
				
						$to  =  $info->email;
						
				
					$msg.="
<p>Estimado(a) ".$info->cliente."</p>
Esperamos que tu recuperación haya sido positiva. Este correo es para recordarte que 
los artículos que rentaste con nosotros tienen una fecha próxima a vencer. Sería 
importante que te comuniques con nuestra sucursal ".$info->sucursal." ,Direccion:".$info->direccion.",Telefonos:".$info->telefono." 
para informarle a nuestro personal si vas a  seguir utilizando nuestros artículos o 
planeas devolverlos en la fecha solicitada.
Esperamos que te comuniques con nosotros, de lo contrario nuestro personal se pondrá 
en contacto contigo.
Recuerda que en Mundo Médico, mejoramos tu calidad de vida.

				
				<p>Productos rentados</p>
				<table border='1' bordercolor='#999999'>
				<tr bgcolor='#0099FF'>
					<th><span style='color: #000000;'>Codigo</span></th>
					<th><span style='color:#000000;'>Producto</span></th>
					<th><span style='color:#000000;'>Fecha Salida</span></th>
					<th><span style='color:#000000;'>Fecha Promesa</span></th>
					<th><span style='color:#000000;'>Dias restantes</span></th>
				</tr>
				".$msg_productos."	
					</table>
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
          <a href='#'>info@mundomedico.com.mx</a> <br/> 
		  <a href='http://www.nombre_sistema.com.mx'>http://www.nombre_sistema.com.mx</a></p>

          </td>
      </tr>
    </table>
								</body>
							</html>";
					if($to !='')
					{					
						mail($to, 'Recordatorio de Productos a entregar en Mundo Medico',$msg,$headers);
					}
				}
				$email_anterior = $info->email;
				
				$count_productos++;
				if($query->num_rows() == $count_productos)
				{
					
					$to  =  $info->email;
							
					$msg.="
					
<p>Estimado(a) ".$info->cliente."</p>
Esperamos que tu recuperación haya sido positiva. Este correo es para recordarte que 
los artículos que rentaste con nosotros tienen una fecha próxima a vencer. Sería 
importante que te comuniques con nuestra sucursal ".$info->sucursal." ,Direccion:".$info->direccion.",Telefonos:".$info->telefono." 
para informarle a nuestro personal si vas a  seguir utilizando nuestros artículos o 
planeas devolverlos en la fecha solicitada.
Esperamos que te comuniques con nosotros, de lo contrario nuestro personal se pondrá 
en contacto contigo.
Recuerda que en Mundo Médico, mejoramos tu calidad de vida.

				
				<p>Productos rentados</p>
				<table border='1' bordercolor='#999999'>
				<tr bgcolor='#0099FF'>
					<th><span style='color: #000000;'>Codigo</span></th>
					<th><span style='color:#000000;'>Producto</span></th>
					<th><span style='color:#000000;'>Fecha Salida</span></th>
					<th><span style='color:#000000;'>Fecha Promesa</span></th>
					<th><span style='color:#000000;'>Dias restantes</span></th>
				</tr>
				".$msg_productos."	
					</table>
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
          <a href='#'>info@mundomedico.com.mx</a> <br/> 
		  <a href='http://www.nombre_sistema.com.mx'>http://www.nombre_sistema.com.mx</a></p>
		  </p>

          </td>
      </tr>
    </table>
				
							</body>
							</html>";
					if($to !='')
					{		
						mail($to, 'Recordatorio de  Productos a entregar en Mundo Medico',$msg,$headers);
					}
				}
			}
			
			
		}
		exit;
		
	}

	
}
?>