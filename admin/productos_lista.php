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
$query_Recordset1 = "SELECT * FROM tblproducto ORDER BY tblproducto.idProducto DESC";
$Recordset1 = mysql_query($query_Recordset1, $conexiontienda) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

// Inicializar la variable $sumatotal
$sumatotal = 0;

// Realizar la conexión a la base de datos (asegúrate de tener este código en tu archivo PHP)
$servername = "localhost";
$username = "root";
$password = "";
$database = "gestionpago";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consultar y sumar el valor de intStock
$sql = "SELECT * FROM tblproducto";
$result = $conn->query($sql);

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Iterar sobre los resultados y sumar intStock
    while ($row = $result->fetch_assoc()) {
        $sumatotal += $row["dbPrecio"];
    }
} else {
    echo "No se encontraron productos";
}



// Cerrar la conexión
$conn->close();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/backend.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>ADMINISTRACION PAGOS DEUDA</title>
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
    <table border="0" class="contenedor-tabla">
      
       <h1>GESTION DE PAGO</h1>
       
       

     
    </table>
    </center>
    
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p><a href="productos_add.php" title="Añadir Producto"><img src="../añadir.png" width="41" height="40" /></a></p>
    <table width="100%" border="0">
      <tr align="center" bgcolor="#FFCC66">
        <td>MES</td>
        <td>FECHA</td>
        <td>CANTIDAD</td>
        <td>OBSERVACIONES</td>
        <td>FACTURA</td>
        <td>Opciones</td>
      </tr><?php do { ?>
      <tr class="productosbrillo">
        
          <td align="center"><?php echo $row_Recordset1['strNombre']; ?></td>
          <td align="center"><?php echo $row_Recordset1['strDescripcion']; ?></td>
          <td align="center"><?php echo $row_Recordset1['dbPrecio']; ?></td>
          <td align="center"><?php echo $row_Recordset1['strDescripcion2']; ?></td>
          <td align="center"><?php echo $row_Recordset1['strImagen']; ?></td>
          <td align="center"><a href="productos_edit.php?recordID=<?php echo $row_Recordset1['idProducto']; ?>">Editar</a> - Eliminar</td>
          <td align="center"></td>
          
      </tr><?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
    </table>
    <p> </p>   
    <table border="0">
      <tr>
        <td><h2></h2>
        </td>
      </tr>
    </table>
    </p>
  </div>
  <table width="160" border="0">
    <tr>
      <td width="100" align="center" bgcolor="#FFFF99">TOTAL DEUDA</td>
      <td width="70" align="left"><?php  $totaldeuda = 13000;?><?php echo $totaldeuda; ?> €</td>
    </tr>
    <tr>
      <td align="center" bgcolor="#FFFF99">TOTAL PAGADO</td>
      <td align="left"><?php  $pordevolver = $totaldeuda - $sumatotal; ?><?php echo  $sumatotal ; ?> €</td>
    </tr>
    <tr>
      <td align="center" bgcolor="#FFFF99">POR DEVOLVER</td>
      <td align="left"><?php echo $pordevolver ;?> €</td>
    </tr>
  </table>
  <?php echo $totalRows_Recordset1 ?> registros <!-- InstanceEndEditable --></div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($Recordset1);
?>
