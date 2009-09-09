<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<base href="<?php echo base_url()?>" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: MUNDO MEDICO | Sistema de Control de Rentas ::</title>
<style type="text/css">
<!--
body {
	background-image: url(images/layout_24.jpg);
}
-->
</style>
<link href="mmedicofonts.css" rel="stylesheet" type="text/css" />
</head>

<body topmargin="0" leftmargin="0">
<form name="form" method="post" action="login/loginto">
<table width="350" align="center" cellpadding="0" cellspacing="0" style=" margin-top:80px;">
  <tr>
    <td width="7"><img src="images/layout_03.jpg" width="7" height="7" /></td>
    <td width="335" background="images/layout_05.jpg"><img src="images/nada.gif" width="1" height="1" /></td>
    <td width="6"><img src="images/layout_07.jpg" width="6" height="7" /></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><div align="center">
      <p><br />
        <img src="images/layout_13.jpg" width="119" height="113" /><br />
        <br />
      </p>
      </div></td>
  </tr>
  <tr>
    <td colspan="3" background="images/layout_21.jpg"><img src="images/nada.gif" width="1" height="8" /></td>
  </tr>
  <tr>
    <td colspan="3" background="images/layout_33.jpg"><p align="center"><br />
      <img src="images/layout_29.jpg" width="268" height="17" /></p>
      <table width="100" align="center" cellpadding="0" cellspacing="5">
        <tr>
          <td class="normales"><div align="right">Usuario:</div></td>
          <td><input name="user" type="text" id="user" size="14" /></td>
        </tr>
        <tr>
          <td class="normales"><div align="right">Contraseña:</div></td>
          <td><input name="pass" type="password" id="pass" size="14" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input type="submit" name="button" id="button" value="Log in" /></td>
        </tr>
        <tr>
          <td colspan="2" align="center" valign="bottom" class="normales_bold_rojas"><?php echo $error_msg;?></td>
          </tr>
      </table>
      <br /></td>
  </tr>
  <tr>
    <td><img src="images/layout_32.jpg" width="7" height="7" /></td>
    <td background="images/layout_34.jpg"><img src="images/nada.gif" width="1" height="1" /></td>
    <td><img src="images/layout_36.jpg" width="6" height="7" /></td>
  </tr>
</table>
</form>
</body>
</html>
