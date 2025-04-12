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


    // Verificar si las variables requeridas están definidas
    if (isset($_POST['NOMBRE'], $_POST['CORREO'], $_POST['TELEFONO'], $_POST['METODO_PAGO'], $_POST['DIRECCION'])) {
        // Obtener los datos del formulario
        $NOMBRE = trim($_POST['NOMBRE']);
        $CORREO = trim($_POST['CORREO']);
        $TELEFONO = trim($_POST['TELEFONO']);
        $METODO_PAGO = trim($_POST['METODO_PAGO']);
        $DIRECCION = trim($_POST['DIRECCION']);
        $FECHA_EMISION = date("Y-m-d H:i:s"); // Fecha automática del sistema

        // Validar que los campos obligatorios no estén vacíos
        if (!empty($NOMBRE) && !empty($CORREO) && !empty($TELEFONO) && !empty($METODO_PAGO) && !empty($DIRECCION)) {
            // Insertar los datos en la base de datos
            $sql_insert = "INSERT INTO pagos (NOMBRE, CORREO, TELEFONO, METODO_PAGO, DIRECCION, FECHA_EMISION) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt_insert = $conn->prepare($sql_insert);
            $stmt_insert->bind_param("ssssss", $NOMBRE, $CORREO, $TELEFONO, $METODO_PAGO, $DIRECCION, $FECHA_EMISION);

            if ($stmt_insert->execute()) {
                header("Location: ../web/pago_exitoso.html");
            } else {
                echo "PAGO Fallido.";
            }

            $stmt_insert->close();
        } else {
            echo "Por favor, complete todos los campos obligatorios.";
        }
    } else {
        echo "Datos incompletos en el formulario. " . $conn->error;
    }
} else {
    echo "Acceso no permitido.";
}

$conn->close();
?>
