		<?php if(is_array($carrito) > 0) {?>
Resumen de renta:<br />
<table width="100%" border="0" cellpadding="3" cellspacing="0" bordercolor="#CCCCCC" id="carrito">
		<tr><td>&nbsp;</td></tr>
      <tr>
        <td width="5%" bgcolor="#666666" class="normales_bold_blanco">&nbsp;</td>
        <td width="20%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">C&oacute;digo</div></td>
        <td width="30%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Producto</div></td>
        <td width="17%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Envio</div></td>
        <td width="28%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Direcci&oacute;n de Envio </div></td>
  </tr>

      <?php $i = 0;

			foreach($carrito as $item){
		
			$i++;
			($i%2==0)?$class='even':$class='odd';
		?>
      <tr class="<?php echo $class;?>" id="cr_<?php echo $item['codigo'];?>">
        <td class="normales"><div align="center"><a href="javascript:;" onclick="quitaProducto('<?=$item['codigo'];?>')" alt="<?php echo $item['codigo'];?>" class="btn_quitar"></a></div></td>
        <td class="normales"><div align="left"><?php echo $item['codigo'];?><input name="p_codigo[]" type="hidden" value="<?php echo $item['codigo'];?>" /></div></td>
        <td class="normales"><div align="left"><?php echo $item['nombre'];?><input name="p_nombre[]" type="hidden" value="<?php echo $item['nombre'];?>" /><input name="p_fecha[]" type="hidden" value="<?php echo $item['fecha'];?>" /><input name="p_ndias[]" type="hidden" value="<?php echo $item['ndias'];?>" /></div></td>
        <td class="normales"><div align="left"><select name="p_envio[]" id="env_<?php echo $item['codigo'];?>">
                <option>Si</option>
                <option>No</option>
              </select></div></td>
        <td class="normales"><div align="left"><span class="normales_bold">
          <input name="p_direccion[]" type="text" id="dir_<?php echo $item['codigo'];?>" size="60" />
			
        </span></div></td>
  </tr>
		<?php } ?>
</table>
<br />
<input name="" type="submit" value="Aceptar Renta" />
	<?php }
	?>   
