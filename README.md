# Agenda de Tareas (Examen HLC UT1-UT2)

Aplicación web en PHP de gestión de tareas pendientes (to-do list), guardadas en la sesión del usuario.

## Características

- Añadir nuevas tareas a la lista mediante un formulario.
- Marcar tareas como completadas con checkboxes y guardar su estado ("Guardar").
- Eliminar solo las tareas marcadas como completadas ("Eliminar tareas completadas").
- Vaciar la lista completa reiniciando la sesión ("Vaciar lista").
- Contador dinámico de tareas pendientes frente al total de tareas activas.
- Todo el estado se mantiene en `$_SESSION`, sin base de datos.
- Entorno de desarrollo reproducible con Vagrant (máquina `iesoretania/ubuntu-hlc-php`, IP privada `192.168.33.10`).

## Tecnologías

- PHP (sin framework, sesiones nativas `$_SESSION`)
- HTML5 / CSS3 (estilos en línea en el propio `index.php`)
- Vagrant + VirtualBox (entorno de desarrollo)

## Instalación / Cómo ejecutarlo

**Con Vagrant (recomendado):**
1. Instala [Vagrant](https://www.vagrantup.com/) y [VirtualBox](https://www.virtualbox.org).
2. Desde la raíz del proyecto ejecuta `vagrant up`.
3. Accede a la aplicación en `http://192.168.33.10/`.

**Con un servidor PHP propio:**
```
php -S localhost:8000 -t public
```

Ejercicio académico (examen de la asignatura "Horas de Libre Configuración", 2º DAW) que practica el manejo de sesiones PHP y formularios con múltiples acciones (`añadir`, `guardar`, `eliminar`, `limpiar`).

## Licencia

El repositorio no incluye un archivo de licencia.
