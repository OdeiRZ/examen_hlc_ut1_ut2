<?php
    session_name('listadoTareas');
    session_start();
    
    if (isset($_POST['limpiar'])) {
        session_destroy();
        session_start();
    }
    if (!isset($_SESSION['tareas'])) {
        $_SESSION['tareas'] = array();
    }
    if (isset($_POST['anadir'])) {
		if ($_POST["tarea"] != "") {
			array_push($_SESSION['tareas'], $_POST["tarea"]);
		}
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
        if (count($_SESSION['tareas']) == 0) {
            echo "No hay tareas. Puede añadir una más abajo.<br/><br/>";
        } else {
            for($i = 0; $i < count($_SESSION['tareas']); $i++) {
                echo $_SESSION['tareas'][$i]."<br/>";
			}
			echo "<br/>";
		}
?>
		<form action="index.php" method="post">
            <input type="text" name="tarea" placeholder="Introduce una tarea">
            <input type="submit" name="anadir" value="Añadir tarea">
			<input type="submit" name="limpiar" value="Vaciar la lista">
        </form>
		<hr/>
<?php
		$s = (count($_SESSION['tareas']) > 1) ? "s" : "";
        if (count($_SESSION['tareas']) > 0) {
		    echo "<br/>Hay ".count($_SESSION['tareas'])." tarea".$s." pendiente".$s;
        }
?>
	</body>
</html>