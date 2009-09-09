<style type="text/css">
<!--
body{font-family:arial;}


-->
</style>

<table width="96%" align="center" cellpadding="0" cellspacing="0">
  
  <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="32" valign="top"><div align="right" class="normales_bold">
          <div align="left" class="BIG_bold">RENTAS</div>
        </div></td>
      </tr>
      <tr>
        <td background="images/lauout_64.jpg"><img src="images/nada.gif" width="1" height="8" /></td>
      </tr>
      <tr>
        <td>Cliente: <strong><?php echo $nombre_cliente;?></strong><br />
		Telefono: <?php echo $telefono_cliente;?><br />
Celular: <?php echo $celular_cliente;?><br />
Dirección: <?php echo $direccion_cliente;?><br />
Email: <?php echo $email_cliente;?><br />		</td>
      </tr>
	      <tr>
        <td>&nbsp;</td>
      </tr>
<tr class="normales">
    <td><label></label>
    <br />
      <br /></td>
  </tr>
  <tr>
    <td>
	<label>Productos:</label>
	<?php  if($productos->num_rows()>0) {?>
    <table width="100%" border="0" cellpadding="3" cellspacing="0" bordercolor="#CCCCCC">
      <tr>
        <td width="8%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Código</div></td>
        <td width="17%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Producto</div></td>
        <td width="11%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Fecha renta </div></td>
        <td width="14%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Fecha Promesa </div></td>
		<td width="12%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Dias de renta </div></td>
        <td width="6%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Envio</div></td>
        <td width="32%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Dirección</div></td>
        </tr>
		   <?php $i = 0;

			foreach($productos->result() as $producto){
		
			$i++;
			($i%2==0)?$class='even':$class='odd';
		?>
      <tr class="<?php echo $class;?>" >
       
        <td class="normales"><div align="left"><?php  echo $producto->codigo;?></div></td>
        <td class="normales"><div align="left"><?php  echo $producto->nombre;?></div></td>
        <td class="normales"><div align="left"><?php  echo date("d-m-Y",strtotime($producto->fecha_salida));?></div></td>
        <td class="normales"><div  align="left"><?php echo date("d-m-Y",strtotime($producto->fecha_promesa));?></div></td>
		<td class="normales"><div align="left"><?php  echo $producto->ndias;?></div></td>
		<td class="normales"><div align="left"><?php  echo $producto->envio;?></div></td>
		<td class="normales"><div align="left"><?php  echo $producto->domicilio;?></div></td>
        </tr>
		   
      <?php }?>
    </table>
	<?php }?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
	<tr>
        <td height="22" class="normales">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;
		       </td>
      </tr>
      <tr>
        <td><input type="submit" name="button" id="button" value="Imprimir" /></td>
      </tr>
</table>

