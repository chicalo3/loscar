<?php require_once('Connections/conexiontienda.php'); ?>
<?php if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$varCompra_Datoscompra = "0";
if (isset($_GET["recordID"])) {
  $varCompra_Datoscompra = $_GET["recordID"];
}
mysql_select_db($database_conexiontienda, $conexiontienda);
$query_Datoscompra = sprintf("SELECT * FROM tblcompra WHERE tblcompra.idCompra = %s", GetSQLValueString($varCompra_Datoscompra, "int"));
$Datoscompra = mysql_query($query_Datoscompra, $conexiontienda) or die(mysql_error());
$row_Datoscompra = mysql_fetch_assoc($Datoscompra);
$totalRows_Datoscompra = mysql_num_rows($Datoscompra);$varCompra_Datoscompra = "0";
if (isset($_GET["recordID"])) {
  $varCompra_Datoscompra = $_GET["recordID"];
}
mysql_select_db($database_conexiontienda, $conexiontienda);
$query_Datoscompra = sprintf("SELECT * FROM tblcompra WHERE tblcompra.idCompra = %s", GetSQLValueString($varCompra_Datoscompra, "int"));
$Datoscompra = mysql_query($query_Datoscompra, $conexiontienda) or die(mysql_error());
$row_Datoscompra = mysql_fetch_assoc($Datoscompra);
$totalRows_Datoscompra = mysql_num_rows($Datoscompra);

$varCarrito_ProductosCompra = "0";
if (isset($_GET["recordID"])) {
  $varCarrito_ProductosCompra = $_GET["recordID"];
}
$varUsuario_ProductosCompra = "0";
if (isset($row_Datoscompra['idUsuario'])) {
  $varUsuario_ProductosCompra = $row_Datoscompra['idUsuario'];
}
mysql_select_db($database_conexiontienda, $conexiontienda);
$query_ProductosCompra = sprintf("SELECT tblproducto.strNombre, tblproducto.dbPrecio, tblproducto.strImagen,tblcarrito.intCantidad FROM tblcarrito Inner Join tblproducto ON tblcarrito.idProducto = tblproducto.idProducto WHERE tblcarrito.intTransaccionEfectuada =  %s AND tblcarrito.idUsuario =  %s", GetSQLValueString($varCarrito_ProductosCompra, "int"),GetSQLValueString($varUsuario_ProductosCompra, "int"));
$ProductosCompra = mysql_query($query_ProductosCompra, $conexiontienda) or die(mysql_error());
$row_ProductosCompra = mysql_fetch_assoc($ProductosCompra);
$totalRows_ProductosCompra = mysql_num_rows($ProductosCompra);

mysql_select_db($database_conexiontienda, $conexiontienda);
$query_datosusuarios = "SELECT * FROM tblusuario ORDER BY tblusuario.strNombre";
$datosusuarios = mysql_query($query_datosusuarios, $conexiontienda) or die(mysql_error());
$row_datosusuarios = mysql_fetch_assoc($datosusuarios);
$totalRows_datosusuarios = mysql_num_rows($datosusuarios);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/frontend.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Mis Compras</title>
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


  <div class="contenido"><center>
    <table width="100%" border="0">
      <tr>
        <td width="33%"><img src="listacompra.png" width="200" height="150" /></td>
        <td width="67%"><h1>Detalles de Compra</h1><br /></p></td>
      </tr>
    </table>
    <table width="100%" border="0">
      <tr bgcolor="#FFCC66">
        <td width="50">Imagen</td>
        <td width="200">Producto</td>
        <td width="19%">Precio</td>
        <td width="25%">Cantidad</td>
      </tr>
      <?php do { ?>
      <tr  class="productosbrillo">
        <td width="50" height="50"><center>
          <img src="documentos/productos/<?php echo $row_ProductosCompra['strImagen']; ?>" width="50" height="50" />
        </center></td>
        <td width="200"><?php echo $row_ProductosCompra['strNombre']; ?></td>
        <td><?php echo $row_ProductosCompra['dbPrecio']; ?></td>
        <td><?php echo $row_ProductosCompra['intCantidad']; ?></td>
      </tr>
      <tr>
        <?php } while ($row_ProductosCompra = mysql_fetch_assoc($ProductosCompra)); ?>
        <td width="50" align="right">&nbsp;</td>
        <td width="200" align="right">TOTAL:</td>
        <td><?php echo $row_Datoscompra['dblTotal']; ?></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <p>No tienes ninguna compra realizada. </p>
    <p>&nbsp;</p>
  </center></div>
  <!-- InstanceEndEditable --><!-- InstanceBeginEditable name="EditRegion4" -->
  <div class="login_ok">
    <?php   
if ((isset($_SESSION['MM_Username'])) && ($_SESSION['MM_Username'] != ""))
  {
	  echo "Hola ";
	  echo ObtenerNombreUsuario($_SESSION['MM_IdUsuario']);
	  
	  ?>
    <br />
    <p><a href="usuario_cerrar_sesion.php"><span class="salir_sesion">Salir</span></a> - <a href="usuario_modificacion.php"><span class="salir_sesion">Cambiar mis datos</span></a></p>
    <p><a href="carrito_lista.php">Ver mi Carrito</a></p>
    <p><a href="usuario_compras.php">Ver Mis Compras<br />
    </a></p>
    <?php

  }
  else
  {?>
  </div>
  
  <div class="menu-derecha"><?php include("login.php"); ?></div>
</span>
<?php }?>

</body><!-- InstanceEndEditable -->
<!-- InstanceEnd --></html>
<?php
mysql_free_result($ProductosCompra);
?>
