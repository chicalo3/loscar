
<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conexiontienda = "localhost";
$database_conexiontienda = "gestionpago";
$username_conexiontienda = "root";
$password_conexiontienda = "";
$conexiontienda = mysql_pconnect($hostname_conexiontienda, $username_conexiontienda, $password_conexiontienda) or trigger_error(mysql_error(),E_USER_ERROR); 
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