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


$sql = "SELECT * FROM producto WHERE USUARIO_CAMPESINO = '$usuario' AND ID_PRODUCTO = '" . $_GET['id'] . "'";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    $producto = $resultado->fetch_assoc();
} else {
    echo "No se encontró el producto.";
    exit;
}

$ID_PRODUCTO = $producto['ID_PRODUCTO'];

// Actualizar el producto en la base de datos
$sql_update = "DELETE FROM PRODUCTO WHERE ID_PRODUCTO='$ID_PRODUCTO'";

if ($conn->query($sql_update) === TRUE) {
    echo "<script>alert('Producto eliminado correctamente.');</script>";
    header("Location: ../web/panel/gestionar_productos.php"); // Redirigir a la página de gestión de productos
    exit;
} else {
    echo "Error al actualizar el producto: " . $conn->error;
}


?>