<?php
    session_name('listado');
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
			array_push($_SESSION['tareasCheck'], 0);
		}
    }
    if (isset($_POST['guardar'])) {
		for ($i = 0; $i < count($_SESSION['tareas']); $i++) {
			if (isset($_POST["tareaCheckbox".$i])) {
				if ($_POST["tareaCheckbox".$i] != -1) {
					$_SESSION['tareasCheck'][$i] = 1;
				}
			} elseif ($_SESSION['tareasCheck'][$i] != -1) {
				$_SESSION['tareasCheck'][$i] = 0;
			}
		}
    }
    if (isset($_POST['eliminar'])) {
		for ($i = 0; $i < count($_SESSION['tareas']); $i++) {
			if (isset($_POST["tareaCheckbox".$i])) {
				if ($_POST["tareaCheckbox".$i] == "on") {
					$_SESSION['tareas'][$i] = -1;
					$_SESSION['tareasCheck'][$i] = -1;
				}
			}
		}
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Agenda de Tareas</title>
		<style>
			body {
				background-color:green;
				color:brown;
			}
			h2 {
				font-size:23px;
			}
			h2 + h2 {
				margin-top:-15px;
			}
			ul {
				list-style:square;
			}
			li {
				margin-left:-10px;
			}
			div {
				background-color:white;
				border:4px outset brown;
				margin:30px auto;
				padding:0px 20px 10px 20px;
				width:290px;
			}
			input[type=checkbox] {
				vertical-align:middle;
			}
			input[type=text] {
				width:180px;
			}
		</style>
	</head>
	<body>
		<form action="index.php" method="post">
			<div>
<?php
				$borradas = count(array_keys($_SESSION['tareasCheck'], -1));
				if (count($_SESSION['tareas']) == 0 || $borradas == count($_SESSION['tareas'])) {
					echo "\t\t\t\t<h2>No hay tareas.</h2><h2>Puede añadir una más abajo</h2>\n";
				} else {
					echo "\t\t\t\t<h2>Listado de Tareas</h2>\n";
					echo "\t\t\t<ul>\n";
					for ($i = 0; $i < count($_SESSION['tareas']); $i++) {
						if (isset($_SESSION['tareasCheck'][$i])) {
							if ($_SESSION['tareasCheck'][$i] != -1) {
								$id = "tareaCheckbox".$i;
								$checked = ($_SESSION['tareasCheck'][$i] == 1) ? "checked" : "";
								echo "\t\t\t\t<li><label for='".$id."'>";
								echo "<input type='checkbox' name='".$id."' id='".$id."' ".$checked.">";
								echo "<i>".$_SESSION['tareas'][$i]."</i></label></li>\n";
							}
						}
					}
					echo "\t\t\t</ul>\n";
					echo "\t\t\t<p><input type='submit' name='guardar' value='Guardar'></p>\n";
				}
?>
			<p>
				<input type="text" name="tarea" placeholder="Introduce una tarea">
				<input type="submit" name="anadir" value="Añadir tarea">
			</p>
<?php
				if ($borradas != count($_SESSION['tareas'])) {
					$total = count($_SESSION['tareas']) - $borradas;
					$cont1 = count(array_keys($_SESSION['tareasCheck'], 1));
					$s = ($cont1 != 1) ? "s" : "";
					echo "\t\t\t<hr/>\n\t\t\t<p>Hay <b>".$cont1."</b> tarea".$s;
					echo "pendiente".$s." de <b>".$total."</b> en total</p>";
					echo "<p><input type='submit' name='eliminar' value='Eliminar tareas completadas'> ";
					echo "<input type='submit' name='limpiar' value='Vaciar lista'></p>";
				}
?>
			</div>
        </form>
	</body>
</html>
