<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: MUNDO MEDICO | Sistema de Control de Rentas ::</title>
<base href="<?php echo base_url()?>" />
<link href="mmedicofonts.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
body {
	background-image: url(images/layout_24.jpg);
}
.botoncin{
margin:0 auto; background:url(images/boton.gif) 0 23px; width:25px; height:23px; display:block
}
.botoncin:hover{
margin:0 auto; background:url(images/boton.gif) 0 0; width:25px; height:23px; display:block
}
.error{
	background-color:#666666; 
	color:#FFFFFF; padding-left:10px;
	font-family:arial;
}
.borrar{
	text-decoration:none;
}
.borrar:hover{
	text-decoration:none;
	display:block;
	background-color:#000000;
}
#salidas{
	display:block;
	height:70px; width:53px;
}
#salidas:hover{

}
#menu{list-style:none; margin:0; padding:0}
#menu li{float:left; width:50px; margin:0 10px;}
#menu li a:hover{
	background-position:0 -70px;
}

#menu li a{
	display:block;
	height:70px; width:53px;
}
.menu-link1{
	background:url(images/boton-salidas.jpg) no-repeat 0 0;
}
.menu-link2{
	background:url(images/boton-entradas.jpg) no-repeat 0 0;
}
.menu-link3{
	background:url(images/boton-catalogo.jpg) no-repeat 0 0;
}
.menu-link4{
	background:url(images/bo_01.jpg) no-repeat 0 0;
}
.menu-link5{
	background:url(images/boton-usuarios.jpg) no-repeat 0 0;
}
.menu-link6{
	background:url(images/bo_03.jpg) no-repeat 0 0;
}
.menu-link7{
	background:url(images/bo_05.jpg) no-repeat 0 0;
}

.activo{
	background-position:0 -70px;
}



-->
</style>

</head>

<body topmargin="0" leftmargin="0">
<br />
<table width="800" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="7"><img src="images/layout_03.jpg" width="7" height="7" /></td>
    <td width="785" background="images/layout_05.jpg"><img src="images/nada.gif" width="1" height="1" /></td>
    <td width="6"><img src="images/layout_07.jpg" width="6" height="7" /></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><div align="center">
      <table width="96%" cellspacing="0" cellpadding="0">
        <tr>
          <td width="16%" height="136" rowspan="3" valign="middle"><div align="center"><img src="images/layout_13.jpg" width="119" height="113" /></div></td>
          <td width="20%" rowspan="3" valign="middle">&nbsp;</td>
          <td width="64%" valign="middle"><div align="right"><img src="images/layout_48.jpg" width="316" height="21" /></div></td>
        </tr>
        <tr>
          <td valign="middle"><div align="right"><span class="normales_bold">Bienvenido:</span> <span class="normales"><?php echo $user['full_name']?></span> | <span class="normales_bold">Sucursal</span>: <span class="normales"><?php echo $user['sucursal_nombre']?></span> | <span class="normales_bold"><a href="login/logout">Salir</a></span></div></td>
        </tr>
        <tr>
          <td height="64" align="right" valign="middle">
          <ul id="menu">
			<?php 
			switch($user['rol'])
			{
				case 1:
				{
			?> 
          	<li><a href="salidas" class="menu-link1 <?php if($menu == 'salidas'){echo 'activo';}?>"></a></li>
            <li><a href="entradas" class="menu-link2 <?php if($menu == 'entradas'){echo 'activo';}?>"></a></li>
            <li><a href="catalogo" class="menu-link3 <?php if($menu == 'catalogo'){echo 'activo';}?>"></a></li>
			 <li><a href="usuarios" class="menu-link4 <?php if($menu == 'usuarios'){echo 'activo';}?>"></a></li>
			 <li><a href="clientes" class="menu-link5 <?php if($menu == 'clientes'){echo 'activo';}?>"></a></li>
            <li><a href="sucursales" class="menu-link6 <?php if($menu == 'sucursales'){echo 'activo';}?>"></a></li>
            <li><a href="reportes" class="menu-link7 <?php if($menu == 'reportes'){echo 'activo';}?>"></a></li>
           
			<?php 
			}
			break;
			case 2:
			{
			?>
			<li>&nbsp;</li>
            <li>&nbsp;</li>
            <li>&nbsp;</li>
			<li>&nbsp;</li>
          	<li><a href="salidas" class="menu-link1 <?php if($menu == 'salidas'){echo 'activo';}?>"></a></li>
            <li><a href="entradas" class="menu-link2 <?php if($menu == 'entradas'){echo 'activo';}?>"></a></li>
            <li><a href="catalogo" class="menu-link3 <?php if($menu == 'catalogo'){echo 'activo';}?>"></a></li>
			<?php 
			}
			break;
			case 3:
			{?>
			<li>&nbsp;</li>
            <li>&nbsp;</li>
            <li>&nbsp;</li>
          	<li><a href="salidas" class="menu-link1 <?php if($menu == 'salidas'){echo 'activo';}?>"></a></li>
            <li><a href="entradas" class="menu-link2 <?php if($menu == 'entradas'){echo 'activo';}?>"></a></li>
            <li><a href="catalogo" class="menu-link3 <?php if($menu == 'catalogo'){echo 'activo';}?>"></a></li>
			 <li><a href="reportes" class="menu-link7 <?php if($menu == 'reportes'){echo 'activo';}?>"></a></li>
			<?php }break;

		}?>
          </ul>
          </td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td colspan="3" background="images/layout_21.jpg"><img src="images/nada.gif" width="1" height="8" /></td>
  </tr>
  <tr>
    <td height="400" colspan="3" valign="top" background="images/layout_33.jpg"><?php echo $contenido?></td>
  </tr>
  <tr>
    <td><img src="images/layout_32.jpg" width="7" height="7" /></td>
    <td background="images/layout_34.jpg"><img src="images/nada.gif" width="1" height="1" /></td>
    <td><img src="images/layout_36.jpg" width="6" height="7" /></td>
  </tr>
</table>
</body>
</html>
