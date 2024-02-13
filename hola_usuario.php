<?php require_once('Connections/conexiontienda.php'); ?>
<link href="estilos.css" rel="stylesheet" type="text/css">
<style type="text/css">
a:link {
	text-decoration: none;
	color: #FF9;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	color: #FF6;
}
</style>
<div class="login_ok">
<?php echo "Hola " . $_SESSION['MM_Username']?> 

<div class="salir_sesion">
<a href="usuario_cerrar_sesion.php">Salir</a> - <a href="usuario_modificacion.php">Modificar mis datos</a></div>
</div>
