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

-->
</style>

<form method="post">
<table width="100%" height="281" border="0">
  <tr>
    <td width="19%" height="32" valign="middle"><input type="text" name="search" id="search" style="width:200px; height:30px; font-size:16px;" /></td>
    <td width="39%" valign="middle"><input type="submit" name="button" id="button" value="Buscar" style="height:30px;" /></td>
    <td width="29%" valign="top">&nbsp;</td>
    <td width="13%" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0" id="data">
      <tr>
        <td width="6%" class="error">&nbsp;</td>
        <td width="15%" class="error">CODIGO</td>
        <td width="18%" class="error">SUCURSAL</td>
        <td width="14%" class="error">STATUS</td>
        <td width="47%" class="error">DESCRIPCION</td>
      </tr>
      <?php if($total_productos > 0){
	  		$i = 0;
	  		foreach($productos->result() as $producto){
				$i++;
				($i%2==0)?$class='even':$class='odd';
	  ?>
      <tr class="<?php echo $class;?>">
        <td><a href="salidas/agregar/<?php echo $producto->codigo;?>" alt="<?php echo $producto->codigo;?>" title="Agregar" class='btn_agregar'></a></td>
        <td class="normales"><?php echo $producto->codigo?></td>
        <td class="normales"><?php echo $producto->sucursal?></td>
        <td class="normales"><?php echo statusproducto_id($producto->status);?></td>
        <td class="normales"><?php echo $producto->descripcion?></td>
      </tr>	
	  <?php }?>
	  <?php }else{
	  		for($i=0; $i<8;$i++){
	  ?>
      <tr>
        <td align="center" valign="middle" class="normales"></td>
        <td class="normales">&nbsp;</td>
        <td class="normales">&nbsp;</td>
        <td class="normales">&nbsp;</td>
        <td class="normales">&nbsp;</td>
      </tr>
      <?php }
	  
	  }?>
      
      <tr>
        <td colspan="5" class="normales">0 productos encontrados</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
    <td valign="top">
    <div style="margin-top:2px;" id="carrito">
        <div class="btn_confirmar"><a href="salidas/confirmar" class="btn_confirmar">CONFIRMAR</a></div>
        <?php 
			if(is_array($carrito) > 0 ){
				foreach($carrito as $item){?>
        			<div style="height:32px; line-height:30px; background-color:#CCCCCC"><a href="salidas/quitar/<?php echo $item?>" alt="<?php echo $item;?>" class="btn_quitar"><?php echo $item?></a></div>
        <?php 	}
			}
		?>        
    </div>
</td>
  </tr>
</table>
</form>
<script type="text/javascript" src="js/js.jquery126.js"></script>
<script type="text/javascript" src="js/jquery.listen-1.0.3-min.js"></script>
<script type="text/javascript">
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