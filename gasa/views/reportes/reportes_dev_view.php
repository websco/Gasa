<link rel="stylesheet" href="css/general.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/jquery.jgrowl.css" type="text/css"/>


<script type="text/javascript" src="js/jquery-1.2.6.js"></script>
<script type="text/javascript" src="js/date-es.js"></script>
<script type="text/javascript" src="js/jquery.datePicker.js"></script>	

<!-- datePicker required styles -->
<link rel="stylesheet" type="text/css" media="screen" href="css/datePicker.css">
		<style type="text/css">

		
			body > div.jGrowl.center  {
				top: 				280px;
				width: 				50%;
				left: 				25%;
			}

			div#random {
				width: 					1000px;
				background-color: 		red;
				line-height: 			60px;
			}

/* located in demo.css and creates a little calendar icon
 * instead of a text link for "Choose date"
 */
a.dp-choose-date {
	float: left;
	width: 16px;
	height: 16px;
	padding: 0;
	margin: 5px 3px 0;
	display: block;
	text-indent: -2000px;
	overflow: hidden;
	background: url(images/calendar.png) no-repeat; 
}



a.dp-choose-date.dp-disabled {
	background-position: 0 -20px;
	cursor: default;
}
/* makes the input field shorter once the date picker code
 * has run (to allow space for the calendar icon
 */
input.dp-applied {
	width: 50px;
	float: left;
}
</style>
<script type="text/javascript" src="js/jquery.listen-1.0.3-min.js"></script>
<script type="text/javascript" src="js/jquery.ui.all.js"></script>
<script type="text/javascript" src="js/jquery.jgrowl.js"></script>
<script type="text/javascript">

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
	$.post('reportes/viewInfoProducto',{codigo:codigo,status:status}, function(data){

										$('#popupContact').html(data);
										centerPopup();
		//load popup
		loadPopup();
										
   });
}

/*
$.jGrowl.defaults.closer = function() {
					//console.log("Closing everything!", this);
				};
*/

$.jGrowl.defaults.position = 'center';
function cambiaStatus(codigo)
{
	$.jGrowl('Codigo Producto:'+codigo+' pasado a Mantenimiento',{
											beforeOpen: function(e,m,o) {
												$.post('reportes/cambiarPaMantenimiento',{codigo:codigo}, function(data){
															
														});
											}/*,
											open: function(e,m,o) {
												console.log("I have been opened!", this);
											},
											beforeClose: function(e,m,o) {
												console.log("I am going to be closed!", this);
											}*/,
											close: function(e,m,o) {
													window.location.replace("<?php echo base_url();?>"+"reportes"); 
												//window.location ="reportes";

											}

										}
);
/*
$.jGrowl("This notification will live a little longer.", { life: 1000 });
				$.jGrowl("Sticky notification with a header", { header: 'A Header', sticky: true });
*/
}
function toma_datos_impresion()
{
	$("input[name='pcategoria_id']").val($('#categoria_id').val());
	$("input[name='psucursal_id']").val($('#sucursal_id').val());
	$("input[name='pproducto']").val($('#producto').val());
	$("input[name='pcodigo']").val($('#codigo').val());
	$("input[name='pfecha_entrega']").val($('#fecha_entrega').val());
}

