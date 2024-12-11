<?php
$con = mysqli_connect("localhost", "root", "", "3er_324");

if (!$con) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>