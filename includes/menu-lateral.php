<?php require_once('./Connections/conexiontienda.php'); ?>
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
$query_Recordset1 = "SELECT * FROM tblcategoria ORDER BY tblcategoria.strDescripcion";
$Recordset1 = mysql_query($query_Recordset1, $conexiontienda) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<table width="200" border="0">
    <tr>
      <td>
        </div>
      </td>
    </tr>
  </table>
<?php
mysql_free_result($Recordset1);
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Untitled</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="mbcsmbmcp.css" type="text/css" />
</head>
<body>


<ul id="mbmcpebul_table" class="mbmcpebul_menulist css_menu" style="width: 150px; height: 25px;">
  
      <a><div class="buttonimg buttonimg_20" style="width: 150px; background-image: url('mb_button.gif')"><a href="categoria_ver.php?cat=<?php echo $row_Recordset1['idCategoria']; ?>"><?php echo $row_Recordset1['strDescripcion']; ?></a></div></a>
      
</ul>
<!-- Menus will work without this javascript file. It is used only for extra
     effects, improved usability and compatibility with very old web browsers. -->
<script type="text/javascript" src="mbjsmbmcp.js"></script>
</body>
</html>
