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
				var txt = 'Desea eliminar el usuario? <input type="hidden" id="elid" name="elid" value="'+ id +'" />';
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
          <div align="left" class="BIG_bold">USUARIOS</div>
        </div></td>
      </tr>
      <tr>
        <td background="images/lauout_64.jpg"><img src="images/nada.gif" width="1" height="8" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
<a href="usuarios/nuevo" style="text-decoration:none;"><img src="images/boton-nusuario.jpg" width="114" height="24"   border="0" align="absbottom" /></a>
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="normales">Detalle de usuarios: </td>
  </tr>
  <tr>
    <td>
    <?php if($usuarios != false){?>
    <table id="data" width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
      <tr>

        <td width="22%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Username</div></td>
        <td width="13%" bgcolor="#666666" class="normales_bold_blanco"><div align="left">Sucursal</div></td>
        <td width="3%" bgcolor="#666666" class="normales_bold_blanco"><div align="left"></div></td>
        <!--<td width="6%" bgcolor="#666666" class="normales_bold_blanco"><div align="left"></div></td>-->
      </tr>
      <?php
	  $i=0;
	  foreach($usuarios->result() as $usuario){	
	  $i++;
			($i%2==0)?$class='even':$class='odd';
		?>
      <tr class="<?php echo $class;?>">
       
        <td class="normales"><div align="left"><?php echo $usuario->username;?></div></td>
        <td class="normales"><div align="left"><?php echo $usuario->nombre_sucursal;?></div></td>
        <td class="normales"><div align="left"><a href="usuarios/editar/<?=$usuario->username; ?>" ><img src="images/icon_edit.gif" width="16" height="16" style=" border:0"/></a></div></td>
        <!--<td class="normales"><div align="left"><a href="javascript:;" title="Borrar usuario" class="deleteuser" onclick="removeUser('<?//echo $usuario->username; ?>','<?//echo $controlador; ?>');"><img src="images/borrar.png" width="14" height="15"  style=" border:0"/></a></div></td>-->
      </tr>
      <?php }?>
    </table>
	<?php }
	?>    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
