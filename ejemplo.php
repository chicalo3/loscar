<?php require_once('Connections/conexiontienda.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<?php   
if ((isset($_SESSION['MM_Username'])) && ($_SESSION['MM_Username'] != ""))
  {
	  echo "COMPRAR ";
	  
	  
	  ?><br>
  <?php

  }
  else
  {?>
</span></div><div class="menu-derecha">Necesitas Iniciar sesion para comprar</div>
<?php }?>
 
</body>