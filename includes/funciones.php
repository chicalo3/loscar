<link href="../estilos.css" rel="stylesheet" type="text/css" />
<?php
function mysqli_result($res, $row, $field=0) { 
    $res->data_seek($row); 
    $datarow = $res->fetch_array(); 
    return $datarow[$field]; 
}
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



//*********************************************************************************************************************************************

function ObtenerNombreUsuario($identificador)
{
global $conexiontienda;;

$query_ConsultaFuncion = sprintf("SELECT tblusuario.strNombre FROM tblusuario WHERE tblusuario.idUsuario = %s", $identificador);
$ConsultaFuncion = mysqli_query($conexiontienda,$query_ConsultaFuncion) or die(mysqli_error($conexiontienda));
$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
echo $row_ConsultaFuncion['strNombre']; 
mysql_free_result($ConsultaFuncion);
}
//*********************************************************************************************************************************************

function ObtenerNombreCategoria($identificador)
{
global $conexiontienda;;

$query_ConsultaFuncion = sprintf("SELECT tblcategoria.strDescripcion FROM tblcategoria WHERE tblcategoria.idCategoria = %s", $identificador);
$ConsultaFuncion = mysqli_query($conexiontienda,$query_ConsultaFuncion) or die(mysqli_error($conexiontienda));
$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
echo $row_ConsultaFuncion['strDescripcion']; 
mysql_free_result($ConsultaFuncion);
}
//*********************************************************************************************************************************************



function ObtenerMailUsuario($identificador)
{
global $conexiontienda;;

$query_ConsultaFuncion = sprintf("SELECT tblusuario.strEmail FROM tblusuario WHERE tblusuario.idUsuario = %s", $identificador);
$ConsultaFuncion = mysqli_query($conexiontienda,$query_ConsultaFuncion) or die(mysqli_error($conexiontienda));
$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
echo $row_ConsultaFuncion['strEmail']; 
mysql_free_result($ConsultaFuncion);
}
//*********************************************************************************************************************************************

function ObtenerImagenUsuario($identificador)
{
global $conexiontienda;;

$query_ConsultaFuncion = sprintf("SELECT tblproducto.strImagen FROM tblproducto WHERE tblproducto.idProducto = %s", $identificador);
$ConsultaFuncion = mysqli_query($conexiontienda,$query_ConsultaFuncion) or die(mysqli_error($conexiontienda));
$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
echo $row_ConsultaFuncion['strImagen']; 
mysql_free_result($ConsultaFuncion);
}

function Mostrar_Carrito_Imagen($identificador)
{
global $conexiontienda;;

$query_ConsultaFuncion = sprintf("SELECT * FROM tblcarrito WHERE intTransaccionEfectuada = %s", $identificador);
$ConsultaFuncion = mysqli_query($conexiontienda,$query_ConsultaFuncion) or die(mysqli_error($conexiontienda));
$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
echo $row_ConsultaFuncion['idProducto']; 
mysql_free_result($ConsultaFuncion);
}
//*********************************************************************************************************************************************

function ObtenerNombreProducto($identificador)
{
global $conexiontienda;;

$query_ConsultaFuncion = sprintf("SELECT strNombre FROM tblproducto WHERE idProducto = %s", $identificador);
$ConsultaFuncion = mysqli_query($conexiontienda,$query_ConsultaFuncion) or die(mysqli_error($conexiontienda));
$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
echo $row_ConsultaFuncion['strNombre']; 
mysql_free_result($ConsultaFuncion);
}

//*********************************************************************************************************************************************

function ObtenerPrecioProducto($identificador)
{

	global $conexiontienda;;
	
	$query_ConsultaFuncion = sprintf("SELECT dbPrecio FROM tblproducto WHERE idProducto = %s", $identificador);
	$ConsultaFuncion = mysqli_query($conexiontienda,$query_ConsultaFuncion) or die(mysqli_error($conexiontienda));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['dbPrecio']; 
	mysql_free_result($ConsultaFuncion);
}

