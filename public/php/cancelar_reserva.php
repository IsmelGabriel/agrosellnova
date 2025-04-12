<?php
session_start();
// Obtener datos del usuario
$usuario = $_SESSION['usuario'];
$rol = $_SESSION['rol'];

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario']) || !isset($_SESSION['rol'])) {
    header("Location: ../web/index.html"); // Redirigir al login si no hay sesión
    exit;
}

// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$passwordDB = "";
$dbname = "agrosell";

$conn = new mysqli($servername, $username, $passwordDB, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


$sql = "SELECT * FROM reservas WHERE USUARIO_CLIENTE = '$usuario' AND ID_Reservas = '" . $_GET['id'] . "'";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    $reservas = $resultado->fetch_assoc();
} else {
    echo "<script>alert('No se encontró la reserva.');</script>";
    header("Location: ../web/panel/gestionar_reservas.php"); // Redirigir a la página de gestión de reservas
    exit;
}

$ID_Reservas = $reservas['ID_Reservas'];

// Actualizar el producto en la base de datos
$sql_update = "DELETE FROM reservas WHERE ID_Reservas = '" . $_GET['id'] . "'";

if ($conn->query($sql_update) === TRUE) {
    echo "<script>alert('Reserva eliminada correctamente.');</script>";
    header("Location: ../web/panel/gestionar_reservas.php"); // Redirigir a la página de gestión de productos
    exit;
} else {
    echo "<script>alert('Error al eliminar la reserva:');</script>";
    header("Location: ../web/panel/gestionar_reservas.php"); // Redirigir a la página de gestión de reservas
}


?>