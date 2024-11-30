<?php
// Conectar a la base de datos
$servername = "localhost"; // nombre del host
$username = "root"; // Usuario de MySQL
$passwordDB = ""; // Contraseña de MySQL
$dbname = "agrosellnova"; // Nombre de la base de datos

$conn = new mysqli($servername, $username, $passwordDB, $dbname);

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se envió el formulario por método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si las variables usuario y contraseña están definidas
    if (isset($_POST['usuario']) && isset($_POST['password'])) {
        $usuario = trim($_POST['usuario']);  // Obtener el nombre de usuario
        $password = trim($_POST['password']);  // Obtener la contraseña

        // Validar que no estén vacíos
        if (!empty($usuario) && !empty($password)) {
            // Preparar la consulta SQL para verificar si el usuario existe
            $sql = "SELECT * FROM registros WHERE usuario = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $usuario);  // Enlazar el valor del parámetro
            $stmt->execute();
            $result = $stmt->get_result();

            // Verificar si el usuario existe
            if ($result->num_rows > 0) {
                // El usuario existe, obtener los datos del usuario
                $row = $result->fetch_assoc();

                // Verificar si la contraseña coincide con la almacenada en la base de datos
                if ($password == $row['password']) {
                    // Contraseña correcta
                    echo "Inicio de sesión exitoso. Bienvenido, $usuario.";
                    // Aquí podrías redirigir al usuario a la página principal o dashboard
                    header("Location: inicio.html");  // Cambia esta URL a la página que deseas
                    exit;
                } else {
                    header("location: index.html");
                }
            } else {
                header("location: index.html");
            }

            $stmt->close();
        } else {
            echo "Por favor, complete todos los campos.";
        }
    } else {
        echo "Por favor, complete todos los campos.";
    }
} else {
    echo "Acceso no permitido.";
}

$conn->close();
?>
