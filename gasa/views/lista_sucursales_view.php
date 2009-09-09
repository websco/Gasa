<link rel="stylesheet" href="css/impromptu.css" type="text/css" media="screen" />
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
<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="js/jquery-impromptu.js"></script>
<script type="text/javascript">
			
			function removeUser(id,controlador){
				var txt = 'Desea eliminar la sucursal? <input type="hidden" id="elid" name="elid" value="'+ id +'" />';
				$.prompt(txt,{ 
					buttons:{Eliminar:true, Cancelar:false},
					callback: function(v,m){
						var uid = m.find('#elid').val();
						if(v){
							$.post(controlador+'/borrar',{elidz:uid},function(data){
									location.href= controlador;
									//alert(data);
								});
							//,{userid:uid}, callback:function(data){
							//	if(data == 'true'){
							//$('#userid'+uid).hide('slow', function(){ $(this).remove(); });
							//	}else{ $.prompt('Un error ocurrio al eliminar el registro'); }							
							//});
						}
						else{}
						
					}
				});
			}
</script>
<table width="96%" align="center" cellpadding="0" cellspacing="0">
  
    <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="32" valign="top"><div align="right" class="normales_bold">
            <div align="left" class="BIG_bold">SUCURSALES</div>
        </div></td>
      </tr>
      <tr>
        <td background="images/lauout_64.jpg"><img src="images/nada.gif" width="1" height="8" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
  <tr>
    <td>
<a href="sucursales/nuevo" style="text-decoration:none;"><img src="images/boton-nsucursal.jpg" width="118" height="23"   border="0" align="absbottom" /></a>
	</td>
  </tr>
 <tr>
    <td>&nbsp;</td>
  </tr>
 <tr>
    <td class="normales">Detalles de Sucursales disponibles </td>
  </tr>
 <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>

    <table id="data" width="100%" border="0" cellpadding="3" cellspacing="0" bordercolor="#CCCCCC">
      <tr>

        <td width="27%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Nombre</div></td>
        <td width="13%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Tel&eacute;fono</div></td>
        <td width="56%" align="left" bgcolor="#666666" class="normales_bold_blanco">Direcci&oacute;n</td>
        <td width="2%" bgcolor="#666666" class="normales_bold_blanco"><div align="left"></div></td>
        <td width="2%" bgcolor="#666666" class="normales_bold_blanco"><div align="left"></div></td>
      </tr>
      <?php $i = 0;
		foreach($sucursales->result() as $sucursal){
			$i++;
			($i%2==0)?$class='even':$class='odd';
		?>
      <tr class="<?php echo $class;?>">

        <td class="normales"><div align="left"><?php echo $sucursal->nombre;?></div></td>
        <td class="normales"><div align="left"><?php echo $sucursal->telefono;?></div></td>
        <td class="normales"><div align="left"><?php echo $sucursal->direccion;?></div></td>
        <td class="normales"><div align="left"><a href="sucursales/editar/<?=$sucursal->id; ?>" ><img src="images/icon_edit.gif" width="16" height="16" style=" border:0"/></a></div></td>
        <td class="normales">
		<?php if(($sucursal->codigo =='')){?>
			<div align="left">
				<a href="javascript:;" title="Borrar sucursal" class="deleteuser" onclick="removeUser(<?=$sucursal->id; ?>,'<?echo $controlador; ?>');"><img src="images/borrar.png" width="14" height="15"  style=" border:0"/></a>			</div>
		<?php }else{?>
		&nbsp;
		<?php }?>		</td>
      </tr>
      <?php }?>
    </table>   </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
