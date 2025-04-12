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


$sql = "SELECT * FROM usuarios WHERE  ID_USUARIO = '" . $_GET['id'] . "'";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    $usuarios = $resultado->fetch_assoc();
} else {
    echo "<script>alert('No se encontró el usuario.');</script>";
    header("Location: ../web/panel/usuarios_registrados.php"); // Redirigir a la página de gestión de productos
    exit;
}

$ID_USUARIO = $usuarios['ID_USUARIO'];

// Actualizar el producto en la base de datos
$sql_update = "DELETE FROM usuarios WHERE ID_USUARIO='$ID_USUARIO'";

if ($conn->query($sql_update) === TRUE) {
    echo "<script>alert('Usuario eliminado correctamente.');</script>";
    header("Location: ../web/panel/usuarios_registrado.php"); // Redirigir a la página de gestión de productos
    exit;
} else {
    echo "Error al eliminar usuario: " . $conn->error;
}


?>