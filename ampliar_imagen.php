<?php require_once('Connections/conexiontienda.php'); ?>

<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  global $conexiontienda;
$theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($conexiontienda, $theValue) : mysqli_escape_string($conexiontienda,$theValue);

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

  global $conexionzapatos;
$theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($conexiontienda, $theValue) : mysqli_escape_string($conexiontienda,$theValue);

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


$query_Recordset1 = "SELECT * FROM tblcategoria ORDER BY tblcategoria.strdescripcion ASC";
$Recordset1 = mysqli_query($conexiontienda,$query_Recordset1) or die(mysqli_error($conexiontienda));
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);

$varProducto_datosproductos = "0";
if (isset($_GET["img"])) {
  $varProducto_datosproductos = $_GET["img"];
}

$query_datosproductos = sprintf("SELECT * FROM tblproducto WHERE tblproducto.idproducto = %s", GetSQLValueString($varProducto_datosproductos, "int"));
$datosproductos = mysqli_query($conexiontienda,$query_datosproductos) or die(mysqli_error($conexiontienda));
$row_datosproductos = mysqli_fetch_assoc($datosproductos);
$totalRows_datosproductos = mysqli_num_rows($datosproductos);

$varOferta_DatosOferta = "0";
if (isset($_GET["oferta"])) {
  $varOferta_DatosOferta = $_GET["oferta"];
}

$query_DatosOferta = sprintf("SELECT * FROM tblproducto WHERE tblproducto.idProducto = %s", GetSQLValueString($varOferta_DatosOferta, "int"));
$DatosOferta = mysqli_query($conexiontienda,$query_DatosOferta) or die(mysqli_error($conexiontienda));
$row_DatosOferta = mysqli_fetch_assoc($DatosOferta);
$totalRows_DatosOferta = mysqli_num_rows($DatosOferta);
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
mysqli_free_result($Recordset1);

mysqli_free_result($datosproductos);

mysqli_free_result($DatosOferta);
?>