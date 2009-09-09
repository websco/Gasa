<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body bgcolor="#eeeeee" >
<table width="500" height="250" border="0" cellpadding="0" cellspacing="0" bgcolor="#eeeeee"  class="normales" style="margin-top:5px;" >
  <tr>
    <td width="300" align="left" valign="top">
		<div align="left" style="height:240px; overflow:auto; width:490px; margin:0px; padding:0px;">

			<?php 
if(isset($productos)){?>								
<table width="474"   class="normales" border="0"  cellpadding="0" cellspacing="0"  >
<tr class="lista" >
		<td width="64"  bgcolor="#666666"  class="normales_bold_blanco" >Codigo</td>
		<td width="76"  bgcolor="#666666"  class="normales_bold_blanco" >Categoria</td>
		<td width="93"  bgcolor="#666666"  class="normales_bold_blanco" >Nombre</td>
		<td width="132" bgcolor="#666666" class="normales_bold_blanco" >Fecha Salida</td>
		<td width="99"  bgcolor="#666666"  class="normales_bold_blanco" >Fecha Promesa</td>
  </tr>
<?php foreach($productos->result() as $producto){ ?>
	<tr class="lista" >
		<td width="64" class="normales" ><?php echo $producto->codigo;?></td>
		<td width="76" class="normales"><?php echo $producto->categoria;?></td>
		<td width="93" class="normales"><?php echo $producto->nombre;?></td>
		<td width="132" class="normales"><?php echo date("Y-m-d",strtotime($producto->fecha_salida));?></td>
		<td width="99" class="normales"><?php echo $producto->fecha_promesa;?></td>
  </tr>
		<tr class="lista">
		<td colspan="5">&nbsp;</td>
	</tr>
<?php }      ?>
<tr><td colspan="5">&nbsp;</td></tr>
</table>

  <?php }?>
		</div>
    </td>
   
  </tr>
</table>
</body>
</html>
