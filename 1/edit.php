<?php
include('db.php');
$id = $_GET['id'];
$query = "SELECT * FROM solicitudes WHERE id = $id";
$result = mysqli_query($con, $query);
$solicitud = mysqli_fetch_assoc($result);
// Obtener la solicitud a editar
$solicitud_id = $_GET['id']; // ID de la solicitud a editar
$query_solicitud = "SELECT * FROM solicitudes WHERE id = $solicitud_id";
$result_solicitud = mysqli_query($con, $query_solicitud);
$solicitud = mysqli_fetch_assoc($result_solicitud);

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
    <title>Editar Solicitud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Editar Solicitud</h2>
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $solicitud['id']; ?>">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título de la Solicitud</label>
                <input type="text" class="form-control" id="titulo" name="titulo" value="<?= $solicitud['titulo'] ?>"
                    required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion"
                    required><?= $solicitud['descripcion'] ?></textarea>
            </div>

            <div class="mb-3">
                <label for="empleado" class="form-label">Empleado</label>
                <select class="form-control" id="empleado" name="empleado_id" required>
                    <?php while ($row = mysqli_fetch_assoc($result_usuarios)): ?>
                        <option value="<?= $row['id'] ?>" <?= $row['id'] == $solicitud['empleado_id'] ? 'selected' : '' ?>>
                            <?= $row['nombre'] ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="supervisor" class="form-label">Supervisor</label>
                <select class="form-control" id="supervisor" name="supervisor_id" required>
                    <?php while ($row = mysqli_fetch_assoc($result_supervisores)): ?>
                        <option value="<?= $row['id'] ?>" <?= $row['id'] == $solicitud['supervisor_id'] ? 'selected' : '' ?>>
                            <?= $row['nombre'] ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select class="form-control" id="estado" name="estado_id" required>
                    <option value="1" <?= $solicitud['estado_id'] == 1 ? 'selected' : '' ?>>Pendiente</option>
                    <option value="2" <?= $solicitud['estado_id'] == 2 ? 'selected' : '' ?>>En Proceso</option>
                    <option value="3" <?= $solicitud['estado_id'] == 3 ? 'selected' : '' ?>>Aprobada</option>
                    <option value="4" <?= $solicitud['estado_id'] == 4 ? 'selected' : '' ?>>Rechazada</option>
                    <option value="5" <?= $solicitud['estado_id'] == 5 ? 'selected' : '' ?>>Cancelada</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio"
                    value="<?= $solicitud['fecha_inicio'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                <input type="date" class="form-control" id="fecha_fin" name="fecha_fin"
                    value="<?= $solicitud['fecha_fin'] ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</body>

</html>