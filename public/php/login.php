<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$passwordDB = "";
$dbname = "agrosell";

$conn = new mysqli($servername, $username, $passwordDB, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST['usuario'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $rol = trim($_POST['rol'] ?? ''); // Validar el rol también

    if (!empty($usuario) && !empty($password) && !empty($rol)) {
        // Buscar usuario en la base de datos
        $sql = "SELECT USUARIO, CONTRASEÑA, ROL FROM usuarios WHERE USUARIO = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Verificar contraseña
            if (password_verify($password, $row['CONTRASEÑA'])) {
                // Verificar rol
                if ($rol === $row['ROL']) {
                    session_start();
                    $_SESSION['usuario'] = $usuario;
                    $_SESSION['rol'] = $rol;
                    header("Location: ../php/guardarUsuario.php?usuario=$usuario"); // Redirigir a la página de inicio
                    exit;
                } else {
                    $error = "Rol incorrecto.";
                }
            } else {
                $error = "Contraseña incorrecta.";
            }
        } else {
            $error = "Usuario no encontrado.";
        }

        $stmt->close();
    } else {
        $error = "Por favor, complete todos los campos.";
    }
} else {
    $error = "Acceso no permitido.";
}

$conn->close();

// Mostrar errores
if (!empty($error)) {
    echo "<script>alert('$error'); window.location.href='../web/index.html';</script>";
}
?>
