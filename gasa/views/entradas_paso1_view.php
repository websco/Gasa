<table width="96%" align="center" cellpadding="0" cellspacing="0">
<tr>
        <td>&nbsp;</td>
      </tr>
  <tr>
        <td height="32" valign="top"><div align="right" class="normales_bold">
          <div align="left" class="BIG_bold">DEVOLUCIONES</div>
        </div></td>
      </tr>
      <tr>
        <td background="images/lauout_64.jpg"><img src="images/nada.gif" width="1" height="8" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
  <tr>
    <td class="normales">Capture el c&oacute;digo del producto:</td>
  </tr>
  <tr>
    <td>
    	<form action="entradas" method="post">
    		<input type="text" name="codigo_producto" id="codigo_producto" />
        	<input type="submit" name="button" id="button" value="Buscar" />
        </form>
  	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
    <?php if(($codigo_producto != false)){
if(($productos !='')||($productos !=NULL)){?>
    <table width="100%" border="0" cellpadding="3" cellspacing="0" bordercolor="#CCCCCC">
<tr>
    <td colspan="9">	<input type="button" value="Regresar" onClick="parent.location='entradas'"></td>
  </tr>
<tr>
    <td colspan="9">&nbsp;</td>
  </tr>
      <tr>
        <td width="3%" bgcolor="#666666" class="normales_bold_blanco">&nbsp;</td>
        <td width="9%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">C&oacute;digo</div></td>
        <td width="22%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Producto</div></td>
        <td width="11%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Fecha Renta</div></td>
        <td width="14%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Fecha Promesa</div></td>
		<td width="10%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Sucursal</div></td>
        <td width="10%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Status</div></td>
        <td width="12%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Situación</div></td>
		<td width="9%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Dia(s)</div></td>
      </tr>
      <?php

 foreach($productos->result() as $producto){?>
      <tr class="normales_chicas">
        <td class="normales">

			
			<?php 
		switch($producto->status){
		case 2:
		?>
          <form id="form1" name="form1" method="post" action="entradas">
            <!--<input type="submit" name="btn_devolver" id="btn_devolver" value="Devolver" />-->
			<input type="image" src="images/agregar.png"  width="14" height="15" alt="devolver"/>
                    <input type="hidden" name="codigo_hidden" id="codigo_hidden" value="<?php echo $codigo_hidden?>" />
					 <input type="hidden" name="btn_devolver" id="btn_devolver" value="Devolver" />
          </form>
			<?php break;
			case 3:?>
			<?php if($user['rol']==1){?>
          <form id="form1" name="form1" method="post" action="entradas">
            <!--<input type="submit" name="btn_mantenimiento" id="btn_mantenimiento" value="Mantenimiento" />-->
				<input type="image" src="images/agregar.png"  width="14" height="15" alt="Mantenimiento"/>
                    <input type="hidden" name="codigo_hidden" id="codigo_hidden" value="<?php echo $codigo_hidden?>" />
					 <input type="hidden" name="btn_mantenimiento" id="btn_mantenimiento" value="Mantenimiento" />
          </form>
			<?php }?>
		  <?php break;
		  case 4:?>
		<?php if($user['rol']==1){?>
          <form id="form1" name="form1" method="post" action="entradas">
            <!--<input type="submit" name="btn_disponible" id="btn_disponible" value="Disponible" />-->
				<input type="image" src="images/agregar.png" width="14" height="15" alt="Disponible"/>
                    <input type="hidden" name="codigo_hidden" id="codigo_hidden" value="<?php echo $codigo_hidden?>" />
					 <input type="hidden" name="btn_disponible" id="btn_disponible" value="Disponible" />
          </form>
		<?php } ?>		

				
				<?php break; default: ?>
			&nbsp;<?php
				break;
			}?></td>
        <td class="normales"><div align="left"><?php echo $producto->codigo?></div></td>
        <td class="normales"><div align="left"><?php echo $producto->nombre?></div></td>
        <td class="normales"><div align="left"><?php if($producto->fecha_salida!=''){echo date("d-m-Y",strtotime($producto->fecha_salida));}?></div></td>
        <td class="normales"><div align="left"><?php if($producto->fecha_promesa!=''){echo date("d-m-Y",strtotime($producto->fecha_promesa));}?></div></td>
		<td class="normales"><div align="left"><?php echo $producto->sucursal?></div></td>
        <td class="normales"><div align="left"><?php echo statusproducto_id($producto->status);?></div></td>
        <td class="normales"><div align="left">
												<?php if($producto->status == EN_RENTA)
														{
														  $valor = cuentadiasretraso($producto->fecha_promesa);
															if($valor >0)
																{
																	echo "<span class='normales_bold_rojas'>Retardo</span>";
																}else{
																	echo "<span>A tiempo</span>";
																}

														}?>
							</div></td>
	  <td class="normales"><div align="left">
												<?php if($producto->status == EN_RENTA)
														{
														  $valor= cuentadiasretraso($producto->fecha_promesa);
															if($valor >0){
																echo $valor." <img style='margin-left:15px;' src='images/alert.png' width='14' height='15' />";
																}else { echo $valor; }
														}?>
							</div></td>
      </tr>
      <tr class="normales_chicas">
        <td class="normales">&nbsp;</td>
        <td class="normales">&nbsp;</td>
		<td class="normales">&nbsp;</td>
		<td class="normales">&nbsp;</td>
		<td class="normales">&nbsp;</td>
        <td class="normales">&nbsp;</td>
        <td class="normales">&nbsp;</td>
        <td class="normales">&nbsp;</td>
		<td class="normales">&nbsp;</td>
      </tr>
      <?php }?>
    </table>
	<?php }else{echo $mensaje;}}?>    </td>
  </tr>
  <tr>
    <td><?php if(isset($status_actualizado)){?>
			<label class="normales"> Status del producto <span class="normales_bold"><?php echo $codigo_hidden?></span> actualizado a <span class="normales_bold"><?php echo $tipo_status;?></span></label>
		<?php }else{?>
&nbsp;<?php }?>
</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
