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


$query_Recordset1 = "SELECT * FROM tblproducto ORDER BY tblproducto.idProducto DESC";
$Recordset1 = mysqli_query($conexiontienda,$query_Recordset1) or die(mysqli_error($conexiontienda));
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);

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
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PAGO DEUDA</title>
<link href="oneColFixCtr.css" rel="stylesheet" type="text/css" />
</head>
 <script>
function ampliarimagen()
{
	self.name = 'opener';
	remote = open('ampliar_imagen.php', 'remote', 'width=400,height=150,location=no,scrollbars=yes,menubars=no,toolbars=no,resizable=yes,fullscreen=no, status=yes');
 	remote.focus();
	}

</script>
  <script type="text/javascript" src="mbjsmbrfzq.js"></script>
<body>

<div class="container">
<div class="content">

  <center><div class="tabla">
  <table width="210" border="0" align="right">
  <tr>
    <td width="200" bgcolor="#FF9999">TOTAL DEUDA</td>
  </tr>
  <tr>
 <?php  $totaldeuda = 13000;?>
 <?php  $pordevolver = $totaldeuda - $sumatotal; ?>
    <td align="center" bgcolor="#FF0000"><?php echo $totaldeuda; ?> €</td>
   
  </tr>
  <tr>
    <td bgcolor="#FF9999">TOTA PAGADO</td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FF0000"><?php echo  $sumatotal . "<br>"; ?> €</td>
  </tr>
  <tr>
    <td bgcolor="#FF9999">POR DEVOLVER</td>
  </tr>
  <tr>
    <td height="29" align="center" bgcolor="#FF0000"><?php echo $pordevolver ;?> €</td>
  </tr>
</table><div/><h1>Pago Deuda
 </h1></center>
 

  <p><div class="contenido-admin"><center>
    </center>
    <p></p>
    <table width="60%" border="0" align="center">
      <tr align="center" bgcolor="#FFCC66">
        <td>MES</td>
        <td>FECHA</td>
        <td>CANTIDAD</td>
        <td>OBSERVACIONES</td>
        <td>FACTURA</td>
        
      </tr><?php do { ?>
      <tr class="productosbrillo">
        
          <td align="center"><?php echo $row_Recordset1['strNombre']; ?></td>
          <td align="center"><?php echo $row_Recordset1['strDescripcion']; ?></td>
          <td align="center"><?php echo $row_Recordset1['dbPrecio']; ?> €</td>
          <td align="center"><?php echo $row_Recordset1['strDescripcion2']; ?></td>
          <td align="center"><a href="ampliar_imagen.php?img=<?php echo $row_Recordset1['idProducto']; ?>"><img src="documentos/productos/<?php echo $row_Recordset1['strImagen']; ?>" width="50" height="50" border="0"></a></a></a> </td>
          <td align="center">&nbsp;</td>
          
          
      </tr><?php } while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1)); ?>
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
<!-- InstanceEndEditable --></div>
</body>
<!-- InstanceEnd --></html>
<?php
mysqli_free_result($Recordset1);
?></p></p>
    <!-- end .content --></div>
  <!-- end .container --></div>
</body>
</html>