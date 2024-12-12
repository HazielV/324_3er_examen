// cerrar_sesion.php
<?php
session_start(); // Iniciar la sesión
session_unset(); // Eliminar todas las variables de sesión
session_destroy(); // Destruir la sesión

// Redirigir al inicio o página de login
header("Location: index.php");
exit();
?>