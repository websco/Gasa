<style type="text/css">
#mensaje{border:1px solid #00C640; background-color:#AEFFC9; text-align:center;}
</style>
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
        <td height="22"><span class="normales">Capture los datos del cliente:</span></td>
      </tr>
      <tr>
        <td><form action="salidas/cliente_nuevo" method="post">

  <table width="96%" align="center" cellpadding="0" cellspacing="5">
  <tr>
    <td width="21%">&nbsp;</td>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td align="right" class="normales">Nombre Completo :</td>
    <td width="28%" class="normales"><input name="nombre" type="text" id="nombre" size="50"  /></td>
    <td width="51%" class="normales"><?php echo form_error('nombre'); ?></td>
  </tr>
  <tr>
    <td align="right" class="normales">Dirección</td>
    <td class="normales"><textarea name="direccion" cols="38" rows="4" id="direccion"></textarea></td>
    <td class="normales">&nbsp;</td>
  </tr>
  <tr>
    <td align="right" class="normales">Teléfono fijo:</td>
    <td class="normales"><input type="text" name="telefono" id="telefono"  /></td>
    <td class="normales"><?php echo form_error('telefono'); ?></td>
  </tr>
  <tr>
    <td align="right" class="normales">Teléfono móvil :</td>
    <td class="normales"><input type="text" name="celular" id="celular"  /></td>
    <td class="normales"><?php echo form_error('celular'); ?></td>
  </tr>
  <tr>
    <td align="right" class="normales">Email:</td>
    <td class="normales"><input name="email" type="text" id="email" size="50" /></td>
    <td class="normales"><?php echo form_error('email'); ?></td>
  </tr>
  <tr>
    <td align="right" class="normales">Identificación Oficial:</td>
    <td class="normales"><select name="id_type" id="id_type">
              <option>(Seleccione ID)</option>
              <option>IFE</option>
              <option>Licencia</option>
              <option>Pasaporte</option>
            </select>
   </td>
    <td class="normales"><?php echo form_error('id_type'); ?>
      <br /></td>
  </tr>
<tr>
    <td align="right" class="normales">Número de ID:</td>
    <td class="normales"><input name="id_num" type="text" id="id_num" size="50" /></td>
    <td class="normales"><?php echo form_error('id_num'); ?>
    <br />
      <br /></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td colspan="2"><label><span class="normales">
    <input type="submit" name="Guardar" id="Guardar" value="Guardar" />
    </span></label>		<a href="salidas"  style=" text-decoration:none;"><img src="images/btn_regresar.jpg"  border="0" align="absbottom"/></a>	</td>
  </tr>
</table>
</form></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
