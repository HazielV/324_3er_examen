<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $empleado_id = $_POST['empleado_id'];
    $supervisor_id = $_POST['supervisor_id'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];

    $estado_id = "1";

    $query = "INSERT INTO solicitudes (titulo,descripcion,empleado_id,supervisor_id, fecha_inicio, fecha_fin, estado_id) VALUES ('$titulo','$descripcion','$empleado_id', '$supervisor_id','$fecha_inicio', '$fecha_fin', '$estado_id')";
    if (mysqli_query($con, $query)) {
        header('Location: index.php');
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>