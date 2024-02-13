<?php require_once('../Connections/conexiontienda.php'); ?>

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
?>
<?php
$varProducto_DatosProducto = "0";
if (isset($_GET["recordID"])) {
  $varProducto_DatosProducto = $_GET["recordID"];
}
mysql_select_db($database_conexiontienda, $conexiontienda);
$query_DatosProducto = sprintf("SELECT * FROM tblproducto WHERE tblproducto.idProducto = %s", GetSQLValueString($varProducto_DatosProducto, "int"));
$DatosProducto = mysql_query($query_DatosProducto, $conexiontienda) or die(mysql_error());
$row_DatosProducto = mysql_fetch_assoc($DatosProducto);
$totalRows_DatosProducto = mysql_num_rows($DatosProducto);
?>
?>
<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
?>
<?php
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tblproducto SET strNombre=%s, strDescripcion=%s, strDescripcion2=%s, dbPrecio=%s, strImagen=%s WHERE idProducto=%s",
                       GetSQLValueString($_POST['strNombre'], "text"),
                       GetSQLValueString($_POST['strDescripcion'], "text"),
                       GetSQLValueString($_POST['strDescripcion2'], "text"),
                       GetSQLValueString($_POST['dbPrecio'], "double"),
                       GetSQLValueString($_POST['strImagen'], "text"),
                       GetSQLValueString($_POST['idProducto'], "int"));

  mysql_select_db($database_conexiontienda, $conexiontienda);
  $Result1 = mysql_query($updateSQL, $conexiontienda) or die(mysql_error());

  $updateGoTo = "productos_lista.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/backend.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Editar Productos</title>
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
    <center><script>
function subirimagen()
{
	self.name = 'opener';
	remote = open('gestionimagen.php', 'remote', 'width=400,height=150,location=no,scrollbars=yes,menubars=no,toolbars=no,resizable=yes,fullscreen=no, status=yes');
 	remote.focus();
	}

</script>
      <h1>Editar Registro</h1></center>
    
    
    <p>&nbsp;</p>
    <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
      <table align="center">
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">MES:</td>
          <td><input type="text" name="strNombre" value="<?php echo htmlentities($row_DatosProducto['strNombre'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">FECHA:</td>
          <td><input type="text" name="strDescripcion" value="<?php echo htmlentities($row_DatosProducto['strDescripcion'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">OBSERVACIONES:</td>
          <td><input type="text" name="strDescripcion2" value="<?php echo htmlentities($row_DatosProducto['strDescripcion2'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">CANTIDAD:</td>
          <td><input type="text" name="dbPrecio" value="<?php echo htmlentities($row_DatosProducto['dbPrecio'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">FACTURA:</td>
          <td><input type="text" name="strImagen" value="<?php echo htmlentities($row_DatosProducto['strImagen'], ENT_COMPAT, 'utf-8'); ?>" size="32" /><input type="button" name="button" id="button" value="Subir Imagen" onclick="javascript:subirimagen();" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">&nbsp;</td>
          <td><input type="submit" value="Actualizar registro" /></td>
        </tr>
      </table>
      <input type="hidden" name="MM_update" value="form1" />
      <input type="hidden" name="idProducto" value="<?php echo $row_DatosProducto['idProducto']; ?>" />
    </form>
    <p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
  </div>
  <!-- InstanceEndEditable --></div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($DatosProducto);


?>
