<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario']) || !isset($_SESSION['rol'])) {
    header("Location: ../../php/cerrarSesion.php"); // Redirigir al login si no hay sesión
    exit;
}

// Obtener datos del usuario
$usuario = $_SESSION['usuario'];
$rol = $_SESSION['rol'];

// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$passwordDB = "";
$dbname = "agrosell";

$conn = new mysqli($servername, $username, $passwordDB, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del usuario
$sql = "SELECT ID_usuario, NOMBRE, USUARIO, CORREO, ROL, roles_ID_roles  FROM usuarios WHERE USUARIO = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "Usuario no encontrado.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de control</title>
    <link rel="stylesheet" href="../../css/panel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="panel-control">
    <header class="Bienvenido">
        <h1>Bienvenido, <?php echo ucfirst($usuario); ?></h1>
        <p>Rol: <?php echo ucfirst($rol); ?></p>
    </header>

    <div class="panel-container">
        <!-- Barra lateral -->
        <aside class="sidebar">
            <div class="lateral-content">
            <ul>
                <?php if ($rol == 'administrador'): ?>
                    <li><a href="../inicio.html">Inicio</a></li>
                    <li><a href="reporte_ventas.php">Reporte de Ventas</a></li>
                    <li><a href="reporte_reservas.php">Reporte de Reservas</a></li>
                    <!--<li><a href="reporte_inventario.php">Reporte de Inventario</a></li>-->
                    <li><a href="reporte_pqrs.php">Reporte de PQRS</a></li>
                    <li><a href="actualizar_roles.php">Actualizar Roles</a></li>
                    <li><a href="usuarios_registrados.php">Reporte usuarios</a></li>
                <?php elseif ($rol == 'productor'): ?>
                    <li><a href="../inicio.html">Inicio</a></li>
                    <li><a href="ofertar_producto.php">Ofertar Producto</a></li>
                    <li><a href="gestionar_productos.php">Gestionar productos </a></li>
                <?php elseif ($rol == 'cliente'): ?>
                    <li><a href="../inicio.html">Inicio</a></li>
                    <li><a href="gestionar_reservas.php">Gestionar Reservas</a></li>
                    <li><a href="../productos.php">Ver Productos</a></li>
                    <li><a href="../reservas.html">Realizar Reserva</a></li>
                <?php endif; ?>
                <li><a href="../../php/cerrarSesion.php">Cerrar Sesión</a></li>
            </ul>
            </div>
        </aside>

        <!-- Contenido Principal -->
        <main class="panel-content">
            <h2>Panel de Control</h2>
            <p>Información del usuario:</p>
            <p>User ID: <?php echo $user['ID_usuario']; ?></p>
            <p>Nombre: <?php echo $user['NOMBRE']; ?></p>
            <p>Usuario: <?php echo $user['USUARIO']; ?></p>
            <p>Email: <?php echo $user['CORREO']; ?></p>
            <p>Rol: <?php echo $user['ROL']; ?></p>
        </main>
    </div>

    <script>
        
    </script>


</body>
</html>