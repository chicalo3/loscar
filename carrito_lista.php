<?php require_once('Connections/conexiontienda.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
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
}if (!function_exists("GetSQLValueString")) {
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

$varUsuario_DatosCarrito = "0";
if (isset($_SESSION["MM_IdUsuario"])) {
  $varUsuario_DatosCarrito = $_SESSION["MM_IdUsuario"];
}
mysql_select_db($database_conexiontienda, $conexiontienda);
$query_DatosCarrito = sprintf("SELECT * FROM tblcarrito WHERE tblcarrito.idUsuario = %s AND tblcarrito.intTransaccionEfectuada=0", GetSQLValueString($varUsuario_DatosCarrito, "int"));
$DatosCarrito = mysql_query($query_DatosCarrito, $conexiontienda) or die(mysql_error());
$row_DatosCarrito = mysql_fetch_assoc($DatosCarrito);
$totalRows_DatosCarrito = mysql_num_rows($DatosCarrito);$varUsuario_DatosCarrito = "0";
if (isset($_SESSION["MM_IdUsuario"])) {
  $varUsuario_DatosCarrito = $_SESSION["MM_IdUsuario"];
}
mysql_select_db($database_conexiontienda, $conexiontienda);
$query_DatosCarrito = sprintf("SELECT * FROM tblcarrito WHERE tblcarrito.idUsuario = %s AND tblcarrito.intTransaccionEfectuada=0", GetSQLValueString($varUsuario_DatosCarrito, "int"));
$DatosCarrito = mysql_query($query_DatosCarrito, $conexiontienda) or die(mysql_error());
$row_DatosCarrito = mysql_fetch_assoc($DatosCarrito);
$totalRows_DatosCarrito = mysql_num_rows($DatosCarrito);

$varCategoria_DatosProductos = "0";
if (isset($_GET["cat"])) {
  $varCategoria_DatosProductos = $_GET["cat"];
}
mysql_select_db($database_conexiontienda, $conexiontienda);
$query_DatosProductos = sprintf("SELECT * FROM tblproducto WHERE tblproducto.intCategoria = %s", GetSQLValueString($varCategoria_DatosProductos, "int"));
$DatosProductos = mysql_query($query_DatosProductos, $conexiontienda) or die(mysql_error());
$row_DatosProductos = mysql_fetch_assoc($DatosProductos);
$totalRows_DatosProductos = mysql_num_rows($DatosProductos);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/frontend.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Carrito de la Compra</title>
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
  <script>
function asegurar()
{
   rc = confirm("¿Seguro que desea eliminar este producto?"); 
   return rc;
}
</script>

<script>
function asegurar2()
{
   rc = confirm("¿Seguro que desea vaciar su carrito de la compra?"); 
   return rc;
}
</script>
  <div class="contenido">
    <center><h1><img src="carritocompra.jpg" width="250" height="150" />Carrito de la compra</h1></center>
    <?php if ($totalRows_DatosCarrito > 0) { // Show if recordset not empty ?>
        <a href="carrito_eliminar_todo.php" onclick="javascript:return asegurar2();"><span style="color:#03F">Vaciar el carrito de la compra</span></a>
<table width="97%" border="0" cellpadding="5" cellspacing="1">
  <tr align="center" bgcolor="#FFF17F">
    <td>Producto</td>
    <td>Imagen</td>
    <td>Unidades</td>
      <td>Precio</td>
      <td>Acciones</td>
    </tr> 
    <?php $preciototal=0?>
    <?php do { ?>
      <tr class="productosbrillo" bgcolor="#FFFCE3">
        <?php $preciototal = $preciototal + ObtenerPrecioProducto($row_DatosCarrito['idProducto']) * $row_DatosCarrito['intCantidad'];?>
        <td ><?php echo ObtenerNombreProducto($row_DatosCarrito['idProducto']); ?></td>
        
       
        
        <td ><center><img src="documentos/productos/<?php echo
		ObtenerImagenUsuario($row_DatosCarrito['idProducto']); ?>" width="50" height="50" /></center></td>
        <td align="center"><?php echo $row_DatosCarrito['intCantidad']; ?></td>
        <td align="center"><?php echo ObtenerPrecioProducto( $row_DatosCarrito['idProducto']); ?></td>
        <td> <a href="carrito_eliminar.php?recordID=<?php echo $row_DatosCarrito['intContador']; ?>" onclick="javascript:return asegurar();"><span style="color:#03C">Eliminar</span></a></td>
      </tr>
      
      <?php } while ($row_DatosCarrito = mysql_fetch_assoc($DatosCarrito)); ?><tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right"><h3><strong style="color:#F00">Total:</strong></h3></td>
        <td><h3><strong style="color:#F00">
          <?php 
		$_SESSION["TotalCompra"] = $preciototal;
		echo $preciototal; ?> 
          Bs</strong></h3></td>
        <td>&nbsp;</td>
      </tr>
</table>
      <form id="form2" name="form2" method="post" action="carrito_forma_pago.php">
        <center><input type="submit" name="button2" id="button2" value="Comprar" /></center>
    </form><?php } // Show if recordset not empty ?>
      <center>
        <?php if ($totalRows_DatosCarrito == 0) { // Show if recordset empty ?>
          No tienes ningun producto añadido.
              <?php } // Show if recordset empty ?>
      </center>
<p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
  </div>
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
mysql_free_result($DatosCarrito);

mysql_free_result($DatosProductos);
?>
