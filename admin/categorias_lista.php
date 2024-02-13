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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO tblcategoria (strDescripcion) VALUES (%s)",
                       GetSQLValueString($_POST['strDescripcion'], "text"));

  mysql_select_db($database_conexiontienda, $conexiontienda);
  $Result1 = mysql_query($insertSQL, $conexiontienda) or die(mysql_error());

  $insertGoTo = "categorias_add.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_conexiontienda, $conexiontienda);
$query_consultacategorias = "SELECT * FROM tblcategoria ORDER BY tblcategoria.strDescripcion";
$consultacategorias = mysql_query($query_consultacategorias, $conexiontienda) or die(mysql_error());
$row_consultacategorias = mysql_fetch_assoc($consultacategorias);
$totalRows_consultacategorias = mysql_num_rows($consultacategorias);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/backend.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Lista de Categorias</title>
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
    <h1>Lista de Categorias</h1>
    <p><a href="categorias_add.php" title="Añadir Categoria"><img src="../añadir.png" width="51" height="51" /></a></p>
    <table width="500" border="1" align="center">
      <tr bgcolor="#FFCC66">
        <td>Id</td>
        <td>Nombre</td>
        <td>Acciones </td>
      </tr><?php $sumatotal = 0;
           $sumatotal = $sumatotal + $row_consultacategorias['strDescripcion']; ?>
      <?php do { ?>
        <tr class="productosbrillo">
          
          <td><?php echo $row_consultacategorias['idCategoria']; ?></td>
          <td><?php echo $row_consultacategorias['strDescripcion']; ?></td>
          <td><a href="categorias_edit.php?recordID=<?php echo $row_consultacategorias['idCategoria']; ?>">Editar</a> - <a href="categorias_delete.php?recordID=<?php echo $row_consultacategorias['idCategoria']; ?>">Eliminar</a></td>
        </tr>
        <?php } while ($row_consultacategorias = mysql_fetch_assoc($consultacategorias)); ?>
    </table>
    <p><?php echo $sumatotal; ?></p>
<p></p>
  </div>
  <!-- InstanceEndEditable --></div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($consultacategorias);
?>
