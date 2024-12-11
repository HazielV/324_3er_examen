<?php
// Conexión a la base de datos
include('db.php');

// Obtener la lista de empleados y supervisores
$query_usuarios = "SELECT id, nombre FROM usuarios WHERE rol = 'empleado'";
$result_usuarios = mysqli_query($con, $query_usuarios);

$query_supervisores = "SELECT id, nombre FROM usuarios WHERE rol = 'supervisor'";
$result_supervisores = mysqli_query($con, $query_supervisores);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Solicitud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Nueva Solicitud de Vacaciones</h2>

        <form action="insert.php" method="POST">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título de la Solicitud</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
            </div>
            <div class="mb-3">
                <label for="empleado" class="form-label">Empleado</label>
                <select class="form-control" id="empleado" name="empleado_id" required>
                    <?php while ($row = mysqli_fetch_assoc($result_usuarios)): ?>
                        <option value="<?= $row['id'] ?>"><?= $row['nombre'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="supervisor" class="form-label">Supervisor</label>
                <select class="form-control" id="supervisor" name="supervisor_id" required>
                    <?php while ($row = mysqli_fetch_assoc($result_supervisores)): ?>
                        <option value="<?= $row['id'] ?>"><?= $row['nombre'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                <input type="date" name="fecha_inicio" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                <input type="date" name="fecha_fin" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
        </form>
    </div>
</body>

</html>