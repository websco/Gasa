<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: MUNDO MEDICO | Sistema de Control de Rentas ::</title>
<base href="<?php echo base_url()?>" />
<style type="text/css">
<!--
body {
	background-image: url(images/layout_24.jpg);
}
-->
</style>
<link href="mmedicofonts.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="impromptu.css" />
<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="js/jquery-impromptu.js"></script>
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
          <td width="15%" height="136" rowspan="3" valign="middle"><div align="center"><img src="images/layout_13.jpg" width="119" height="113" /></div></td>
          <td width="36%" rowspan="3" valign="middle">&nbsp;</td>
          <td width="49%" valign="middle"><div align="right"><img src="images/layout_48.jpg" width="316" height="21" /></div></td>
        </tr>
        <tr>
          <td valign="middle"><div align="right"><span class="normales_bold">Bienvenido:</span> <span class="normales"><?php echo $user['full_name']?></span> | <span class="normales_bold">Sucursal</span>: <?php echo $user['sucursal_nombre']?> | <span class="normales_bold"><a href="login/logout">Salir</a></span></div></td>
        </tr>
        <tr>
          <td height="64" valign="middle"><table width="100" align="right" cellpadding="0" cellspacing="0">
            <tr>
<?php if(($user['rol'] ==1)){?>
			  <td width="20"><a href="sucursales"><img src="images/btn_sucursales.jpg" alt="SUCURSALES" width="53" height="53" border="0" /></a></td>
			  <td width="12%"><img src="images/nada.gif" width="1" height="1" /><img src="images/nada.gif" width="15" height="1" /></td>
			  <td width="20"><a href="usuarios"><img src="images/btn_usuarios.jpg" alt="USUARIOS" width="53" height="53" border="0" /></a></td>
			  <td width="12%"><img src="images/nada.gif" width="1" height="1" /><img src="images/nada.gif" width="15" height="1" /></td>
<?php } ?>
              <td width="20"><a href="salidas"><img src="images/botones_52.jpg" alt="RENTAS" width="53" height="53" border="0" /></a></td>
              <td width="12%"><img src="images/nada.gif" width="1" height="1" /><img src="images/nada.gif" width="15" height="1" /></td>
              <td width="14%"><a href="entradas"><img src="images/botones_54.jpg" alt="DEVOLUCIONES" width="52" height="53" border="0" /></a></td>
              <td width="12%"><img src="images/nada.gif" width="15" height="1" /></td>
<?php if(($user['rol'] ==1)){?>
              <td width="14%"><a href="solicitudes"><img src="images/botones_56.jpg" alt="SOLICITUDES" width="52" height="53" border="0" /></a></td>
              <td width="11%"><img src="images/nada.gif" width="15" height="1" /></td>
<?php } ?>
              <td width="15%"><a href="catalogo"><img src="images/botones_58.jpg" alt="CATALOGO" width="53" height="53" border="0" /></a></td>
            </tr>
          </table></td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td colspan="3" background="images/layout_21.jpg"><img src="images/nada.gif" width="1" height="8" /></td>
  </tr>
  <tr>
    <td height="400" colspan="3" valign="top" background="images/layout_33.jpg"><table width="96%" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="19" valign="top"><div align="right" class="normales_bold">
          <div align="left">INICIO &gt; <?php echo $breadcrums?></div>
        </div></td>
      </tr>
      <tr>
        <td background="images/lauout_64.jpg"><img src="images/nada.gif" width="1" height="8" /></td>
      </tr>
      <tr>
        <td height="19" valign="top"><?php echo $contenido?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><img src="images/layout_32.jpg" width="7" height="7" /></td>
    <td background="images/layout_34.jpg"><img src="images/nada.gif" width="1" height="1" /></td>
    <td><img src="images/layout_36.jpg" width="6" height="7" /></td>
  </tr>
</table>
</body>
</html>
