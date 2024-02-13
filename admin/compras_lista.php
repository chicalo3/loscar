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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_Recordset1 = 9;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_conexiontienda, $conexiontienda);
$query_Recordset1 = "SELECT * FROM tblcompra ORDER BY fchCompra DESC";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $conexiontienda) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;

mysql_select_db($database_conexiontienda, $conexiontienda);
$query_Recordset2 = "SELECT * FROM tblproducto ORDER BY tblproducto.strNombre";
$Recordset2 = mysql_query($query_Recordset2, $conexiontienda) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

$varCompra_Datoscompra = "0";
if (isset($_GET["recordID"])) {
  $varCompra_Datoscompra = $_GET["recordID"];
}
mysql_select_db($database_conexiontienda, $conexiontienda);
$query_Datoscompra = sprintf("SELECT * FROM tblcompra WHERE tblcompra.idCompra = %s", GetSQLValueString($varCompra_Datoscompra, "int"));
$Datoscompra = mysql_query($query_Datoscompra, $conexiontienda) or die(mysql_error());
$row_Datoscompra = mysql_fetch_assoc($Datoscompra);
$totalRows_Datoscompra = mysql_num_rows($Datoscompra);

$queryString_Recordset1 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset1") == false && 
        stristr($param, "totalRows_Recordset1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset1 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset1 = sprintf("&totalRows_Recordset1=%d%s", $totalRows_Recordset1, $queryString_Recordset1);
?>
    <script type="text/javascript">
            var int=self.setInterval("refresh()",60000);
            function refresh()
            {
                    location.reload(true);
            }
    </script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/backend.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Lista de Pedidos</title>
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
  <div class="contenido-admin"><center>
    <table width="100%" border="0">
      <tr>
        <td height="168"><h1>Lista de Pedidos </h1></td>
        <td><img src="../zonapedidos.png" width="248" height="164" /></td>
      </tr>
    </table></center>
    <table width="100%" border="1">
      <tr bgcolor="#FFCC66">
        <td>Cliente</td>
        <td>Forma de Pago</td>
        <td>Fecha</td>
        <td>Estado</td>
        <td>Acciones</td>
      </tr>
      <?php do { ?>
        <tr class="productosbrillo">
          <td><?php echo ObtenerNombreUsuario($row_Recordset1['idUsuario']); ?></td>
          <td><?php echo TextoFormaPago($row_Recordset1['intTipoPago']); ?></td>
          <td><?php echo $row_Recordset1['fchCompra']; ?></td>
          <td><?php echo TextoEstadoCompra($row_Recordset1['intEstado']); ?></td>
          <td><a href="compras_edit.php?recordID=<?php echo $row_Recordset1['idCompra']; ?>">Ver</a></td>
        </tr>
        <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
    </table>
    <p>&nbsp;    
    <table border="0">
      <tr>
        <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>"><img src="First.gif" /></a>
        <?php } // Show if not first page ?></td>
        <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>"><img src="Previous.gif" /></a>
        <?php } // Show if not first page ?></td>
        <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
            <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>"><img src="Next.gif" /></a>
        <?php } // Show if not last page ?></td>
        <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
            <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>"><img src="Last.gif" /></a>
        <?php } // Show if not last page ?></td>
      </tr>
    </table>
    </p>
  </div>
  <!-- InstanceEndEditable --></div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Datoscompra);
?>
