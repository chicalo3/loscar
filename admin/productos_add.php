<?php require_once('../Connections/conexiontienda.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO tblproducto (strNombre, strDescripcion, strDescripcion2, strSEO, dbPrecio, intEstado, intCategoria, intStock, strImagen) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
GetSQLValueString($_POST['strNombre'], "text"),
GetSQLValueString($_POST['strDescripcion'], "text"),
GetSQLValueString($_POST['strDescripcion2'], "text"),
GetSQLValueString($_POST['strSEO'], "text"),
 GetSQLValueString($_POST['dbPrecio'], "double"),
GetSQLValueString($_POST['intEstado'], "int"),
GetSQLValueString($_POST['intCategoria'], "int"),
GetSQLValueString($_POST['intStock'], "int"),
GetSQLValueString($_POST['strImagen'], "text"));

  
  $Result1 = mysqli_query($conexiontienda,$insertSQL) or die(mysqli_error($conexiontienda));

  $insertGoTo = "productos_lista.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}


$query_ConsultaCategorias = "SELECT * FROM tblcategoria ORDER BY tblcategoria.strDescripcion";
$ConsultaCategorias = mysqli_query($conexiontienda,$query_ConsultaCategorias) or die(mysqli_error($conexiontienda));
$row_ConsultaCategorias = mysqli_fetch_assoc($ConsultaCategorias);
$totalRows_ConsultaCategorias = mysqli_num_rows($ConsultaCategorias);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/backend.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Añadir Productos</title>
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
  <!-- InstanceBeginEditable name="EditRegion3" --><script>
function subirimagen()
{
	self.name = 'opener';
	remote = open('gestionimagen.php', 'remote', 'width=400,height=150,location=no,scrollbars=yes,menubars=no,toolbars=no,resizable=yes,fullscreen=no, status=yes');
 	remote.focus();
	}

</script>
 <div class="contenido-admin">
    <h1>Añadir Registro<img src="../wood_box_with_add_sign_5004.jpg" width="100" height="100" /></h1>
    <p>&nbsp;</p>
    <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
      <table align="center">
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">MES:</td>
          <td><input type="text" name="strNombre" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">FECHA:</td>
          <td><input type="text" name="strDescripcion" value="" size="32" /></td>
        </tr><tr valign="baseline">
          <td align="right" valign="middle" nowrap="nowrap">OBSERVACIONES:</td>
          <td><label for="strDescripcion2"></label>
          <textarea name="strDescripcion2"cols="45" rows="5"></textarea></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">CANTIDAD:</td>
          <td><input type="text" name="dbPrecio" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">FACTURA:</td>
          <td><input type="text" name="strImagen" value="" size="32" /><input type="button" name="button" id="button" value="Subir Imagen" onclick="javascript:subirimagen();"/></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">&nbsp;</td>
          <td><input type="submit" value="Insertar registro" /></td>
        </tr>
      </table>
      <input type="hidden" name="MM_insert" value="form1" />
    </form>
    <p>&nbsp;</p>
<p>&nbsp;</p>
  </div>
  <!-- InstanceEndEditable --></div>
</body>
<!-- InstanceEnd --></html>
<?php
mysqli_free_result($ConsultaCategorias);
?>
