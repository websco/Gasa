
<form action="sucursales/editar/<?php echo $id;?>" method="post">
<table width="96%" align="center" cellpadding="0" cellspacing="0">
   <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="32" valign="top"><div align="right" class="normales_bold">
            <div align="left" class="BIG_bold">SUCURSALES</div>
        </div></td>
      </tr>
      <tr>
        <td background="images/lauout_64.jpg"><img src="images/nada.gif" width="1" height="8" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
  <tr>
    <td class="normales_bold">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="480" border="0" cellpadding="0" cellspacing="5">
                          <tr align="left" valign="top">
                            <td width="100" align="left"><label class="normales">Nombre</label></td>
                            <td width="380"><input name="nombre"type="text" class="normales" id="unit_type" value="<?php echo $nombre;?>" size="39" maxlength="150" /></td>
                          </tr>
						   <tr align="left" valign="top">
                            <td align="left"><label class="normales">Direcci&oacute;n</label></td>
                            <td><label>
                              <textarea name="direccion" cols="36" class="normales" id="direccion"><?php echo $direccion;?></textarea>
                            </label></td>
                          </tr>
						   <tr align="left" valign="top">
                            <td align="left"><label class="normales">Telefono</label></td>
                            <td><input name="telefono" type="text" class="normales" id="location" value="<?php echo $telefono;?>" size="39" maxlength="150" /></td>
                          </tr>                         
						  <tr align="left" valign="top">
                            <td align="left"><label class="normales"></label></td>
                            <td><input type="submit" name="" value="Guardar" /></td>
                          </tr>
                        </table></td>
  </tr>
  <tr>
    <td>
			<a href="<?php echo $controlador;?>"  style=" text-decoration:none;"><img  border="0" src="images/btn_regresar.jpg"/></a>	
    </td>
  </tr>
</table>
</form>