<?php
 class Cron extends Controller {

	function __construct()
	{
		parent::__construct();
		if($_SERVER['SCRIPT_FILENAME'] != '/home/websco/gasa/scripts/envia_mail.php')
		exit;
		$this->load->model(array('Cron_model'));
		$this->output->enable_profiler(false);
	}
	
	function envia_email()
	{
		$CC_FB_SENDMAIL_EOL = "\r\n";
		
		$headers = "MIME-Version: 1.0\r\n".
		"Content-type: text/html; charset=iso-8859-1\r\n".
		"From: Sistema Mundo Medico <lucks17@gmail.com.mx>\r\n".
		"Return-Receipt-To: lucks17@gmail.com.mx";
		//$headers = 'MIME-Version: 1.0\r\n Content-Type: text/html; charset=iso-8859-1\r\n;
		
		$query = $this->Cron_model->getProductosRetrasadosEmail();
		

		if($query->num_rows() >0)
		{
			$count_productos=0;
			$email_anterior="";
			$sucursal_anterior="";
			$msg = "
			<html>
				<head>
					<title>Productos con Retraso</title>
				</head>
				<body>
				<p>Productos con Retraso</p>
				<table border='1' bordercolor='#999999'>
				<tr bgcolor='#0099FF'>
					<th><span style='color: #000000;'>Codigo</span></th>
					<th><span style='color:#000000;'>Producto</span></th>
					<th><span style='color:#000000;'>Categoria</span></th>
					<th><span style='color:#000000;'>Fecha Salida</span></th>
					<th><span style='color:#000000;'>Fecha Promesa</span></th>
					<th><span style='color:#000000;'>Dias</span></th>
				</tr>";
			$to ="";
			foreach($query->result() as $info)
			{
				$sucursal = $info->sucursal_id;
				
				$msg .= '<tr>
						<td><strong>'.$info->codigo.'</strong></td><td>'.$info->nombre.'</td><td>'.$info->categoria.'</td><td>'.$info->fecha_salida.'</td><td>'.$info->fecha_promesa.'</td><td>'.$info->dias.'</td>
						</tr>';

				//$msg.=$CC_FB_SENDMAIL_EOL." Codigo: |".$info->codigo." | Producto:".$info->nombre." | Categoria: ".$info->categoria." | Fecha Salida: ".$info->fecha_salida." | Fecha Promesa: ".$info->fecha_promesa." | Dias Retraso: ".$info->dias.$CC_FB_SENDMAIL_EOL;
				
				//if(($email_anterior != $email) &&($count_productos >0) )
				if(($sucursal_anterior != $sucursal) &&($count_productos >0) )
				{
					$q_emails = $this->Cron_model->getUsuariosSucursal($sucursal_anterior);
					if($q_emails->num_rows()>0)
					{
						foreach($q_emails->result() as $usuario)
						{
							if($usuario->email !='')
							{
								$to  .=  $usuario->email.', ';
							}else{
									$to .= "contacto@mundomedico.com.mx";
								}
							
						}
					}
					$msg.='</table>
							</body>
							</html>';
					mail($to, 'Productos con Retraso ',$msg,$headers);
				}
				$sucursal_anterior = $info->sucursal_id;
				
				$count_productos++;
				if($query->num_rows() == $count_productos)
				{
					$q_emails = $this->Cron_model->getUsuariosSucursal($sucursal_anterior);
						if($q_emails->num_rows()>0)
						{
							foreach($q_emails->result() as $usuario)
							{
								if($usuario->email !='')
							{
								$to  .=  $usuario->email.', ';
							}else{
									$to .= "contacto@mundomedico.com.mx";
								}
								
							}
						}
						$msg.='</table>
							</body>
							</html>';
						mail($to, 'Productos con Retraso ',$msg,$headers);
				}
			}
			
			
		}
		exit;
		
	}
	

	
}
?>