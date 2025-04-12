<?php
session_start();

if (!isset($_SESSION['usuario']) || !isset($_SESSION['rol'])) {
    header("Location: ../../php/cerrarSesion.php"); // Redirigir al login si no hay sesión
    exit;
}

$usuario = $_SESSION['usuario'];
$rol = $_SESSION['rol'];

//conexion base de datos//
$conn = new mysqli("localhost", "root", "", "agrosell");
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$sql = "SELECT ID_inventario, ID_producto, Nombre_producto, productor, precio, Fecha_cosecha, Peso_kg, stock, Descripcion, Numero_referencia FROM inventario";
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
        <h1>Productos Publicados</h1>
    <table border="1">
        <tr>
            <th>ID inventario</th>
            <th>ID Producto</th>
            <th>Producto</th>
            <th>Nombre productor</th>
            <th>Precio</th>
            <th>Fecha de cosecha</th>
            <th>Peso kg</th>
            <th>Stock</th>
            <th>Descripcion</th>
            <th>Numero de referencia</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['ID_inventario']}</td>
                        <td>{$row['ID_producto']}</td>
                        <td>{$row['Nombre_producto']}</td>
                        <td>{$row['productor']}</td>
                        <td>{$row['Precio']}</td>
                        <td>{$row['Fecha_cosecha']}</td>
                        <td>{$row['Peso_kg']}</td>
                        <td>{$row['stock']}</td>
                        <td>{$row['Descripcion']}</td>
                        <td>{$row['Numero_referencia']}</td>
                        </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No hay reservas registrados</td></tr>";
        }
        ?>
    </table>
        </main>
    </div>
</body>
</html>