<?php
    session_name('listadoTareas');
    session_start();
    
    if (isset($_POST['limpiar'])) {
        session_destroy();
        session_start();
    }
    if (!isset($_SESSION['tareas'])) {
        $_SESSION['tareas'] = array();
		$_SESSION['tareasCheck'] = array();
    }
    if (isset($_POST['anadir'])) {
		if ($_POST["tarea"] != "") {
			array_push($_SESSION['tareas'], $_POST["tarea"]);
			$_SESSION['tareasCheck'][count($_SESSION['tareas'])-1] == 0;
		}
    }
    if (isset($_POST['guardar'])) {
		for($i = 0; $i < count($_SESSION['tareas']); $i++) {
			if ($_POST["tareaCheckbox".$i] == "on") {
				$_SESSION['tareasCheck'][$i] = 1;
			} else {
				$_SESSION['tareasCheck'][$i] = 0;
			}
		}
    }
    if (isset($_POST['eliminar'])) {
		for($i = 0; $i < count($_SESSION['tareas']); $i++) {
			if ($_POST["tareaCheckbox".$i] != "on") {
				array_pop($_SESSION['tareas'][$i]);		//no recuerdo el metodo para eliminarlo del array
				array_pop($_SESSION['tareasCheck'][$i]);//y corte la ayuda offline de php
			}
		}
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		<style>
		ul
		{
			list-style:square;
			color:green;
		}
		</style>
	<head>
	<body>
		<form action="index.php" method="post">
<?php
			if (count($_SESSION['tareas']) == 0) {
				echo "No hay tareas. Puede añadir una más abajo.<br/><br/>";
			} else {
				echo "<ul>";
				for($i = 0; $i < count($_SESSION['tareas']); $i++) {
					$checked = ($_SESSION['tareasCheck'][$i] == 1) ? "checked" : "";
					echo "<li><input type='checkbox' name='tareaCheckbox".$i."' ".$checked.">";
					echo "".$_SESSION['tareas'][$i]."</li>";
				}
				echo "</ul>";
			}
?>
			<input type="submit" name="guardar" value="Guardar"><br/><br/>
            <input type="text" name="tarea" placeholder="Introduce una tarea">
            <input type="submit" name="anadir" value="Añadir tarea">
			<hr/>
<?php
			if (count($_SESSION['tareas']) > 0) {
				$errores = count($_SESSION['tareas']);
				$cont1 = count(array_diff($_SESSION['tareasCheck'], 1));
				$s = (count($_SESSION['tareas']) > 1) ? "s" : "";
				echo $cont1;
				echo "<br/>Hay ".$cont1." tarea".$s." pendiente".$s." de ".$errores." en total<br/><br/>";
			}
?>
			<input type="submit" name="eliminar" value="Eliminar tareas completadas">
			<input type="submit" name="limpiar" value="Vaciar la lista">
        </form>
	</body>
</html>