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

mysql_select_db($database_conexiontienda, $conexiontienda);
$query_DatosUsuarios = "SELECT * FROM tblusuario ORDER BY tblusuario.strApellido";
$DatosUsuarios = mysql_query($query_DatosUsuarios, $conexiontienda) or die(mysql_error());
$row_DatosUsuarios = mysql_fetch_assoc($DatosUsuarios);
$totalRows_DatosUsuarios = mysql_num_rows($DatosUsuarios);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/backend.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Lista de Usuarios</title>
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
    <table width="100%" border="0">
      <tr>
        <td width="33%"><h1>Lista de Usuarios</h1> </td>
        <td width="67%"><img src="../clientes.jpg" width="151" height="151" /></td>
      </tr>
    </table>
    <table width="100%" border="1">
      <tr bgcolor="#FFCC33">
        <td>Id</td>
        <td>Nombre</td>
        <td>Apellidos</td>
        <td>Usuario</td>
        <td>Contraseña</td>
        <td>Telefono</td>
        <td>Email</td>
        <td>Direccion</td>
        <td>Acciones</td>
      </tr>
      <?php do { ?>
        <tr class="productosbrillo">
          <td><?php echo $row_DatosUsuarios['idUsuario']; ?></td>
          <td><?php echo $row_DatosUsuarios['strNombre']; ?></td>
          <td><?php echo $row_DatosUsuarios['strApellido']; ?></td>
          <td><?php echo $row_DatosUsuarios['strUsuario']; ?></td>
          <td><?php echo $row_DatosUsuarios['strPassword']; ?></td>
          <td><?php echo $row_DatosUsuarios['intTelefono']; ?></td>
          <td><?php echo $row_DatosUsuarios['strEmail']; ?></td>
          <td><?php echo $row_DatosUsuarios['strDireccion']; ?></td>
          <td>Editar - Eliminar</td>
        </tr>
        <?php } while ($row_DatosUsuarios = mysql_fetch_assoc($DatosUsuarios)); ?>
    </table>
    <p>&nbsp;</p>
  </div>
  <!-- InstanceEndEditable --></div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($DatosUsuarios);
?>
