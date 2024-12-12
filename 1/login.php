<?php

include "db.php";

// Obtener los datos del formulario
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Usuario y contraseña son requeridos.']);
    exit();
}
echo ($email);
echo ($password);

$sql = "SELECT * FROM usuarios WHERE email = '$email' AND password = '$password'";
$result1 = mysqli_query($con, $sql);

// Verificar las credenciales
if ($result1) {
    if (mysqli_num_rows($result1) > 0) {
        // Inicio de sesión exitoso
        $usuarioData = mysqli_fetch_assoc($result1);
        session_start();
        $_SESSION['usuario'] = $usuarioData['rol'];
        $_SESSION['id'] = $usuarioData['id'];

        echo json_encode(['success' => true, 'message' => '¡Inicio de sesión exitoso! Redirigiendo...', 'usuario' => $usuarioData['rol']]);
    } else {
        // Usuario o contraseña incorrectos
        echo json_encode(['success' => false, 'message' => 'Usuario o contraseña incorrectos.']);
    }
} else {
    // Inicio de sesión fallido
    echo json_encode(['success' => false, 'message' => 'Usuario o contraseña incorrectos.']);
}
