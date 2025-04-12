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

// Consultar los Reporte usuarios
$sql = "SELECT * FROM producto where USUARIO_CAMPESINO = '$usuario'";
$result = $conn->query($sql);

if (!$result) {
    die("Error en la consulta: " . $conn->error);
}


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

                <?php elseif ($rol == 'productor'): ?>
                    <li><a href="../inicio.html">Inicio</a></li>
                    <li><a href="ofertar_producto.php">Ofertar Producto</a></li>
                    <li><a href="gestionar_productos.php">Gestionar productos</a></li>
                <?php elseif ($rol == 'cliente'): ?>

                <?php endif; ?>
                <li><a href="../../php/cerrarSesion.php">Cerrar Sesión</a></li>
            </ul>
            </div>
        </aside>

        <!-- Contenido Principal -->
        <main class="panel-content">
            <h1>Productos registrados en el sistema: <?php echo $usuario ?></h1>
            <table border="1">
                <tr>
                    <th>ID PRODUCTO</th>
                    <th>IMAGEN</th>
                    <th>PRODUCTO</th>
                    <th>DESCRIPCION</th>
                    <th>PRECIO</th>
                    <th>PESO Kg</th>
                    <th>Stock</th>
                    <th>Fecha de cosecha</th>
                </tr>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>" . $row['ID_PRODUCTO'] . "</td>
                            <td><img src='../" . $row['PRODUCTO_IMAGEN'] . "' alt='Imagen del producto' width='100'></td>
                            <td>" . $row['NOMBRE_PRODUCTO'] . "</td>
                            <td>" . $row['DESCRIPCION'] . "</td>
                            <td>" . $row['PRECIO'] . "</td>
                            <td>" . $row['PESO_KG'] . "</td>
                            <td>" . $row['STOCK'] . "</td>
                            <td>" . $row['FECHA_COSECHA'] . "</td>
                            <td><a href='../../php/editar_producto.php?id=" . $row['ID_PRODUCTO'] . "'>Editar</a></td>
                            <td><a href='../../php/eliminar_producto.php?id=" . $row['ID_PRODUCTO'] . "'>Eliminar</a></td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No tienes productos registrados.</td></tr>";
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