<?php
include('db.php');

$id = $_GET['id'];
$query = "DELETE FROM solicitudes WHERE id = $id";
if (mysqli_query($con, $query)) {
    header('Location: index.php');
} else {
    echo "Error: " . mysqli_error($con);
}
?>