<link rel="stylesheet" href="css/general.css" type="text/css" media="screen" />
<script type="text/javascript" src="js/js.jquery126.js"></script>
<script type="text/javascript" src="js/jquery.listen-1.0.3-min.js"></script>
<script type="text/javascript">
/***************************/
//@Author: Adrian "yEnS" Mato Gondelle
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/

//SETTING UP OUR POPUP
//0 means disabled; 1 means enabled;
var popupStatus = 0;

//loading popup with jQuery magic!
function loadPopup(){
	//loads popup only if it is disabled
	if(popupStatus==0){
		$("#backgroundPopup").css({
			"opacity": "0.7"
		});
		$("#backgroundPopup").fadeIn("slow");
		$("#popupContact").fadeIn("slow");
		popupStatus = 1;
	}
}

//disabling popup with jQuery magic!
function disablePopup(){
	//disables popup only if it is enabled
	if(popupStatus==1){
		$("#backgroundPopup").fadeOut("slow");
		$("#popupContact").fadeOut("slow");
		popupStatus = 0;
	}
}

//centering popup
function centerPopup(){
	//request data for centering
	var windowWidth = document.documentElement.clientWidth;
	var windowHeight = document.documentElement.clientHeight;
	var popupHeight = $("#popupContact").height();
	var popupWidth = $("#popupContact").width();
	//centering
	$("#popupContact").css({
		"position": "absolute",
		"top": windowHeight/2-popupHeight/2,
		"left": windowWidth/2-popupWidth/2
	});
	//only need force for IE6
	
	$("#backgroundPopup").css({
		"height": windowHeight
	});
	
}
function viewInfo(codigo,status)
{
	$.post('catalogo/viewInfoProducto',{codigo:codigo,status:status}, function(data){

										$('#popupContact').html(data);
										centerPopup();
		//load popup
		loadPopup();
										
                                      });
}
function viewRenovar(codigo)
{
	
	$.post('catalogo/vistaRenovacionProducto',{codigo:codigo,status:status}, function(data){

										$('#popupContact').html(data);
										centerPopup();
		//load popup
		loadPopup();
										
                                      });
}	

