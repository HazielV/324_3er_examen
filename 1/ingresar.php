<?php
include "db.php";
session_start();

// Verificar si hay una sesión activa y si el usuario es 'admin'
if (isset($_SESSION['usuario'])) {
    if ($_SESSION['usuario'] == 'supervisor') {
        header('Location: index.php');
    } else {
        header('Location: consultar.php');
    }
}



?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Iniciar Sesión</h4>
                    </div>
                    <div class="card-body">
                        <form id="loginForm">
                            <div class="mb-3">
                                <label for="email" class="form-label">Usuario</label>
                                <input type="email" value="supervisor@example.com" class="form-control" id="email"
                                    name="email" required placeholder="nombre">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="contra" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
                        </form>
                        <div id="message" class="mt-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#loginForm').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'login.php',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function (response) {
                        console.log('respuesta', response)
                        if (response.success) {
                            $('#message').html('<div class="alert alert-success">' + response.message + '</div>');
                            // Redirigir al usuario a la página principal después de un inicio de sesión exitoso
                            if (response.usuario == 'supervisor') {
                                setTimeout(function () {
                                    window.location.href = 'index.php';
                                }, 2000);
                            } else {
                                setTimeout(function () {
                                    window.location.href = 'consultar.php';
                                }, 2000);
                            }
                        } else {
                            $('#message').html('<div class="alert alert-danger">' + response.message + '</div>');
                        }
                    },
                    error: function (e) {
                        console.log(e)
                        $('#message').html('<div class="alert alert-danger">Error en la solicitud. Por favor, inténtalo de nuevo.</div>');
                    }
                });
            });
        });
    </script>
</body>

</html>