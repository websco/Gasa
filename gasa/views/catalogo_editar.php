<style type="text/css">
#mensaje{border:1px solid #00C640; background-color:#AEFFC9; text-align:center;}
</style>
<form method="post">
  <table width="96%" align="center" cellpadding="0" cellspacing="5">
  <tr>
        <td colspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td height="32" valign="top" colspan="3"><div align="right" class="normales_bold">
            <div align="left" class="BIG_bold">CATÁLOGO</div>
        </div></td>
      </tr>
      <tr>
        <td colspan="3" background="images/lauout_64.jpg"><img src="images/nada.gif" width="1" height="8" /></td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;</td>
      </tr>
  <tr>
    <td width="10%">&nbsp;</td>
    <td colspan="2"><span class="normales"><?php echo $mensaje; ?></span></td>
  </tr>
  <tr>
    <td align="right" class="normales">Código:</td>
    <td width="31%" class="normales">
	<?php if($user['rol']==1){?>
	<input name="codigo" type="text" id="codigo" value="<?php echo (set_value('codigo')) ? (set_value('codigo')) : ($producto->codigo);?>" size="40" />
	<?php }else{?>
	<input name="codigo" type="text" id="codigo" value="<?php echo (set_value('codigo')) ? (set_value('codigo')) : ($producto->codigo);?>" size="40"  disabled="disabled"/>
	<input name="codigo" type="hidden" id="codigo" value="<?php echo (set_value('codigo')) ? (set_value('codigo')) : ($producto->codigo);?>" size="40" />
	<?php }?>
	</td>
    <td width="59%" class="normales"><?php echo form_error('codigo'); ?></td>
  </tr>
  <tr>
    <td align="right" class="normales">Categoría</td>
    <td class="normales"><select name="categoria" id="categoria">
    <?php 
	if ($producto->categoria_id){
		foreach($categorias->result() as $categoria){
			($categoria->id==$producto->categoria_id)?$b='selected="selected"':$b='';
			echo '<option value="'.$categoria->id.'" '.$b.'>'.$categoria->categoria.'</option>';
		}
	}else{
		foreach($categorias->result() as $categoria){
			echo '<option value="'.$categoria->id.'">'.$categoria->categoria.'</option>';
		}	
	}?>
    </select></td>
    <td class="normales">&nbsp;</td>
  </tr>
  <tr>
    <td align="right" class="normales">Producto:</td>
    <td class="normales"><input name="producto" type="text" id="producto" value="<?php echo (set_value('producto')) ? (set_value('producto')) : ($producto->nombre);?>" size="40" /></td>
    <td class="normales"><?php echo form_error('producto'); ?></td>
  </tr>
  <tr>
    <td align="right" class="normales">Descripción:</td>
    <td class="normales"><textarea name="descripcion" cols="38" rows="4" id="descripcion"><?php echo (set_value('descripcion')) ? (set_value('descripcion')) : ($producto->descripcion);?></textarea></td>
    <td class="normales"><?php echo form_error('descripcion'); ?></td>
  </tr>
  <tr>
    <td align="right" class="normales">Ubicación:</td>
    <td class="normales"><select name="sucursal_id" id="sucursal">
		<?php
     	foreach($sucursales->result() as $sucursal){
						($sucursal->id==$producto->sucursal_id)?$b='selected="selected"':$b='';
							echo '<option value="'.$sucursal->id.'" '.$b.'>'.$sucursal->nombre.'</option>';
		};
		?>
    </select></td>
    <td class="normales">&nbsp;</td>
  </tr>
<!--
  <tr>
    <td align="right" class="normales">Fecha de ingreso:</td>
    <td class="normales">
    <select name="dia" id="dia">
      <option>Día</option>
    	<?php //for($i=1;$i<=31;$i++){echo '<option'.set_select('dia', $i).'>'.$i.'</option>';}?>
    </select>
    <select name="mes" id="mes">
        <option>Mes</option>
        <?php //foreach($meses as $key=>$value){echo '<option value="'.$value.'"'.set_select('mes', $value).'>'.$key.'</option>';}?>   
      </select>
    <select name="anio" id="anio">
        <option>Año</option><option <?php //echo set_select('anio', 2009);?>>2009</option><option <?php //echo set_select('anio', 2010)?>>2010</option>
      </select>      </td>
    <td class="normales"><?php //echo form_error('dia'); ?><br />
        <?php //echo form_error('mes'); ?><br />
        <?php //echo form_error('anio'); ?><br />
      <br /></td>
  </tr>
  -->
  <tr>
    <td align="right">&nbsp;</td>
    <td colspan="2"><label><span class="normales">
    <input type="submit" name="Guardar" id="Guardar" value="Guardar" />
	</span>
	</label>
   <a href="catalogo"  style=" text-decoration:none;"><img src="images/btn_regresar.jpg"  border="0" align="absbottom"/></a>
   </td>
  </tr>
</table>
</form>
