<?php require_once('Connections/conexiontienda.php'); ?>
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
}

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
}

mysql_select_db($database_conexiontienda, $conexiontienda);
$query_Recordset1 = "SELECT * FROM tblcategoria ORDER BY tblcategoria.strdescripcion ASC";
$Recordset1 = mysql_query($query_Recordset1, $conexiontienda) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$varProducto_datosproductos = "0";
if (isset($_GET["img"])) {
  $varProducto_datosproductos = $_GET["img"];
}
mysql_select_db($database_conexiontienda, $conexiontienda);
$query_datosproductos = sprintf("SELECT * FROM tblproducto WHERE tblproducto.idproducto = %s", GetSQLValueString($varProducto_datosproductos, "int"));
$datosproductos = mysql_query($query_datosproductos, $conexiontienda) or die(mysql_error());
$row_datosproductos = mysql_fetch_assoc($datosproductos);
$totalRows_datosproductos = mysql_num_rows($datosproductos);

$varOferta_DatosOferta = "0";
if (isset($_GET["oferta"])) {
  $varOferta_DatosOferta = $_GET["oferta"];
}
mysql_select_db($database_conexiontienda, $conexiontienda);
$query_DatosOferta = sprintf("SELECT * FROM tblproducto WHERE tblproducto.idProducto = %s", GetSQLValueString($varOferta_DatosOferta, "int"));
$DatosOferta = mysql_query($query_DatosOferta, $conexiontienda) or die(mysql_error());
$row_DatosOferta = mysql_fetch_assoc($DatosOferta);
$totalRows_DatosOferta = mysql_num_rows($DatosOferta);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>

<center><img src="documentos/productos/<?php echo $row_datosproductos['strImagen']; ?>" width="491" height="511" /></center>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($datosproductos);

mysql_free_result($DatosOferta);
?>
