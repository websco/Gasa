<?php
//categorias
$options_cat[''] = 'Todas';
foreach ($categorias->result_array() as $row)
  {
	
    $options_cat[$row['id']] = $row['categoria'];
  };
//sucursales
$options_suc['0'] = 'Todas';
foreach ($sucursales->result_array() as $row)
  {
	
    $options_suc[$row['id']] = $row['nombre'];
  };
//Estatus
$options_stat[''] = 'Todos';
foreach ($statuses as $row)
  {
	
    $options_stat[$row['id']] = $row['nombre'];
  };
?>
<form action="catalogo" method="post">
<table width="96%" align="center" cellpadding="0" cellspacing="0">
<tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="32" valign="top"><div align="right" class="normales_bold">
            <div align="left" class="BIG_bold">REPORTES</div>
        </div></td>
      </tr>
      <tr>
        <td background="images/lauout_64.jpg"><img src="images/nada.gif" width="1" height="8" /></td>
      </tr>
      <tr>
        <td >&nbsp;</td>
      </tr>
  <tr>
    <td>&nbsp; <?php if($user['rol']==1){?><input type="button" value="Nuevo Producto" onClick="parent.location='catalogo/agregar'"><?php }?></td>
  </tr>
  <tr>
    <td>
  
    <table width="100%" border="0" cellpadding="3" cellspacing="0">
	  <tr bgcolor="#666666">
        <td width="3%" bgcolor="#666666" class="normales_bold_blanco">&nbsp;</td>
        <td width="10%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Codigo</div></td>
        <td width="25%" bgcolor="#666666" class="normales_bold_blanco"><div align="left" style="margin-left:5px;">Producto</div></td>
        <td width="15%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Categoria</div></td>
        <td width="15%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Sucursal</div></td>
        <td width="20%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Status</div></td>
        <td colspan="2" rowspan="2" bgcolor="#666666" class="normales_bold_blanco"> <div align="left"><input type="image" src="images/search2.png" width="32" height="32"  border="0" style="cursor:pointer;" alt="Buscar" name="buscar" id="button" value="Buscar" /></div></td>
        </tr>
      <tr bgcolor="#666666">
        <td width="3%" bgcolor="#666666" class="normales_bold_blanco">&nbsp;</td>
        <td width="10%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">
          <label>
			<?php if($codigo =='' ){ ?>
          <input name="codigo" id="codigo" type="text" size="18" />
			<?php } else{ ?>
			 <input name="codigo" id="codigo" type="text" size="18" value="<?php echo $codigo;?>" />
			<?php } ?>
          </label>
        </div></td>
        <td width="25%" bgcolor="#666666" class="normales_bold_blanco"><div align="left" style="margin-left:5px;">
			<?php if($producto =='' ){ ?>
          <input type="text" name="producto" id="producto" />
			<?php } else {?>
 			<input type="text" name="producto" id="producto" value="<?php echo $producto;?>" />
			<?php } ?>
        </div></td>
        <td width="15%" bgcolor="#666666" class="normales_bold_blanco"><div align="left"><? if($categoria ==''){echo form_dropdown('categoria_id', $options_cat,'',"class='sel_categoria' style='size: 22.5em;'");}else{echo form_dropdown('categoria_id', $options_cat,$categoria,"class='sel_categoria' style='size: 22.5em;'");}?></div></td>
        <td width="15%" bgcolor="#666666" class="normales_bold_blanco"><div align="left"><? if($sucursal ==''){echo form_dropdown('sucursal_id', $options_suc,$user['sucursal_id'],"class='sel_sucursal' style='size: 22.5em;'");}else{ echo form_dropdown('sucursal_id', $options_suc,$sucursal,"class='sel_sucursal' style='size: 22.5em;'");}?></div></td>
        <td width="20%" bgcolor="#666666" class="normales_bold_blanco"><div align="left"><? if($status ==''){echo form_dropdown('status_id', $options_stat,'',"class='sel_status' style='size: 22.5em;'");}else{echo form_dropdown('status_id', $options_stat,$status,"class='sel_status' style='size: 22.5em;'");}?></div></td>
        </tr>
	  <?php if($productos != false){?>
      <?php foreach($productos->result() as $producto){?>
      <tr class="normales_chicas">
        <td class="normales"><img src="images/ver.png" alt="ver detalles" width="16" height="17" /></td>
        <td class="normales"><div align="left"><?php echo $producto->codigo?></div></td>
        <td class="normales"><div align="left"><?php echo $producto->nombre?></div></td>
		  <td class="normales"><div align="left"><?php echo $producto->categoria?></div></td>
        <td class="normales"><div align="left"><?php echo $producto->sucursal?></div></td>
        <td class="normales"><div align="left"><?php echo statusproducto_id($producto->status);?></div></td>
        <td width="5%" class="normales"><div align="left"><?php if($user['rol']==1){?><a href="catalogo/modificar/<?php echo $producto->codigo?>"><img src="images/icon_edit.gif" width="16" height="16" border="0" /></a><?php } ?></div></td>
        <td width="7%" class="normales"><div align="left"><?php if($user['rol']==1){?><a href="catalogo/borrar/<?php echo $producto->codigo?>" onclick="return confirm('Seguro que quieres borrar este producto?')"><img src="images/delete.gif" width="16" height="16" border="0" /></a><?php } ?> </div></td>
      </tr>
      <?php }}?>
	<tr><td>&nbsp;</td></tr>
    </table>

    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</form>