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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tblcategoria SET strDescripcion=%s WHERE idCategoria=%s",
                       GetSQLValueString($_POST['strDescripcion'], "text"),
                       GetSQLValueString($_POST['idCategoria'], "int"));

  mysql_select_db($database_conexiontienda, $conexiontienda);
  $Result1 = mysql_query($updateSQL, $conexiontienda) or die(mysql_error());

  $updateGoTo = "categorias_lista.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$varCategoria_Recordset1 = "0";
if (isset($_GET["recordID"])) {
  $varCategoria_Recordset1 = $_GET["recordID"];
}
mysql_select_db($database_conexiontienda, $conexiontienda);
$query_Recordset1 = sprintf("SELECT * FROM tblcategoria WHERE tblcategoria.idCategoria = %s", GetSQLValueString($varCategoria_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $conexiontienda) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/backend.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Editar Categoria</title>
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
    <h1>Editar Categoria</h1>
    <p>&nbsp;</p>
    <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
      <table align="center">
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">StrDescripcion:</td>
          <td><input type="text" name="strDescripcion" value="<?php echo htmlentities($row_Recordset1['strDescripcion'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">&nbsp;</td>
          <td><input type="submit" value="Actualizar registro" /></td>
        </tr>
      </table>
      <input type="hidden" name="MM_update" value="form1" />
      <input type="hidden" name="idCategoria" value="<?php echo $row_Recordset1['idCategoria']; ?>" />
    </form>
    <p>&nbsp;</p>
  </div>
  <!-- InstanceEndEditable --></div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($Recordset1);
?>
