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
.style4 {font-size: 12px; font-weight: bold; }

-->
</style>
<form method="post">
<table width="100%" height="281" border="0">
  <tr>
    <td width="30%" height="32" valign="middle"><span class="style4">Nombre del cliente</span><br />
    <?php echo $cliente['nombre']?></td>
    <td width="23%" rowspan="7" align="left" valign="top"><table width="260" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="92" class="btn_confirmar">C&Oacute;DIGO</td>
        <td width="168" class="btn_confirmar">FECHA PROMESA</td>
      </tr>
      <?php 
	  		foreach($carrito as $item){?>
      <tr>
        <td align="center"><?php echo $item?></td>
        <td align="center"><?php echo $fechas['dia'][$item].'-'.$fechas['mes'][$item].'-'.$fechas['anio'][$item]?></td>
      </tr>
      <?php }?>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
    </table></td>
    <td width="24%" rowspan="7" align="left" valign="top"><input type="submit" name="button" id="button" value="Imprimir" /></td>
  </tr>
  <tr>
    <td height="32" valign="middle"><span class="style4">Direcci&oacute;n</span><br />
    <?php echo $cliente['nombre']?></td>
    </tr>
  <tr>
    <td height="32" valign="middle"><span class="style4">Tel&eacute;fono</span><br />
    <?php echo $cliente['telefono']?></td>
    </tr>
  <tr>
    <td height="32" valign="middle"><span class="style4">Celular</span><br />
    <?php echo $cliente['celular']?></td>
    </tr>
  <tr>
    <td height="32" valign="middle"><span class="style4">Email</span><br />
    <?php echo $cliente['email']?></td>
    </tr>
  <tr>
    <td height="32" valign="middle"><span class="style4">Tipo de comprobante</span><br />
      <?php echo $cliente['tipo_comprobante']?></td>
    </tr>
  <tr>
    <td valign="top"><span class="style4">N&uacute;mero de comprobante</span><br />
    <?php echo $cliente['numero_comprobante']?></td>
    </tr>
</table>
</form>
<script type="text/javascript" src="js/js.jquery126.js"></script>
<script type="text/javascript" src="js/jquery.listen-1.0.3-min.js"></script>
<script type="text/javascript">

</script>
