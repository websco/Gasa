<style type="text/css">
<!--
body{font-family:arial;}
.borrar {	text-decoration:none;
}
.btn_agregar {margin:0 auto; background:url(images/boton.gif) 0 23px; width:25px; height:23px; display:block}
.btn_agregar:hover {background-position:0 0;}

#data tr{height:30px;}
#carrito tr{height:30px;}
.odd{ background-color:#CCCCCC}
.even{background-color:#E6E6E6}
.btn_confirmar{
	text-decoration:none;
	color:#FFFFFF;
	height:32px; 
	line-height:30px;
	background-color:#666666; color:#FFFFFF; text-align:center; 
}

-->
</style>

<form method="post">
<table width="100%" height="281" border="0">
  <tr>
    <td width="30%" height="32" valign="middle">Nombre del cliente<br />
      <input name="nombre" type="text" id="nombre" style="width:300px; height:30px; font-size:16px;" value="<?php echo set_value('cliente'); ?>" /></td>
    <td width="47%" align="left" valign="middle"><?php echo form_error('cliente'); ?></td>
    <td width="23%" colspan="2" rowspan="6" valign="top">
            <table width="260" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="92" class="btn_confirmar">C&Oacute;DIGO</td>
                <td width="168" class="btn_confirmar">FECHA PROMESA</td>
              </tr>
      <?php 
	  		foreach($carrito as $item){?>              
              <tr>
                <td align="center"><?php echo $item?></td>
                <td align="center">
                	<?php echo form_dropdown('dia['.$item.']',$dias,date('j',$promesa_default));?>
                    <?php echo form_dropdown('mes['.$item.']',$meses,date('n',$promesa_default));?>
                    <?php echo form_dropdown('anio['.$item.']',$anios,date('Y',$promesa_default));?>
                </td>
              </tr>
            <?php }?>
              <tr>
                <td colspan="2"><a href="salidas">Agregar otro</a></td>
              </tr>
            </table></td>
    </tr>
  <tr>
    <td height="32" valign="middle">Direcci&oacute;n<br />
      <input name="direccion" type="text" id="direccion" style="width:300px; height:30px; font-size:16px;" value="<?php echo set_value('direccion'); ?>" /></td>
    <td height="32" align="left" valign="middle"><?php echo form_error('direccion'); ?></td>
  </tr>
  <tr>
    <td height="32" valign="middle">Tel&eacute;fono<br />
      <input name="telefono" type="text" id="telefono" style="width:300px; height:30px; font-size:16px;" value="<?php echo set_value('telefono'); ?>" /></td>
    <td height="32" align="left" valign="middle"><?php echo form_error('telefono'); ?></td>
  </tr>
  <tr>
    <td height="32" valign="middle">Celular<br />
      <input name="celular" type="text" id="celular" style="width:300px; height:30px; font-size:16px;" value="<?php echo set_value('celular'); ?>" /></td>
    <td height="32" align="left" valign="middle"><?php echo form_error('celular'); ?></td>
  </tr>
  <tr>
    <td height="32" valign="middle">Email<br />
      <input name="email" type="text" id="email" style="width:300px; height:30px; font-size:16px;" value="<?php echo set_value('email'); ?>" /></td>
    <td height="32" align="left" valign="middle"><?php echo form_error('email'); ?></td>
  </tr>
  <tr>
    <td height="32" valign="middle">Tipo de comprobante<br />
    	<select name="tipo_comprobante" id="tipo_comprobante" style="width:300px; height:30px; font-size:16px;">
        	<option>IFE</option>
			<option>Licencia de maejo</option>
			<option>Otros</option>
    	</select>      </td>
    <td height="32" align="left" valign="middle">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top">N&uacute;mero de comprobante<br />
      <input name="numero_comprobante" type="text" id="numero_comprobante" style="width:200px; height:30px; font-size:16px;" value="<?php echo set_value('numero_comprobante'); ?>" /></td>
    <td align="left" valign="middle"><?php echo form_error('numero_comprobante'); ?></td>
    <td colspan="2" align="center" valign="top"><label>
      <input type="submit" name="button" id="button" value="Ingresar solicitud" style="height:30px;" />
    </label></td>
  </tr>
</table>
</form>
<script type="text/javascript" src="js/js.jquery126.js"></script>
<script type="text/javascript" src="js/jquery.listen-1.0.3-min.js"></script>
<script type="text/javascript">

</script>
