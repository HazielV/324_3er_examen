<?php
include('db.php');
session_start();

// Verificar si hay una sesión activa y si el usuario es 'admin'
if (!isset($_SESSION['usuario']) || $_SESSION['usuario'] !== 'supervisor') {
    // Si el usuario no es 'admin', redirige a una página de error o login
    header('Location: consultar.php');  // Puedes cambiar la redirección
    exit(); // Termina la ejecución del script
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitudes de Vacaciones</title>
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

<body>
    <div class="container mt-5">
        <h2>Solicitudes de Vacaciones</h2>
        <a href="create.php" class="btn btn-success mb-3">Nueva Solicitud</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Empleado</th>
                    <th>Fecha de Inicio</th>
                    <th>Fecha de Fin</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "select solicitudes.id,fecha_inicio,fecha_fin,u.nombre as nombreEmpleado,e.nombre as estado from solicitudes join usuarios u on solicitudes.empleado_id = u.id join estados e on solicitudes.estado_id = e.id";

                $result = mysqli_query($con, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['nombreEmpleado']}</td>
                            <td>{$row['fecha_inicio']}</td>
                            <td>{$row['fecha_fin']}</td>
                            <td>{$row['estado']}</td>
                            <td>
                                <a href='edit.php?id={$row['id']}' class='btn btn-primary btn-sm'>Editar</a>
                                <a href='delete.php?id={$row['id']}' class='btn btn-danger btn-sm'>Eliminar</a>
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <a href="logout.php" class="btn btn-danger logout-btn">Cerrar Sesión</a>
</body>

</html>