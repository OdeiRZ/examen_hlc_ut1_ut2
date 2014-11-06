<?php
    session_name('listadoTareas');
    session_start();
    
    if (!isset($_SESSION['tareas'])) {
        $_SESSION['tareas'] = array();
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		<style></style>
	<head>
	<body>
<?php
		if(count($_SESSION['tareas'])==0)
			echo "No hay tareas. Puede añadir una más abajo";
?>
	</body>
</html>