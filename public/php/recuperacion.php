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
    if (isset($_POST['USUARIO'], $_POST['CORREO'], $_POST['password'])) {
        $usuario = trim($_POST['USUARIO']);
        $correo = trim($_POST['CORREO']);
        $password = trim($_POST['password']);


        // Validar que no estén vacíos
        if (!empty($usuario) && !empty($password) && !empty($correo)) {
            // Verificar si el usuario o el correo existen
            $sql_check = "SELECT * FROM usuarios WHERE usuario = ? OR correo = ?";
            $stmt_check = $conn->prepare($sql_check);
            $stmt_check->bind_param("ss", $usuario, $correo);
            $stmt_check->execute();
            $result_check = $stmt_check->get_result();

            if ($result_check->num_rows == 1) {
                // Hashear la contraseña
                $password_hashed = password_hash($password, PASSWORD_DEFAULT);

                // Actualizar la contraseña en la base de datos
                $sql_update = "UPDATE usuarios SET CONTRASEÑA = ? WHERE usuario = ? AND correo = ?";
                $stmt_update = $conn->prepare($sql_update);
                $stmt_update->bind_param("sss", $password_hashed, $usuario, $correo);

                if ($stmt_update->execute()) {
                    header("Location: ../web/registro_exitoso.html");
                    exit();
                } else {
                    header("Location: ../web/registro_fallido.html");
                }

                $stmt_update->close();
            } else {
                // Si el usuario o correo no existen
                header("Location: ../web/registro_fallido.html");
            }

            $stmt_check->close();
        } else {
            // Si alguno de los campos está vacío
            header("Location: ../web/registro_fallido.html");
        }
    } else {
        // Si las variables no están definidas
        header("Location: ../web/registro_fallido.html");
    }
} else {
    // Si no se envió el formulario por POST
    header("Location: ../web/registro_fallido.html");
}

$conn->close();
?>
