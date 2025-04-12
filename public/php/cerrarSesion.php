<?php
session_start();

// Verificar si hay una sesión activa
if (!isset($_SESSION['usuario'])) {
    // Si no hay sesión activa, redirigir al usuario a la página de inicio de sesión
    header("Location: ../web/index.html");
    exit;
}

// Destruir la sesión
session_destroy();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cerrando sesión...</title>
    <script>
        // Verificar si el localStorage está vacío
        if (localStorage.length === 0) {
            window.location.href = '../web/index.html';
        } else {
            // Borrar solo la llave 'usuario' del localStorage
            localStorage.removeItem('usuario');

            // Obtener la URL de la página anterior
            var referer = document.referrer;

            // Verificar si la URL de la página anterior es válida y no es una página restringida
            var allowedPages = [
                '../web/inicio.html',
                '../web/productos.html',
                '../web/categorias.html',
                '../web/reservas.html',
                '../web/about_us.html',
                '../web/contactanos.html',
                '../web/ayuda.html',
                '../web/perfil.php'
            ];
            var isValidReferer = allowedPages.some(function(page) {
                return referer.includes(page);
            });

            // Redirigir al usuario a la página anterior si es válida, de lo contrario a index.html
            if (isValidReferer) {
                window.location.href = referer;
            } else {
                window.location.href = '../web/inicio.html';
            }
        }
    </script>
</head>
<body>
    Cerrando sesión...
</body>
</html>