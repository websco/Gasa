<style type="text/css">
<!--
body{font-family:arial;}
/*.borrar {	text-decoration:none;}*/
.btn_quitar { margin:0 auto; background:url(images/borrar.png); width:14px; height:15px; display:block}
.btn_agregar {margin:0 auto; background:url(images/agregar.png); width:14px; height:15px; display:block}
/*.btn_agregar {margin:0 auto; background:url(images/agregar.png) 0 23px; width:25px; height:23px; display:block}*/
/*.btn_agregar:hover {background-position:0 0;}*/

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

<table width="96%" align="center" cellpadding="0" cellspacing="0">
  
  <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="32" valign="top"><div align="right" class="normales_bold">
          <div align="left" class="BIG_bold">RENTAS</div>
        </div></td>
      </tr>
      <tr>
        <td background="images/lauout_64.jpg"><img src="images/nada.gif" width="1" height="8" /></td>
      </tr>
      <tr>
        <td>Cliente: <?php echo $cliente['nombre'];?></td>
      </tr>
	      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="22" class="normales">Capture al Código del Producto:</td>
      </tr>
  <tr>
    <td>
	<form action="salidas/rentar" method="post">
	  <input type="text" name="codigo" id="codigo" />
      <input type="submit" name="buscar" id="button" value="Buscar" />
	</form>
</td>
  </tr>
  <tr class="normales">
    <td><label></label>
    <br />
      <br /></td>
  </tr>
  <tr>
    <td>
    <?php if($productos != false){	?>
	<label>Resultados de la búsqueda:</label>
	<?php if($productos->num_rows()>0){?>
    <table width="100%" border="0" cellpadding="3" cellspacing="0" bordercolor="#CCCCCC">
      <tr>
        <td width="4%" bgcolor="#666666" class="normales_bold_blanco">&nbsp;</td>
        <td width="20%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Código</div></td>
        <td width="28%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Producto</div></td>
        <td width="12%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Sucursal</div></td>
 		<td width="12%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Estatus</div></td>
        <td width="36%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Dias a rentar </div></td>
        </tr>
      <?php $i = 0;
		foreach($productos->result() as $producto){
			$i++;
			($i%2==0)?$class='even':$class='odd';
		?>
      <tr class="<?php echo $class;?>" id="search_<?php echo $producto->codigo;?>">
        <td class="normales">
			<div align="left" style="width:20px;">
			<?php  
						if(($user['sucursal_id'] == $producto->sucursal_id)&&($user['rol']=='2')){?>
			<a href="javascript:;"  alt="<?php echo $producto->codigo;?>" title="Agregar" class='btn_agregar' onclick="agregaProducto('<?=$producto->codigo;?>')"></a>
					<?php } else
{
	if(($user['rol']!='2')){?>
			<a href="javascript:;"  alt="<?php echo $producto->codigo;?>" title="Agregar" class='btn_agregar' onclick="agregaProducto('<?=$producto->codigo;?>')"></a>
<?php				}	}?>											
							 </div>
		</td>
        <td class="normales"><div align="left"><?php echo $producto->codigo?></div></td>
        <td class="normales"><div align="left"><?php echo $producto->nombre?></div></td>
        <td class="normales"><div align="left"><?php echo $producto->sucursal?></div></td>
        <td class="normales"><div align="left"><?php echo statusproducto_id($producto->status);?></div></td>
        <td class="normales">
		 <?php
				if(($user['sucursal_id'] == $producto->sucursal_id)&&($user['rol']=='2')){?>
			<div  align="left"> 
			  <select name="f_dia_<?php echo $producto->codigo;?>" id="f_dia_<?php echo $producto->codigo;?>">
                <option value="1">1</option>
				<option value="3">3</option>
				<option value="5">5</option>
				<option value="7">7</option>
				<option value="10">10</option>
				<option value="15">15</option>
				<option value="20">20</option>
				<option value="25">25</option>
				<option value="30">30</option>
				<option value="35">35</option>
				<option value="60">60</option>
              </select>
             
			</div>
<?php } else{
if($user['rol']!='2'){
?>
	<div  align="left"> 
			  <select name="f_dia_<?php echo $producto->codigo;?>" id="f_dia_<?php echo $producto->codigo;?>">
                <option value="1">1</option>
				<option value="3">3</option>
				<option value="5">5</option>
				<option value="7">7</option>
				<option value="10">10</option>
				<option value="15">15</option>
				<option value="20">20</option>
				<option value="25">25</option>
				<option value="30">30</option>
				<option value="35">35</option>
				<option value="60">60</option>
              </select>
            
			</div>
<?php }} ?>
</td>
        </tr>
      <?php }?>
    </table>
	<?php }else{?>
	<br />
	<label><strong>Producto no encontrado o Inexistente</strong></label>
	<?php }}?>    
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>

	<tr>
        <td >&nbsp; </td>
      </tr>

      <tr>
        <td>
		<form  action="salidas/confirmar" method="post">
		<div id="contenido_carrito">
		<?php echo $v_carrito;?>
		</div>
		</form>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
</table>
<script type="text/javascript" src="js/js.jquery126.js"></script>
<script type="text/javascript" src="js/jquery.listen-1.0.3-min.js"></script>
<script type="text/javascript">
function agregaProducto(codigoProducto)
{
	var codigo = codigoProducto;
	var f_dia=   $('#f_dia_'+codigo+' option:selected').val(); 
	//var f_mes=   $('#f_mes_'+codigo+' option:selected').val(); 
	//var f_anio=   $('#f_anio_'+codigo+' option:selected').val(); 
	//alert(codigo+'\n'+f_dia+'\n'+f_mes+'\n'+f_anio);
	 $('#search_'+codigo).remove();	

		$.post('salidas/agregar',{codigo:codigo,f_dia:f_dia}, function(data){

										//$('#carrito').append(data);
										$('#contenido_carrito').html(data);
										
                                      });

}
function quitaProducto(codigoProducto)
{
	var codigo = codigoProducto;
	
 
		$.post('salidas/quitar',{codigo:codigo}, function(data){

										
									 $('#cr_'+codigo).remove();	
										
                                      });

}
$.listen('click','.btn_agregar',function(){
	agregar_producto($(this));
	return false;
});
$.listen('click','.btn_quitar',function(){
	quitar_producto($(this));
	return false;
});



function agregar_producto(e){
	var id = $(e).attr('alt');
	$.post($(e).attr('href'),{},function(data){
		$('#carrito').append(data);
	});
};
function quitar_producto(e){
	$.post($(e).attr('href'),{},function(data){
	    $(e).parent().remove();	
	});
};
</script>