<?php
// Conectar a la base de datos
$servername = "localhost"; // Nombre del host
$username = "root"; // Usuario de MySQL
$passwordDB = ""; // Contraseña de MySQL
$dbname = "agrosell"; // Nombre de la base de datos

$conn = new mysqli($servername, $username, $passwordDB, $dbname);

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se envió el formulario por método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si las variables están definidas
    if (isset($_POST['NOMBRE'], $_POST['CORREO'], $_POST['MENSAJE'])) {
        // Obtener los datos del formulario
        $NOMBRE = trim($_POST['NOMBRE']);
        $CORREO = trim($_POST['CORREO']);
        $TELEFONO = isset($_POST['TELEFONO']);
        $MENSAJE = trim($_POST['MENSAJE']);

        if (!empty($_POST['NOMBRE']) && !empty($_POST['CORREO']) && !empty($_POST['MENSAJE'] OR $_POST['TELEFONO'])) {
            // Insertar la reserva en la base de datos
            $sql_insert = "INSERT INTO pqrs (NOMBRE, CORREO, TELEFONO, MENSAJE) VALUES (?, ?, ?, ?)";
            $stmt_insert = $conn->prepare($sql_insert);
            $stmt_insert->bind_param("ssss", $NOMBRE, $CORREO, $TELEFONO, $MENSAJE);

            if ($stmt_insert->execute()) {
                header("Location: ../web/pqrs_exitosa.html");
            } else {
                echo "PQRS Fallido.";
            }

            $stmt_insert->close();
        } else {
            echo "Por favor, complete todos los campos.";
        }

    } else {
        echo "Datos incompletos en el formulario.";
    }
} else {
    echo "Acceso no permitido.";
}

$conn->close();
?>
