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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO tblusuario (strNombre, strApellido, strUsuario, strPassword, intTelefono, strEmail, strDireccion) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['strNombre'], "text"),
                       GetSQLValueString($_POST['strApellido'], "text"),
                       GetSQLValueString($_POST['strUsuario'], "text"),
                       GetSQLValueString($_POST['strPassword'], "text"),
                       GetSQLValueString($_POST['intTelefono'], "int"),
                       GetSQLValueString($_POST['strEmail'], "text"),
                       GetSQLValueString($_POST['strDireccion'], "text"));

  mysql_select_db($database_conexiontienda, $conexiontienda);
  $Result1 = mysql_query($insertSQL, $conexiontienda) or die(mysql_error());

  $insertGoTo = "gracias_registro.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- InstanceBegin template="/Templates/frontend.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Documento sin título</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<!-- InstanceEndEditable -->
<link href="estilos.css" rel="stylesheet" type="text/css" />
<link href="menu/index_files/mbcsmbmcp.css" rel="stylesheet" type="text/css" />
<style type="text/css">
</style>
<!-- InstanceBeginEditable name="head" -->
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
      <input name="FBuscar" type="text" id="textfield" />
      <center>
        <input type="submit" name="button" id="button" value="Buscar" />
      </center>
    </form><?php include("includes/catalogo.php"); ?>
  </div>
</div>
<div class="menu-centro">
  <ul id="mbmcpebul_table" class="mbmcpebul_menulist css_menu" style="width: 539px; height: 30px;">
    <li class="topitem spaced_li">
      <div class="buttonbg" style="width: 59px;"><a>Inicio</a></div>
    </li>
    <li class="topitem spaced_li">
      <div class="buttonbg" style="width: 130px;"><a>Quienes Somos<br />
      </a></div>
    </li>
    <li class="topitem spaced_li">
      <div class="buttonbg" style="width: 125px;"><a>Como Comprar<br />
      </a></div>
    </li>
    <li class="topitem spaced_li">
      <div class="buttonbg"><a>forma de Pago</a></div>
    </li>
    <li class="topitem">
      <div class="buttonbg" style="width: 82px;"><a>Contacto</a></div>
    </li>
  </ul>
  <!-- Menus will work without this javascript file. It is used only for extra
     effects, improved usability and compatibility with very old web browsers. -->
  <script type="text/javascript" src="index_files/mbjsmbmcp.js"></script>
</div>
<!-- InstanceBeginEditable name="EditRegion3" -->
<div class="contenido">
  <div class="alta-usuario">
    <h3>REGISTRO </h3>
    <p>&nbsp;</p>
    <form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
      <table align="center">
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">StrNombre:</td>
          <td><span id="sprytextfield1">
            <input type="text" name="strNombre" value="" size="32" />
          <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">StrApellido:</td>
          <td><span id="sprytextfield2">
            <input type="text" name="strApellido" value="" size="32" />
          <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">StrUsuario:</td>
          <td><span id="sprytextfield3">
            <input type="text" name="strUsuario" value="" size="32" />
          <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">StrPassword:</td>
          <td><span id="sprytextfield4">
            <input type="password" name="strPassword" value="" size="32" />
          <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">IntTelefono:</td>
          <td><span id="sprytextfield5">
          <input type="text" name="intTelefono" value="" size="32" />
          <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">StrEmail:</td>
          <td><span id="sprytextfield6">
          <input type="text" name="strEmail" value="" size="32" />
          <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">StrDireccion:</td>
          <td><span id="sprytextfield7">
            <input type="text" name="strDireccion" value="" size="32" />
          <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">&nbsp;</td>
          <td><input type="submit" value="Insertar registro" /></td>
        </tr>
      </table>
      <input type="hidden" name="MM_insert" value="form2" />
    </form>
    <p>&nbsp;</p>
  </div>
</div>
<!-- InstanceEndEditable --><!-- InstanceBeginEditable name="EditRegion4" -->
<div class="login_ok"></div>
<div class="menu-derecha"></div>
</span>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "integer");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "email");
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7");
</script>
</body>
<!-- InstanceEndEditable --> <!-- InstanceEnd -->
</html>
