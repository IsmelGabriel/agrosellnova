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
    $USUARIO_CLIENTE = trim($_POST['USUARIO_CLIENTE'] ?? '');

    if (empty($USUARIO_CLIENTE)) {
        header("Location: ../web/session_fallida.html");
        exit();
    }

    // Verificar si las variables están definidas
    if (isset($_POST['USUARIO_CLIENTE'], $_POST['USUARIO_DOCUMENTO'], $_POST['USUARIO_TELEFONO'], $_POST['USUARIO_CORREO'], $_POST['PRODUCTO'], $_POST['CANTIDAD_KG'], $_POST['METODO_PAGO'])) {
        $USUARIO_CLIENTE = trim($_POST['USUARIO_CLIENTE']);
        $USUARIO_DOCUMENTO = trim($_POST['USUARIO_DOCUMENTO']); 
        $USUARIO_TELEFONO = trim($_POST['USUARIO_TELEFONO']);
        $USUARIO_CORREO = trim($_POST['USUARIO_CORREO']);
        $PRODUCTO = trim($_POST['PRODUCTO']);
        $CANTIDAD_KG = trim($_POST['CANTIDAD_KG']);
        $METODO_PAGO = trim($_POST['METODO_PAGO']);

        if (!empty($USUARIO_CLIENTE) && !empty($USUARIO_DOCUMENTO) && !empty($USUARIO_TELEFONO) && !empty($USUARIO_CORREO) && !empty($PRODUCTO) && !empty($CANTIDAD_KG) && !empty($METODO_PAGO)) {
            // Insertar la reserva en la base de datos
            $sql_insert = "INSERT INTO reservas (USUARIO_CLIENTE, USUARIO_DOCUMENTO, USUARIO_TELEFONO, USUARIO_CORREO, PRODUCTO, CANTIDAD_KG, METODO_PAGO) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt_insert = $conn->prepare($sql_insert);
            $stmt_insert->bind_param("sssssss", $USUARIO_CLIENTE, $USUARIO_DOCUMENTO, $USUARIO_TELEFONO, $USUARIO_CORREO, $PRODUCTO, $CANTIDAD_KG, $METODO_PAGO);

            if ($stmt_insert->execute()) {
                header("Location: ../web/reserva_exitosa.html");
            } else {
                echo "Reserva fallida.";
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
