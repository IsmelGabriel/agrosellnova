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
$sql = "SELECT * FROM reservas where USUARIO_CLIENTE = '$usuario'";
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
            <h1>Reservas registrados en el sistema para: <?php echo $usuario ?></h1>
            <table border="1">
                <tr>
                    <th>ID Reserva</th>
                    <th>Documento</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Metodo de pago</th>
                    <th>Fecha de la reserva</th>
                </tr>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>" . $row['ID_Reservas'] . "</td>
                            <td>" . $row['USUARIO_DOCUMENTO'] . "</td>
                            <td>" . $row['USUARIO_TELEFONO'] . "</td>
                            <td>" . $row['USUARIO_CORREO'] . "</td>
                            <td>" . $row['PRODUCTO'] . "</td>
                            <td>" . $row['CANTIDAD_KG'] . "</td>
                            <td>" . $row['METODO_PAGO'] . "</td>
                            <td>" . $row['FECHA_RESERVA'] . "</td>
                            <td><a href='../../php/editar_reserva.php?id=" . $row['ID_Reservas'] . "'>Editar</a></td>
                            <td><a href='../../php/cancelar_reserva.php?id=" . $row['ID_Reservas'] . "'>Cancelar</a></td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No tienes RESERVAS registradas en este momento.</td></tr>";
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