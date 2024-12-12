<?php
header('Content-Type: text/html; charset=UTF-8');
include "db.php";
// Simulación de sesión de usuario
session_start();
if (!isset($_SESSION['usuario'])) {
    // Si el usuario no está logueado, redirigir al login
    header("Location: ingresar.php");
}
if (isset($_SESSION['usuario'])) {
    if ($_SESSION['usuario'] == 'supervisor') {
        header('Location: index.php');
    }
}
$id = $_SESSION['id'];
$sql = "SELECT * FROM usuarios where id = '$id' ";
$result = mysqli_query($con, $sql);
$solicitudes = [];

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        $usuarioData = mysqli_fetch_assoc($result);
        // Datos simulados del usuario y su propiedad
        $userData = [
            'email' => $usuarioData['email'],

        ];
        $user_id = $usuarioData['id'];

        $sql = "SELECT titulo,descripcion, fecha_inicio,fecha_fin,u.nombre as nombre_supervisor ,e.nombre as estado from solicitudes join usuarios u on solicitudes.supervisor_id = u.id join estados e on solicitudes.estado_id = e.id     where  solicitudes.empleado_id = '$user_id' ";
        $result = mysqli_query($con, $sql);
        $solicitudes = mysqli_fetch_assoc($result);
    }
} else {
    echo 'algo salio mal';
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .logout-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h1 class="mb-4">Bienvenido</h1>

        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Mis Datos Personales</h5>
            </div>
            <div class="card-body">
                <dl class="row">
                    <?php foreach ($userData as $label => $value): ?>
                        <dt class="col-sm-3"><?php echo htmlspecialchars(ucfirst($label)); ?>:</dt>
                        <dd class="col-sm-9"><?php echo htmlspecialchars($value); ?></dd>
                    <?php endforeach; ?>
                </dl>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="card-title mb-0">Datos de Mis solicitudes</h5>
            </div>
            <div class="card-body">
                <dl class="row">
                    <?php foreach ($solicitudes as $label => $value): ?>
                        <dt class="col-sm-3"><?php echo htmlspecialchars(ucfirst($label)); ?>:</dt>
                        <dd class="col-sm-9"><?php echo htmlspecialchars($value); ?></dd>
                    <?php endforeach; ?>
                </dl>
            </div>
        </div>
    </div>

    <a href="logout.php" class="btn btn-danger logout-btn">Cerrar Sesión</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>