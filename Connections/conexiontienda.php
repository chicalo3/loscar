<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conexiontienda = "localhost";
$database_conexiontienda = "gestionpago";
$username_conexiontienda = "root";
$password_conexiontienda = "";
$conexiontienda = mysqli_connect($hostname_conexiontienda, $username_conexiontienda, $password_conexiontienda, $database_conexiontienda); 
?>

<?php
if (is_file("includes/funciones.php")){
	include("includes/funciones.php");
}
else
{
	include("../includes/funciones.php");
	}
?>