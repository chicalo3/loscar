<?php require_once('../Connections/conexiontienda.php'); ?>
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
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/backend.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Acciones Compra</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<link href="../estilos-admin.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="contenedor-admin">
  <div class="cabecera-admin">
   <div class="logo-admin"><img src="../fotos-productos/gestiondeuda.jpeg" width="275" height="137" /></div>
    <div class="texto-administracion"><h2>ADMINISTRACION</h2></div>
    
  </div>
  <div class="icono-home"><a href="index.php" title="Inicio"></a></div>
  <!-- InstanceBeginEditable name="EditRegion3" -->
  <div class="contenido-admin">
    <div class="consultar-compra">
    <p>&nbsp;</p>
    <table width="100%" border="0">
      <tr>
        <td width="15%" align="right">Nombre:</td>
        <td width="85%"><?php echo ObtenerNombreUsuario($row_Datoscompra['idUsuario']); ?></td>
        
        
         
      <tr>
        <td align="right">Email:</td>
        <td><?php 
		ObtenerMailUsuario($row_Datoscompra['idUsuario'])
		?></td>
      <tr>
        <td align="right">Fecha:</td>
        <td><?php echo $row_Datoscompra['fchCompra']; ?></td>
      </tr>
      <tr>
        <td align="right">Forma de Pago:</td>
        <td><?php echo TextoFormaPago($row_Datoscompra['intTipoPago']); ?></td>
      </tr>
      <tr>
        <td align="right">Total:</td>
        <td><?php echo $row_Datoscompra['dblTotal']; ?></td>
      </tr>
    </table>
    <p>Estado Actual de la Compra:<span style="font-style:italic"><?php echo TextoEstadoCompra($row_Datoscompra['intEstado']); ?></span></p>
    
      
      
      
      
      <a href="compra_aceptar.php?recordID=<?php echo $row_Datoscompra['idCompra']; ?>"><div class="confirmarpedido"></div></a>
<a href="compra_cancelar.php?recordID=<?php echo $row_Datoscompra['idCompra']; ?>">
      <div class="cancelarpedido"></div></a>
    <p>&nbsp;</p>
    <p>Productos:</p>
    <table border="1">
      <tr bgcolor="#FFF5A6">
        <td>Imagen</td>
        <td>Producto</td>
        <td nowrap="nowrap">Precio</td>
        <td nowrap="nowrap">Cantidad</td>
      </tr>
      <?php do { ?>
        <tr class="productosbrillo"bgcolor="#FFFBE2">
          <td><img src="../documentos/productos/<?php echo $row_ProductosCompra['strImagen']; ?>" width="80" height="80" /></td>
          <td><?php echo $row_ProductosCompra['strNombre']; ?></td>
          <td align="center" nowrap="nowrap"><?php echo $row_ProductosCompra['dbPrecio']; ?></td>
          <td align="center" nowrap="nowrap"><?php echo $row_ProductosCompra['intCantidad']; ?></td>
        </tr>
        <?php } while ($row_ProductosCompra = mysql_fetch_assoc($ProductosCompra)); ?>
      <tr>
        <td align="right">&nbsp;</td>
        <td align="right">Total:</td>
        <td nowrap="nowrap"><?php echo $row_Datoscompra['dblTotal']; ?></td>
        <td nowrap="nowrap">&nbsp;</td>
    </tr>
    </table>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p></div>
    
  </div>
  <!-- InstanceEndEditable --></div>
</body>
<!-- InstanceEnd --></html>
<?php


mysql_free_result($ProductosCompra);

mysql_free_result($datosusuarios);

mysql_free_result($Datoscompra);
?>
