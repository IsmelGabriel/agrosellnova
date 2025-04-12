<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario']) || !isset($_SESSION['rol'])) {
    header("Location: ../index.html"); // Redirigir al login si no hay sesión
    exit;
}

// Obtener datos del usuario
$usuario = $_SESSION['usuario'];
$rol = $_SESSION['rol'];

// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "agrosell");
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Actualizar rol del usuario
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_usuario'], $_POST['nuevo_rol'])) {
    $id_usuario = $_POST['id_usuario'];
    $nuevo_rol = $_POST['nuevo_rol'];

    $sql_update = "UPDATE usuarios SET ROL = ? WHERE ID_USUARIO = ?";
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param("si", $nuevo_rol, $id_usuario);
    if ($stmt->execute()) {
        echo "Rol actualizado correctamente.";
    } else {
        echo "Error al actualizar: " . $stmt->error;
    }
    $stmt->close();
}

// Consultar usuarios
$sql = "SELECT ID_USUARIO, NOMBRE, USUARIO, DOCUMENTO, DIRECCION, CORREO, ROL FROM usuarios";
$result = $conn->query($sql);
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

                <?php elseif ($rol == 'cliente'): ?>

                <?php endif; ?>
                <li><a href="../../php/cerrarSesion.php">Cerrar Sesión</a></li>
            </ul>
            </div>
        </aside>

        <!-- Contenido Principal -->
        <main class="panel-content">
            <h1>Actualizar Datos de Usuarios</h1>
            <table border="1">
                <tr>
                    <th>ID Usuario</th>
                    <th>Nombre</th>
                    <th>Usuario</th>
                    <th>Correo</th>
                    <th>Documento</th>
                    <th>Dirección</th>
                    <th>Rol</th>
                    <th>Actualizar Rol</th>
                </tr>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['ID_USUARIO']}</td>
                                <td>{$row['NOMBRE']}</td>
                                <td>{$row['USUARIO']}</td>
                                <td>{$row['CORREO']}</td>
                                <td>{$row['DOCUMENTO']}</td>
                                <td>{$row['DIRECCION']}</td>
                                <td>{$row['ROL']}</td>
                                <td>
                                    <form method='POST' action=''>
                                        <input type='hidden' name='id_usuario' value='{$row['ID_USUARIO']}'>
                                        <select name='nuevo_rol'>
                                            <option value='cliente'>Cliente</option>
                                            <option value='productor'>Productor</option>
                                            <option value='administrador'>Administrador</option>
                                        </select>
                                        <input type='submit' value='Actualizar'>
                                    </form>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>No hay usuarios registrados</td></tr>";
                }
                ?>
            </table>
        </main>
    </div>
</body>
</html>

<?php
$conn->close();
?>