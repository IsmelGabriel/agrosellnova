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
    if (isset($_POST['nombre'], $_POST['usuario'], $_POST['password'], $_POST['correo'])) {
        $nombre = trim($_POST['nombre']);
        $usuario = trim($_POST['usuario']);
        $password = trim($_POST['password']);
        $correo = trim($_POST['correo']);

        // Validar que no estén vacíos
        if (!empty($nombre) && !empty($usuario) && !empty($password) && !empty($correo)) {
            // Verificar si el usuario o el correo ya existen
            $sql_check = "SELECT * FROM usuarios WHERE usuario = ? OR correo = ?";
            $stmt_check = $conn->prepare($sql_check);
            $stmt_check->bind_param("ss", $usuario, $correo);
            $stmt_check->execute();
            $result_check = $stmt_check->get_result();

            if ($result_check->num_rows > 0) {
                echo "<script>alert('El usuario o el correo ya están registrados.');</script>";
                echo "<script>window.location.href = '../web/registrarse.html';</script>";
            } else {
                // Hashear la contraseña
                $password_hashed = password_hash($password, PASSWORD_DEFAULT);

                // Insertar el nuevo usuario en la base de datos
                $sql_insert = "INSERT INTO usuarios (NOMBRE, USUARIO, CORREO, CONTRASEÑA) VALUES (?, ?, ?, ?)";
                $stmt_insert = $conn->prepare($sql_insert);
                $stmt_insert->bind_param("ssss", $nombre, $usuario, $correo, $password_hashed);

                if ($stmt_insert->execute()) {
                    header("location: ../web/registro_exitoso.html");
                } else {
                    header("location: ../web/registro_fallido.html");
                }

                $stmt_insert->close();
            }

            $stmt_check->close();
        } else {
            header("location: ../web/registro_fallido.html");
        }
    } else {
        header("location: ../web/registro_fallido.html");
    }
} else {
    header("location: ../web/registro_fallido.html");
}

$conn->close();
?>
