<?php
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

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitizar los datos
    $usuario = $conn->real_escape_string($_POST['USUARIO']);
    $nombre = $conn->real_escape_string($_POST['NOMBRE_PRODUCTO']);
    $precio = $conn->real_escape_string($_POST['PRECIO']);
    $descripcion = $conn->real_escape_string($_POST['DESCRIPCION']);
    $peso_kg = $conn->real_escape_string($_POST['PESO_KG']);
    $stock = $conn->real_escape_string($_POST['STOCK']);

    // Manejo de la imagen
    if (isset($_FILES['PRODUCTO_IMAGEN']) && $_FILES['PRODUCTO_IMAGEN']['error'] === UPLOAD_ERR_OK) {
        $img_nombre = $_FILES['PRODUCTO_IMAGEN']['name'];
        $img_tmp = $_FILES['PRODUCTO_IMAGEN']['tmp_name'];
        $img_size = $_FILES['PRODUCTO_IMAGEN']['size'];
        $img_type = mime_content_type($img_tmp);

        // Carpeta destino
        $directorio_destino = '../img/';

        // Crear nombre único para la imagen
        $img_nombre_unico = uniqid() . '_' . basename($img_nombre);

        // Ruta final
        $ruta_final = $directorio_destino . $img_nombre_unico;

        // Validaciones de seguridad
        $extensiones_permitidas = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
        $tamaño_maximo = 2 * 1024 * 1024; // 2 MB

        if (!in_array($img_type, $extensiones_permitidas)) {
            echo "<script>
                    alert('Formato de imagen no permitido. Solo JPG, PNG o WEBP.');
                    window.history.back();
                  </script>";
            exit;
        }

        if ($img_size > $tamaño_maximo) {
            echo "<script>
                    alert('La imagen excede el tamaño máximo de 2 MB.');
                    window.history.back();
                  </script>";
            exit;
        }

        // Mover la imagen al directorio
        if (move_uploaded_file($img_tmp, $ruta_final)) {
            // Insertar datos en la base de datos
            $sql = "INSERT INTO producto (USUARIO_CAMPESINO, PRODUCTO_IMAGEN, NOMBRE_PRODUCTO, PRECIO, DESCRIPCION, PESO_KG, STOCK)
                    VALUES ('$usuario', '../img/$img_nombre_unico', '$nombre', '$precio', '$descripcion', '$peso_kg', '$stock')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>
                        alert('Producto registrado correctamente.');
                        window.location.href = '../web/oferta_exitosa.html';
                      </script>";
            } else {
                echo "Error al registrar el producto: " . $conn->error;
            }
        } else {
            echo "Error al subir la imagen.";
        }
    } else {
        echo "Error en la carga de la imagen: " . $_FILES['PRODUCTO_IMAGEN']['error'];
    }
    $conn->close();
} else {
    echo "Acceso no autorizado.";
}
?>
