<script type="text/javascript" src="js/js.jquery126.js"></script>
<script src="js/jquery.validate.js" type="text/javascript"></script>

<script type="text/javascript">
        $(document).ready( function() {
               $('#signupForm').validate({
                           rules:{username:{required:true,minlength:3 },password:{required:true,minLength:5 },repassword:{required:true, minlength:5,equalTo:'#password'}}
						   ,messages:{username:{required:'Ingresa un usuario',minLength:'El usuario debe tener al menos 2 caracteres'},
                                      password:{required:'Ingresa un  password',minLength:'El password debe tener al menos 5 caracteres'},
                                      confirm_password:{ required:'Confirma el password', minLength:'El password debe tener al menos 5 caracteres',equalTo: 'El password no coincide'}
									}
               });
        });
</script>
<?php
foreach ($sucursales->result_array() as $row)
  {
    $options[$row['id']] = $row['nombre'];
  };
?>
<form id="signupForm" action="usuarios/nuevo" method="post">
<table width="96%" align="center" cellpadding="0" cellspacing="0">
<tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="32" valign="top"><div align="right" class="normales_bold">
          <div align="left" class="BIG_bold">USUARIOS</div>
        </div></td>
      </tr>
      <tr>
        <td background="images/lauout_64.jpg"><img src="images/nada.gif" width="1" height="8" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="723" border="0" cellpadding="0" cellspacing="5">
                          <tr align="left" valign="top">
                            <td width="134" align="left"><label class="normales">Username</label></td>
                            <td width="574" class="normales"><input  name="username"type="text" id="username" size="39" maxlength="150" /></td>
                          </tr>
                          <tr align="left" valign="top">
                            <td align="left"><label class="normales">Password</label></td>
                            <td class="normales"><input  name="password" type="text" id="password" size="39" maxlength="150" /></td>
                          </tr>
						 <tr align="left" valign="top">
                            <td align="left"><label class="normales">Repetir Password</label></td>
                            <td class="normales"><input  name="repassword" type="text" id="repassword" size="39" maxlength="150" /></td>
          </tr>
						   <tr align="left" valign="top">
                            <td align="left"><label class="normales">Nombre</label></td>
                            <td class="normales"><input  name="full_name" type="text" id="full_name" size="39" maxlength="150" /></td>
                          </tr>
						<tr align="left" valign="top">
                            <td align="left"><label class="normales">Email</label></td>
                            <td class="normales"><input  name="email" type="text" id="email" size="39" maxlength="150" /></td>
                          </tr>
							<tr align="left" valign="top">
                            <td align="left"><label class="normales">Rol</label></td>
                            <td><label>
                              <select name="rol">
                                <option value="2">normal</option>
                                <option value="3">especial</option>
                              </select>
                            </label>                              <label class="normales"></label></td>
                          </tr>
						   <tr align="left" valign="top">
                            <td align="left"><label class="normales">Status</label></td>
                            <td><label class="normales">Activo
                              <input name="status" type="radio" value="1" />
                             </label>
							<label class="normales">Inactivo
                              <input name="status" type="radio" value="0" />
                             </label>
							</td>
                          </tr>
                          <tr align="left" valign="top">
                            <td align="left"><label class="normales">Sucursal</label></td>
                            <td><? echo form_dropdown('sucursal', $options,null,"class='_myselectbox' style='size: 22.5em;width:250px;'");?></td>
                          </tr>                         
						  <tr align="left" valign="top">
                            <td align="left"><label class="normales"></label></td>
                            <td><input type="submit" name="" value="Guardar" /></td>
                          </tr>
                        </table></td>
  </tr>
  <tr>
    <td><a href="<?php echo $controlador;?>"  style=" text-decoration:none;"><img  border="0" src="images/btn_regresar.jpg"/></a>	</td>
  </tr>
</table>
</form>