//CONTROLLING EVENTS IN jQuery
$(document).ready(function(){
	
	//LOADING POPUP
	//Click the button event!
/*	
$(".button").click(function(){
		//centering with css
		centerPopup();
		//load popup
		loadPopup();
	});
		*/		
	//CLOSING POPUP
   $.listen('click','#popupContactClose',function(){
  			                                       
					                                disablePopup();
                                                  });
	//Click the x event!
	/*$("#popupContactClose").click(function(){
		disablePopup();
	});*/
	//Click out event!
	$("#backgroundPopup").click(function(){
		disablePopup();
	});
	//Press Escape event!
	$(document).keypress(function(e){
		if(e.keyCode==27 && popupStatus==1){
			disablePopup();
		}
	});

});
</script>
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
?><form action="catalogo" method="post">
<table width="95%" align="center" cellpadding="0" cellspacing="0">
<tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="32" valign="top"><div align="right" class="normales_bold">
            <div align="left" class="BIG_bold">CATÁLOGO</div>
        </div></td>
      </tr>
      <tr>
        <td background="images/lauout_64.jpg"><img src="images/nada.gif" width="1" height="8" /></td>
      </tr>
      <tr>
        <td >&nbsp;</td>
      </tr>
  <tr>
    <td>&nbsp; <?php if($user['rol']==1){?>
				<a href="catalogo/agregar" style="text-decoration:none;"><img src="images/boton-nproducto.jpg" border="0" align="absbottom"/></a>
				<?php }?></td>
  </tr>
      <tr>
        <td >&nbsp;</td>
      </tr>
  <tr>
    <td>
  
    <table width="96%" border="0" cellpadding="3" cellspacing="0">
	  <tr bgcolor="#666666">
        <td width="4%" bgcolor="#666666" class="normales_bold_blanco">&nbsp;</td>
        <td width="10%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Codigo</div></td>
        <td width="26%" bgcolor="#666666" class="normales_bold_blanco"><div align="left" style="margin-left:5px;">Producto</div></td>
        <td width="16%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Categoria</div></td>
        <td width="17%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Sucursal</div></td>
        <td width="21%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Status</div></td>
        <td colspan="2" rowspan="2" bgcolor="#666666" class="normales_bold_blanco"> <div align="left"><input type="image" src="images/search2.png" width="32" height="32"  border="0" style="cursor:pointer;" alt="Buscar" name="buscar" id="button" value="Buscar" /></div></td>
        </tr>

      <tr bgcolor="#666666">
        <td width="4%" bgcolor="#666666" class="normales_bold_blanco">&nbsp;</td>
        <td width="10%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">
          <label>
			<?php if($codigo =='' ){ ?>
          <input name="codigo" id="codigo" type="text" size="14"  />
			<?php } else{ ?>
			 <input name="codigo" id="codigo" type="text" size="14" value="<?php echo $codigo;?>" />
			<?php } ?>
          </label>
        </div></td>
        <td width="26%" bgcolor="#666666" class="normales_bold_blanco"><div align="left" style="margin-left:5px;">
			<?php if($producto =='' ){ ?>
          <input type="text" name="producto" id="producto" />
			<?php } else {?>
 			<input type="text" name="producto" id="producto" value="<?php echo $producto;?>" />
			<?php } ?>
        </div></td>
        <td width="16%" bgcolor="#666666" class="normales_bold_blanco"><div align="left"><? if($categoria ==''){echo form_dropdown('categoria_id', $options_cat,'',"class='sel_categoria' style='size: 22.5em;width:70px;'");}else{echo form_dropdown('categoria_id', $options_cat,$categoria,"class='sel_categoria' style='size: 22.5em;width:70px;'");}?></div></td>
        <td width="17%" bgcolor="#666666" class="normales_bold_blanco"><div align="left"><? if($sucursal ==''){echo form_dropdown('sucursal_id', $options_suc,$user['sucursal_id'],"class='sel_sucursal' style='size: 22.5em;width:140px;'");}else{ echo form_dropdown('sucursal_id', $options_suc,$sucursal,"class='sel_sucursal' style='size: 22.5em;width:140px;'");}?></div></td>
        <td width="21%" bgcolor="#666666" class="normales_bold_blanco"><div align="left"><? if($status ==''){echo form_dropdown('status_id', $options_stat,'',"class='sel_status' style='size: 22.5em;'");}else{echo form_dropdown('status_id', $options_stat,$status,"class='sel_status' style='size: 22.5em;'");}?></div></td>
        </tr>
		</table>
	  <?php if($productos != false){?>
		<div style="height:320px; overflow:auto;">
	<table width="96%" border="0" cellpadding="3" cellspacing="0">
      <?php foreach($productos->result() as $producto){?>

      <tr class="normales_chicas">
        <td width="4%" class="normales"><div class="button"><a href="javascript:;"   style=" text-decoration:none;" onclick="viewInfo('<? echo $producto->codigo; ?>',<?php echo $producto->status;?>);"><img src="images/ver.png" alt="ver detalles" width="16" height="17" style="cursor:pointer;" border="0"/></a></div></td>
        <td width="18%" class="normales"><div align="left"><?php echo $producto->codigo?></div></td>
        <td width="23%" class="normales"><div align="left"><?php echo $producto->nombre?></div></td>
		  <td width="15%" class="normales"><div align="left"><?php echo $producto->categoria?></div></td>
        <td width="18%" class="normales"><div align="left"><?php echo $producto->sucursal?></div></td>
        <td width="16%" class="normales"><div align="left"><?php echo statusproducto_id($producto->status);
													$valor= $producto->dias;
													if($valor >0)
														{
															echo "<span class='normales_bold_rojas'> <img style='margin-left:15px;margin-right:10px;' src='images/alert.png' width='14' height='15' align='absbottom'/>".$valor."</span>";
														}
												?>
			  </div></td>
        <td width="6%" class="normales">
			<div align="left"><?php if(($user['rol']==1)||($user['rol']==3)){?>
					<a href="catalogo/modificar/<?php echo $producto->codigo?>">
						<img src="images/icon_edit.gif" width="16" height="16" border="0" align="absbottom" />
					</a><?php } ?>
				
				<?php if( $producto->status == EN_RENTA){?>
					<a href="javascript:;"   style=" text-decoration:none;" onclick="viewRenovar('<? echo $producto->codigo; ?>');">
						<img src="images/redo.png" width="16" height="16" border="0" align="absbottom" />
					</a><?php } ?>
			</div>
		</td>
     
      </tr>
      <?php }

}?>

	<tr><td>&nbsp;</td></tr>
    </table>
</div>
    </td>
  </tr>
  <tr>
    <td class="normales">&nbsp;</td>
  </tr>
  <tr>
     <td class="normales">Productos en Total:&nbsp; <strong><?php echo $total;?></strong></td>
  </tr>
</table>
</form>
	<div id="popupContact">
		<?php echo $info_producto;?>
	</div>
	<div id="backgroundPopup"></div>