//CONTROLLING EVENTS IN jQuery
$(document).ready(function(){
	Date.format = 'dd-mm-yyyy';

// Datepicker
$('.date-pick').datePicker(
								{
									/*clickInput:true,*/
									startDate:'01/01/2009'
								}
							);
	
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

?>
<table width="95%" align="center" cellpadding="0" cellspacing="0">
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
    <td>
		<div style="float:left; margin:10px; width:120px;"><a href="reportes" style="text-decoration:none;"><img src="images/boton-devoluciones.jpg" border="0"/></a></div>
	<div style="float:left; margin:10px; width:120px;"><a href="reportes/rentas" style="text-decoration:none;"><img src="images/boton-rentas.jpg" border="0"/></a></div>
	<div style="float:left; margin:10px; width:120px;"><a href="reportes/retrasos" style="text-decoration:none;"><img src="images/boton-retrasos.jpg" border="0"/></a></div>
    <div style="float:left; margin:10px; width:120px;"><a href="reportes/mantenimientos" style="text-decoration:none;"><img src="images/boton-mantenimiento.jpg" border="0"/></a></div>	
	<div style="float:left; margin:10px; width:120px;"><a href="reportes/disponibles" style="text-decoration:none;"><img src="images/boton-disponibles.jpg" border="0"/></a></div>
</td>
  </tr>
      <tr>
        <td >&nbsp;</td>
      </tr>
      <tr>
        <td class="normales" >
			<form action="reportes/imprimir_devueltos" method="post" name="form_print" target="_blank" style="width:250px;" onsubmit="toma_datos_impresion();" >
			Productos devueltos: 
            <input type="image" src="images/79.png" width="16" height="16"  title="Imprimir Reporte" alt="Imprimir Reporte" />
			<input name="pfecha_entrega" type="hidden" value="" />
			<input name="pproducto" type="hidden" value="" />
			<input name="pcodigo" type="hidden" value="" />
			<input name="pcategoria_id" type="hidden" value="" />
			<input name="psucursal_id" type="hidden" value="0" />
           
        </form>
        </td>
      </tr>
      <tr>
        <td >&nbsp;</td>
      </tr>
  <tr>
    <td>
  <form action="reportes" method="post">
    <table width="96%" border="0" cellpadding="3" cellspacing="0">
	  <tr bgcolor="#666666">
        <td width="4%" bgcolor="#666666" class="normales_bold_blanco">&nbsp;</td>
        <td width="11%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Codigo</div></td>
        <td width="23%" bgcolor="#666666" class="normales_bold_blanco"><div align="left" style="margin-left:5px;">Producto</div></td>
        <td width="14%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Categoria</div></td>
        <td width="16%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Sucursal</div></td>
        <td width="24%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Fecha Entrega </div></td>
        <td colspan="2" rowspan="2" bgcolor="#666666" class="normales_bold_blanco"> <div align="left"><input type="image" src="images/search2.png" width="32" height="32"  border="0" style="cursor:pointer;" alt="Buscar" name="buscar" id="button" value="Buscar" /></div></td>
        </tr>
      <tr bgcolor="#666666">
        <td width="4%" bgcolor="#666666" class="normales_bold_blanco">&nbsp;</td>
        <td width="11%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">
          <label>
			<?php if($codigo =='' ){ ?>
          <input name="codigo" id="codigo" type="text" size="14" />
			<?php } else{ ?>
			 <input name="codigo" id="codigo" type="text" size="14" value="<?php echo $codigo;?>" />
			<?php } ?>
          </label>
        </div></td>
        <td width="23%" bgcolor="#666666" class="normales_bold_blanco"><div align="left" style="margin-left:5px;">
																		<?php if($producto =='' ){ ?>
																	  <input name="producto" type="text" id="producto" size="20" />
																		<?php } else {?>
																		<input name="producto" type="text" id="producto" value="<?php echo $producto;?>" size="20" />
																		<?php } ?>
																	</div>
		</td>
        <td width="14%" bgcolor="#666666" class="normales_bold_blanco"><div align="left"><? if($categoria ==''){echo form_dropdown('categoria_id', $options_cat,'',"class='sel_categoria' id='categoria_id' style='size: 22.5em;width:70px;'");}else{echo form_dropdown('categoria_id', $options_cat,$categoria,"class='sel_categoria' id='categoria_id' style='size: 22.5em;width:70px;'");}?></div></td>
        <td width="16%" bgcolor="#666666" class="normales_bold_blanco"><div align="left"><?  echo form_dropdown('sucursal_id', $options_suc,$sucursal,"class='sel_sucursal' id='sucursal_id' style='size: 22.5em;width:140px;'");?></div></td>
        <td width="24%" bgcolor="#666666" class="normales_bold_blanco"><div align="left"><?php if($fecha_e =='' ){ ?>
          <input class="date-pick" name="fecha_entrega" id="fecha_entrega" type="text" size="12"  style="width:70px;"/>
			<?php } else{ ?>
			 <input class="date-pick" name="fecha_entrega" id="fecha_entrega" type="text" size="12" value="<?php echo $fecha_e;?>" style="width:70px;"/>
			<?php } ?></div>
</td>
        </tr>
</table>
</form>
	  <?php if($productos != false){?>
	<div style="height:320px; overflow:auto;">
	<table width="96%" border="0" cellpadding="3" cellspacing="0">
      <?php foreach($productos->result() as $producto){?>
      <tr class="normales_chicas">
        <td width="5%" class="normales"><div class="button"><a href="javascript:;"   style=" text-decoration:none;" onclick="viewInfo('<? echo $producto->codigo; ?>',<?php echo $producto->status;?>);"><img src="images/ver.png" alt="ver detalles" width="16" height="17" style="cursor:pointer;" border="0"/></a></div></td>
        <td width="18%" class="normales"><div align="left"><?php echo $producto->codigo?></div></td>
        <td width="23%" class="normales"><div align="left"><?php echo $producto->nombre?></div></td>
		  <td width="12%" class="normales"><div align="left"><?php echo $producto->categoria?></div></td>
        <td width="21%" class="normales"><div align="left"><?php echo $producto->sucursal?></div></td>
        <td width="11%" class="normales"><div align="left"><?php echo date("d-m-Y",strtotime($producto->fecha_entrada));?></div></td>

        <td width="10%" class="normales"><div align="left"><?php if(($user['rol']==1)||($user['rol']==3)){?><a href="javascript:;"  onclick="cambiaStatus('<?php echo $producto->codigo;?>')"><input type="button" value="Mantenimiento" /></a><?php } ?> </div></td>
      </tr>
      <?php }}?>
	<tr><td>&nbsp;</td></tr>
    </table>    
	</div>
</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
<tr>
	<td class="normales">Productos en Total:&nbsp; <strong><?php echo $total;?></strong></td>
	</tr>
</table>

	<div id="popupContact">
		<?php echo $info_producto;?>
	</div>
	<div id="backgroundPopup"></div>