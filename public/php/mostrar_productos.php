<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "agrosell");

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Establecer el charset para evitar problemas con acentos
$conexion->set_charset("utf8");

// Consulta a la base de datos
$sql = "SELECT * FROM producto";
$resultado = $conexion->query($sql);

// Crear un array para almacenar los productos
$productos = array();

if ($resultado && $resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $productos[] = $fila;
    }
}

// Devolver los productos en formato JSON
header('Content-Type: application/json');
echo json_encode($productos, JSON_UNESCAPED_UNICODE);

// Cerrar la conexión
$conexion->close();
?>
