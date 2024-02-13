<?php
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
<title>Documento sin título</title>
<link href="../thrColFix.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div class="container">
  <div class="sidebar1">
    <ul class="nav">
      <li><a href="#">Vínculo uno</a></li>
      <li><a href="#">Vínculo dos</a></li>
      <li><a href="#">Vínculo tres</a></li>
      <li><a href="#">Vínculo cuatro</a></li>
    </ul>
    <p> Los vínculos anteriores muestran una estructura de navegación básica que emplea una lista no ordenada con estilo de CSS. Utilícela como punto de partida y modifique las propiedades para lograr el aspecto deseado. Si necesita menús desplegables, créelos empleando un menú de Spry, un widget de menú de Adobe Exchange u otras soluciones de javascript o CSS.</p>
    <p>Si desea que la navegación se sitúe a lo largo de la parte superior, simplemente mueva ul.nav a la parte superior de la página y vuelva a crear el estilo.</p>
    <!-- end .sidebar1 --></div>
  <div class="content">
    <h1>Instrucciones</h1>
    <p>
     
	<?php echo  $sumatotal . "<br>"; ?>
	 
	
 
    
    </p>
    <!-- end .content --></div>
  <div class="sidebar2">
    <h4>Fondos</h4>
    <p>Por naturaleza, el color de fondo de cualquier div sólo se muestra a lo largo del contenido. Si desea usar una línea divisora en lugar de un color, coloque un borde en el lado de la div de .content (pero sólo en el caso de que siempre vaya a tener más contenido).</p>
    <!-- end .sidebar2 --></div>
  <!-- end .container --></div>
</body>
</html>