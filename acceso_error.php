<?php require_once('Connections/conexiontienda.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/frontend.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Documento sin título</title>
<!-- InstanceEndEditable -->
<link href="estilos.css" rel="stylesheet" type="text/css" />
<link href="menu/index_files/mbcsmbmcp.css" rel="stylesheet" type="text/css" />
<style type="text/css">
</style>
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>
<div class="contenedor">
  <div class="cabecera">
    <div class="logo"><img src="logo.png" width="260" height="70" /></div>
    <div class="imagen-cabecera"><img src="IMAGEN-CABECERA.png" width="400" height="70" /></div>
    <div class="horarios"><img src="horarios.png" width="260" height="70" /></div>
  </div>
  <div class="menu-lateral">
    <div class="categoria">CATEGORIAS</div>
    <div class="buscador"><br />
     
      <form id="form1" name="form1" method="get" action="categoria_resultados.php">
        <label for="textfield"></label>
        <input name="FBuscar" type="text" id="textfield" size="17px"/>
          <center><input type="submit" name="button" id="button" value="Buscar" /></center>
      </form><?php include("includes/catalogo.php"); ?>
    </div>
 
       
</div>
<div class="menu-centro"><ul id="mbmcpebul_table" class="mbmcpebul_menulist css_menu" style="width: 539px; height: 30px;">
  <li class="topitem spaced_li"><div class="buttonbg" style="width: 59px;"><a>Inicio</a></div></li>
  <li class="topitem spaced_li"><div class="buttonbg" style="width: 130px;"><a>Quienes Somos<br /></a></div></li>
  <li class="topitem spaced_li"><div class="buttonbg" style="width: 125px;"><a>Como Comprar<br /></a></div></li>
  <li class="topitem spaced_li"><div class="buttonbg"><a>forma de Pago</a></div></li>
  <li class="topitem"><div class="buttonbg" style="width: 82px;"><a>Contacto</a></div></li>
</ul>
<!-- Menus will work without this javascript file. It is used only for extra
     effects, improved usability and compatibility with very old web browsers. -->
<script type="text/javascript" src="index_files/mbjsmbmcp.js"></script></div>
<!-- InstanceBeginEditable name="EditRegion3" -->
  <div class="contenido">
   <center> <h2>
   Ha ocurrido un error mientras intentaba iniciar sesión.
   <a href="javascript:window.history.back(-1);">Inténtalo</a> de nuevo o <a href="alta_usuario.php">regístrate</a></h2>
    </center>
  </div>

<!-- InstanceEndEditable --><!-- InstanceBeginEditable name="EditRegion4" -->
  

</body><!-- InstanceEndEditable -->
<!-- InstanceEnd --></html>