//*********************************************************************************************************************************************
function ActualizacionCarrito($varcompra)
{
	global $conexiontienda;;
	$updateSQL = sprintf("UPDATE tblcarrito SET intTransaccionEfectuada=%s WHERE idUsuario=%s AND intTransaccionEfectuada = 0",
                       $varcompra,
                      $_SESSION['MM_IdUsuario']);

  
  $Result1 = mysqli_query($conexiontienda,$updateSQL) or die(mysqli_error($conexiontienda));
  

}

//*********************************************************************************************************************************************
function ActualizacionEstadoCarrito($varcompra, $varestado)
{
	
	global $conexiontienda;;
	$updateSQL = sprintf("UPDATE tblcompra SET intEstado=%s WHERE idCompra = %s",
                       $varestado,$varcompra);
  
  $Result1 = mysqli_query($conexiontienda,$updateSQL) or die(mysqli_error($conexiontienda));

}

//*********************************************************************************************************************************************
function ConfirmacionPago($tipopago)
{

	global $conexiontienda;;
	
	$insertSQL = sprintf("INSERT INTO tblcompra (idUsuario, fchCompra , intTipoPago, dblTotal) VALUES (%s,NOW(),%s,%s)",
                       GetSQLValueString($_SESSION['MM_IdUsuario'], "int"),$tipopago, $_SESSION["TotalCompra"]);
					   
					  
  $Result1 = mysqli_query($conexiontienda,$insertSQL) or die(mysqli_error($conexiontienda));
  $ultimacompra = mysqli_insert_id($conexiontienda);
	ActualizacionCarrito($ultimacompra);
	

	
	
}

//*********************************************************************************************************************************************
function EnvioCorreoHTML($destinatario, $contenido)
{

	$mensaje = '<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<table width="600" border="1" cellpadding="3" cellspacing="3">
  <tr>
    <td width="3" height="3"><img src="logo.png" width="260" height="70" /></td>
  </tr>
  <tr>
    <td width="3" height="3"><p>Estimado Cliente:</p>
    <p>';
	$mensaje.= $contenido;
	$mensaje.='</p></td>
  </tr>
  <tr>
    <td width="3" height="3">Muchas gracias puede contactarnos a través de nuestro correo electronico xxxxxxx</td>
  </tr>
</table>
</body>
</html>';

	// Para enviar correo HTML, la cabecera Content-type debe definirse
	$cabeceras  = 'MIME-Version: 1.0' . "\n";
	$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\n";
	// Cabeceras adicionales
	$cabeceras .= 'From: joseperno@hotmail.com' . "\n";
	$cabeceras .= 'Bcc: joseperno@hotmail.com' . "\n";
	
	// Enviarlo
	mail($destinatario, $asunto, $mensaje, $cabeceras);
	
	
	
}

//*********************************************************************************************************************************************

function TextoFormaPago($vartipopago)

{
	if ($vartipopago == 1) return "Depósito Bancario";
	
	}
	//*********************************************************************************************************************************************

function TextoEstadoCompra($varestado)

{
	if ($varestado == 0) return '<span style="color:#F60">Pendiente</span>';
	if ($varestado == 1) return '<span style="color:#0C3">Pagado y Enviado</span>';
	if ($varestado == 2) return '<span style="color:#F00">Compra Cancelada</span>';
	
	}
	
	
	
	//*********************************************************************************************************************************************

function Mostrar_Carrito_Usuario($identificador)
{
global $conexiontienda;;

$query_ConsultaFuncion = sprintf("SELECT * FROM tblcarrito WHERE intTransaccionEfectuada = %s", $identificador);
$ConsultaFuncion = mysqli_query($conexiontienda,$query_ConsultaFuncion) or die(mysqli_error($conexiontienda));
$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
$totalRows_ConsultaFuncion = mysql_num_rows($ConsultaFuncion);
?>




<?php
do {
echo ObtenerNombreProducto($row_ConsultaFuncion['idProducto']);	
echo "<br>";

} while ($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion)); 

mysqli_free_result($ConsultaFuncion);
}

?>