<link href="../estilos.css" rel="stylesheet" type="text/css" />
<style type="text/css">
a:link {
	text-decoration: none;
	color: #FFF;
}
a:visited {
	text-decoration: none;
	color:#FFF
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
	font-size: 14px;
}
</style>
<?php require_once('Connections/conexiontienda.php'); ?>
<?php
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


$query_Recordset1 = "SELECT * FROM tblcategoria ORDER BY tblcategoria.strDescripcion";
$Recordset1 = mysqli_query($conexiontienda,$query_Recordset1) or die(mysqli_error($conexiontienda));
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<?php do { ?>
<table width="200" border="0">
    <tr>
      <td><div class="boton-menu-lateral">
        <div class="brillo"><a href="categoria_ver.php?cat=<?php echo $row_Recordset1['idCategoria']; ?>"><?php echo $row_Recordset1['strDescripcion']; ?></a></div>
        </div>
      </td>
    </tr>
  </table>
  <?php } while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1)); ?>
<?php
mysql_free_result($Recordset1);
?>
