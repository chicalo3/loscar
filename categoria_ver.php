<?php require_once('Connections/conexiontienda.php'); ?>
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

$varCategoria_DatosProductos = "0";
if (isset($_GET["cat"])) {
  $varCategoria_DatosProductos = $_GET["cat"];
}
mysql_select_db($database_conexiontienda, $conexiontienda);
$query_DatosProductos = sprintf("SELECT * FROM tblproducto WHERE tblproducto.intCategoria = %s", GetSQLValueString($varCategoria_DatosProductos, "int"));
$DatosProductos = mysql_query($query_DatosProductos, $conexiontienda) or die(mysql_error());
$row_DatosProductos = mysql_fetch_assoc($DatosProductos);
$totalRows_DatosProductos = mysql_num_rows($DatosProductos);

$varCategoria_Recordset2 = "0";
if (isset($_GET["cat"])) {
  $varCategoria_Recordset2 = $_GET["cat"];
}
mysql_select_db($database_conexiontienda, $conexiontienda);
$query_Recordset2 = sprintf("SELECT * FROM tblcategoria WHERE tblcategoria.idCategoria = %s", GetSQLValueString($varCategoria_Recordset2, "int"));
$Recordset2 = mysql_query($query_Recordset2, $conexiontienda) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/frontend.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Productos</title>
<!-- InstanceEndEditable -->
<link href="estilos.css" rel="stylesheet" type="text/css" />
<link href="menu/index_files/mbcsmbmcp.css" rel="stylesheet" type="text/css" />
<style type="text/css">
</style>
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>
<div class="contenedor">
  <div class="cabecera">
    <div class="logo"><img src="logo.png" width="260" height="70" /></div>
    <div class="imagen-cabecera"><img src="IMAGEN-CABECERA.png" width="400" height="70" /></div>
    <div class="horarios"><img src="horarios.png" width="260" height="70" /></div>
  </div>
  <div class="menu-lateral">
    <div class="categoria">CATEGORIAS</div>
    <div class="buscador"><br />
     
      <form id="form1" name="form1" method="get" action="categoria_resultados.php">
        <label for="textfield"></label>
        <input name="FBuscar" type="text" id="textfield" size="17px"/>
          <center><input type="submit" name="button" id="button" value="Buscar" /></center>
      </form><?php include("includes/catalogo.php"); ?>
    </div>
 
       
</div>
<div class="menu-centro"><ul id="mbmcpebul_table" class="mbmcpebul_menulist css_menu" style="width: 539px; height: 30px;">
  <li class="topitem spaced_li"><div class="buttonbg" style="width: 59px;"><a>Inicio</a></div></li>
  <li class="topitem spaced_li"><div class="buttonbg" style="width: 130px;"><a>Quienes Somos<br /></a></div></li>
  <li class="topitem spaced_li"><div class="buttonbg" style="width: 125px;"><a>Como Comprar<br /></a></div></li>
  <li class="topitem spaced_li"><div class="buttonbg"><a>forma de Pago</a></div></li>
  <li class="topitem"><div class="buttonbg" style="width: 82px;"><a>Contacto</a></div></li>
</ul>
<!-- Menus will work without this javascript file. It is used only for extra
     effects, improved usability and compatibility with very old web browsers. -->
<script type="text/javascript" src="index_files/mbjsmbmcp.js"></script></div>
<!-- InstanceBeginEditable name="EditRegion3" -->
  <div class="contenido">
    
    <div class="nombre-categoria"><?php echo $row_Recordset2['strDescripcion']; ?></div>
    <?php if ($totalRows_DatosProductos == 0) { // Show if recordset empty ?>
      <div id="nohayproductos">Todavia no hay productos de esta categoria</div>
<?php } // Show if recordset empty ?>
    <?php do { ?>
        <?php if ($totalRows_DatosProductos > 0) { // Show if recordset not empty ?>
  <div class="producto">
    <div class="marco-producto">
      <div class="foto-producto"><img src="documentos/productos/<?php echo $row_DatosProductos['strImagen']; ?>?var=<?php echo $row_DatosProductos['idProducto']; ?>" width="130" height="125" /></div>
      </div>
    <div class="descripcion-producto">
      <strong><?php echo $row_DatosProductos['strNombre']; ?></strong><br>
	   <?php echo $row_DatosProductos['strDescripcion']; ?>
      
      
    </div><center><div class="stock"><?php 
if  ($row_DatosProductos['intStock'] >0)
{
	echo '<span style="color:#0C3">Disponible</span>';
	}
	
	 else { 
	 
	 echo '<span style="color:#F00">No disponible</span>';
	 
	 }
	 ?>

</div></center>
    <div class="precio-producto"><?php echo $row_DatosProductos['dbPrecio']; ?> Bs<div class="boton-comprar"><a href="producto_detalle.php?recordID=<?php echo $row_DatosProductos['idProducto']; ?>"><img src="detalles.png" width="190" height="30" /></a></div></div>
    
    
  </div>
  <?php } // Show if recordset not empty ?>
<?php } while ($row_DatosProductos = mysql_fetch_assoc($DatosProductos)); ?>
  </div>
  <!-- InstanceEndEditable --><!-- InstanceBeginEditable name="EditRegion4" -->
  <div class="login_ok">
    <?php   
if ((isset($_SESSION['MM_Username'])) && ($_SESSION['MM_Username'] != ""))
  {
	  echo "Hola ";
	  echo ObtenerNombreUsuario($_SESSION['MM_IdUsuario']);
	  
	  ?>
    <br />
    <p><a href="usuario_cerrar_sesion.php"><span class="salir_sesion">Salir</span></a> - <a href="usuario_modificacion.php"><span class="salir_sesion">Cambiar mis datos</span></a></p>
    <p><a href="carrito_lista.php">Ver mi Carrito</a></p>
    <p><a href="usuario_compras.php">Ver Mis Compras<br />
    </a></p>
    <?php

  }
  else
  {?>
  </div>
  
  <div class="menu-derecha"><?php include("login.php"); ?></div>
</span>
<?php }?>

</body><!-- InstanceEndEditable -->
<!-- InstanceEnd --></html>
<?php




mysql_free_result($DatosProductos);


mysql_free_result($Recordset2);
?>
