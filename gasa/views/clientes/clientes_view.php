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
.even{background-color:#FFFFFF}
.btn_confirmar{
	text-decoration:none;
	color:#FFFFFF;
	height:32px; 
	line-height:30px;
	background-color:#666666; color:#FFFFFF; text-align:center; 
}

-->
</style>
<form action="" method="post">
<table width="96%" align="center" cellpadding="0" cellspacing="0">
  
  <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="32" valign="top"><div align="right" class="normales_bold">
          <div align="left" class="BIG_bold">CLIENTES</div>
        </div></td>
      </tr>
      <tr>
        <td background="images/lauout_64.jpg"><img src="images/nada.gif" width="1" height="8" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="22" class="normales">Ingrese el nombre del cliente a buscar:</td>
      </tr>
  <tr>
    <td>
	  <input type="text" name="ncliente" id="ncliente" />
      <input type="submit" id="button" value="Buscar Cliente" />
| 
<a href="clientes/cliente_nuevo" style="text-decoration:none;"><img src="images/boton-ncliente.jpg" width="122" height="28"   border="0" align="absbottom" /></a></td>
  </tr>
  <tr class="normales">
    <td><label></label>
    <br />
      <br /></td>
  </tr>
  <tr>
    <td>
    <?php if($clientes != false){?>
	<label>Resultados de la búsqueda:</label>
    <table width="100%" border="0" cellpadding="3" cellspacing="0" bordercolor="#CCCCCC">
      <tr>
        <td width="4%" bgcolor="#666666" class="normales_bold_blanco">&nbsp;</td>
        <td width="32%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Nombre</div></td>
        <td width="12%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Telefóno</div></td>
        <td width="13%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Móvil</div></td>
        <td width="35%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Dirección</div></td>
        <td width="4%" bgcolor="#666666" class="normales_bold_blanco"><div align="left"></div></td>
        
      </tr>
      <?php $i = 0;
		foreach($clientes->result() as $cliente){
			$i++;
			($i%2==0)?$class='even':$class='odd';
		?>
      <tr class="<?php echo $class;?>">
        <td class="normales"><div align="center" style="cursor:pointer;"><a href="salidas/elegir_cliente/<?php echo $cliente->id;?>" style="text-decoration:none;"><img src="images/agregar.png" alt="elegir" width="14" height="15"  border="0"/></a></div></td>
        <td class="normales"><div align="left"><?php echo $cliente->nombre?></div></td>
        <td class="normales"><div align="left"><?php echo $cliente->telefono?></div></td>
        <td class="normales"><div align="left"><?php echo $cliente->celular?></div></td>
        <td class="normales"><div align="left"><?php echo $cliente->direccion?></div></td>
        <td class="normales"><div align="left"><a href="salidas/cliente_editar/<?php echo $cliente->id?>"><img src="images/icon_edit.gif" width="16" height="16" border="0" /></a></div></td>
      
      </tr>
      <?php }?>
    </table>
	<?php }
	?>    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</form>