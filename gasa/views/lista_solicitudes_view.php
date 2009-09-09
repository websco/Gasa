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
<link rel="stylesheet" type="text/css" href="impromptu.css" />
<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="js/jquery-impromptu.js"></script>
<link rel="stylesheet" type="text/css" href="css/ventana.css" />

<script type="text/javascript" src="js/ui/ui.core.js"></script>
<script type="text/javascript" src="js/ui/ui.draggable.js"></script> 
<script type="text/javascript" src="js/ui/ui.resizable.js"></script> 
<script type="text/javascript" src="js/ui/effects.core.js"></script> 
<script type="text/javascript" src="js/ui/effects.transfer.js"></script> 
<script type="text/javascript" src="js/ui/effects.slide.js"></script> 
<script type="text/javascript" src="js/jquery.dimensions.min.js"></script>

<script type="text/javascript" src="js/jquery.listen.js"></script>


<script language="javascript">


$(document).ready( function() {


var ie6 = (jQuery.browser.msie && jQuery.browser.version < 7);	
		var b = jQuery(document.body);
		var w = jQuery(window);


			var getWindowSize = function(){ 
			var size = {
				width: window.innerWidth || (window.document.documentElement.clientWidth || window.document.body.clientWidth),
				height: window.innerHeight || (window.document.documentElement.clientHeight || window.document.body.clientHeight)
			};
			return size;
		};

		var getWindowScrollOffset = function(){ 
			return (document.documentElement.scrollTop || document.body.scrollTop) + 'px'; 
		};	

// Ventana

		
			
			$('#windowClose').bind(
				'click',
				function()
				{
					 $(this).effect("transfer", { to: "#windowStack" }, 400,function(){
																						
																						$('#window').css('visibility', 'hidden');
																					  });
				}
			);
			
			

			$('#windowMin').bind(
				'click',
				function()
				{
	
					 $('#windowContent').hide("slide", { direction: "down" }, 300);
					$('#windowBottom, #windowBottomContent').animate({height: 10}, 300);
					$('#window').animate({height:40},300).get(0).isMinimized = true;
					$(this).hide();
					$('#windowResize').hide();
					$('#windowMax').show();
				}
			);
			
			$('#windowMax').bind(
				'click',
				function()
				{
					var windowSize = $('#windowContent').height();
					$('#windowContent').show("slide", { direction: "down" }, 300);
					$('#windowBottom, #windowBottomContent').animate({height: windowSize + 13}, 300);
					$('#window').animate({height:windowSize+43}, 300).get(0).isMinimized = false;
					$(this).hide();
					$('#windowMin, #windowResize').show();
				}
			);
			$('#window').draggable({handle: '#windowTop'});


	

	<?php foreach($solicitudes->result() as $solicitud){ ?>

				$('#windowOpen_<?php echo $solicitud->id;?>').bind(
				'click',
				function() {
					if($('#window').css('visibility') == 'hidden') {
					  $(this).effect("transfer", { to: "#window" }, 400,function(){
																					
 				var wsize = getWindowSize();
			$('#window').css({ position: (ie6)? "absolute" : "fixed", top: (ie6)? getWindowScrollOffset():50, left: "20%", right: 20, top:"30%" });
			
																					$('#window').css('visibility', 'visible');
																				  });
					}
					this.blur();
					return false;
				}
			);

		<?php } ?> 



});

function viewProductos(id,controlador)
{
		$.post(controlador+'/bringProductos',{elid:id}, function(data){

										$('#windowContent').html(data);
										$('#windowTopContent').html('Solicitud '+id+' - Productos');
										
                                      });
}

</script>


<table width="96%" align="center" cellpadding="0" cellspacing="0">
  
  <tr>
    <td class="normales_bold">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>

    <table id="data" width="100%" border="0" cellpadding="3" cellspacing="0" bordercolor="#CCCCCC">
      <tr>

        <td width="7%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Solicitud</div></td>
        <td width="31%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Cliente</div></td>
        <td width="23%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Telefono / Celular </div></td>
        <td width="29%" bgcolor="#666666" class="normales_bold_blanco">&nbsp;</td>
        <td width="10%" bgcolor="#666666" class="normales_bold_blanco"><div id="windowStack" align="left">Detalles</div></td>
        </tr>
      <?php 
	  $i=0;
	  foreach($solicitudes->result() as $solicitud){  $i++;
			($i%2==0)?$class='even':$class='odd';
		?>
      <tr class="<?php echo $class;?>">

        <td class="normales"><div align="left"><?php echo $solicitud->id;?></div></td>
        <td class="normales"><div align="left"><?php echo $solicitud->nombre;?></div></td>
        <td class="normales"><div align="left"><?php echo $solicitud->telefono;?> / <?php echo $solicitud->celular;?></div></td>
        <td class="normales">&nbsp;</td>
        <td class="normales"><div align="left" id="windowOpen_<?php echo $solicitud->id;?>"><a href="javascript:;"  class="normales_bold" style="text-decoration:none; cursor:pointer;" onclick="viewProductos(<?=$solicitud->id; ?>,'solicitudes');"><img src="images/zoom.png" width="24" height="24" style=" border:0"/></a></div></td>
        </tr>
      <?php }?>
    </table>
   </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>		<div id="window"> 
								<div id="windowTop"> 
									<div id="windowTopContent">Productos</div> 
									<img src="images/ventana/window_min2.jpg" id="windowMin" /> 
									<img src="images/ventana/window_max2.jpg" id="windowMax" /> 
									<img src="images/ventana/window_close2.jpg" id="windowClose" />								</div> 
								<div id="windowBottom"><div id="windowBottomContent">&nbsp;</div></div> 
							  <div id="windowContent">
								<?php echo $ventana; ?>	</div> 
							</div></td>
  </tr>
</table>
