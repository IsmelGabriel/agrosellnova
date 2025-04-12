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

// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "agrosell");
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consultar las ventas
$sql = "SELECT ID_venta, ID_producto, CANTIDAD_Kg, FECHA_VENTA, TOTAL_VENTA FROM ventas";
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
        <h1>Reporte de VENTAS</h1>
    <table border="1">
        <tr>
            <th>ID Venta</th>
            <th>Cliente</th>
            <th>vendedor</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Total</th>
            <th>Fecha</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id_venta']}</td>
                        <td>{$row['cliente']}</td>
                        <td>{$row['vendedor']}</td>
                        <td>{$row['producto']}</td>
                        <td>{$row['cantidad_kg']}</td>
                        <td>{$row['total_venta']}</td>
                        <td>{$row['fecha_venta']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No hay ventas registradas</td></tr>";
        }
        ?>
    </table>
</main>

</body>
</html>