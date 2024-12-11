<?php
include('db.php');
$id = (int) $_POST['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $empleado_id = $_POST['empleado_id'];
    $supervisor_id = $_POST['supervisor_id'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $estado_id = $_POST['estado_id'];

    $query = "UPDATE solicitudes SET empleado_id = '$empleado_id',supervisor_id = '$supervisor_id', fecha_inicio = '$fecha_inicio', fecha_fin = '$fecha_fin', estado_id = '$estado_id' WHERE id = $id";
    if (mysqli_query($con, $query)) {
        header('Location: index.php');
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>