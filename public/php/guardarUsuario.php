<?php
// Obtener el nombre de usuario desde la URL
$usuario = htmlspecialchars($_GET['usuario'] ?? '');

// Generar un script para guardar en localStorage y redirigir
echo "<script>
    localStorage.setItem('usuario', '$usuario');
    window.location.href = '../web/inicio.html'; // Redirige a la página de inicio
</script>";
?>
