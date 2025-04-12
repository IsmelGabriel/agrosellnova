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

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn->set_charset("utf8"); // Configurar el conjunto de caracteres
} catch (mysqli_sql_exception $e) {
    echo "<script>alert('Error al configurar la conexión: " . $e->getMessage() . "');</script>";
    exit;
}

$sql = "SELECT * FROM usuarios WHERE USUARIO = '$usuario' AND ID_USUARIO = '" . $_GET['id'] . "'";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();
} else {
    echo "No se encontró el usuario.";
    exit;
}

$NOMBRE = $usuario['NOMBRE'];
$USUARIO = $usuario['USUARIO'];
$DOCUMENTO = $usuario['DOCUMENTO'];
$DIRECCION = $usuario['DIRECCION'];
$CORREO = $usuario['CORREO'];
$METODO_PAGO = $usuario['METODO_PAGO'];
$FECHA_NACIMIENTO = $usuario['FECHA_NACIMIENTO'];


// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Actualizar el producto en la base de datos
    $sql_update = "UPDATE usuarios SET NOMBRE='" . $_POST['name'] . "', USUARIO='" . $_POST['USUARIO'] . "', DOCUMENTO='" . $_POST['DOCUMENTO'] . "', DIRECCION='" . $_POST['DIRECCION'] . "', CORREO='" . $_POST['CORREO'] . "', METODO_PAGO='" . $_POST['METODO_PAGO'] . "', FECHA_NACIMIENTO='" . $_POST['FECHA_NACIMIENTO'] . "' WHERE ID_USUARIO='" . $_GET['id'] . "'";

    try {
        if ($conn->query($sql_update) === TRUE) {
            // Mostrar mensaje de éxito y redirigir
            echo "<script>
            window.location.href = '../panel/perfil.php';
            alert('Tu información se ha actualizado con éxito');
                  </script>";
            exit;
        }
    } catch (mysqli_sql_exception $e) {
        // Mostrar mensaje de error personalizado y redirigir
        echo "<script>
        window.location.href = '../panel/perfil.php';
        alert('Error al intentar actualizar tu usuario. Inténtalo más tarde.');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="../../css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <script src="../../js/mostrarNombre.js" defer></script>
</head>

<body>
    <header class="top-bar">
        <div class="header-content">
            <img src="https://i.ibb.co/cvj3qCk/agrosell-logo-removebg-preview-1.png" alt="Agrosell Nova" class="logo">
            <h1 class="menu-title">AGROSELL NOVA</h1>
            <div class="panel-option">
                <button id="panelControl">
                    <a href="panel_control.php" class="menu-icon"><i class="fa fa-cog"></i></a>
                </button>
            </div>
            <a href="carrito.html" class="menu-icon">
                <i class="fas fa-shopping-cart"></i>
            </a>
            <span class="notification">
                <button id="notificationButton">
                    <i class="fas fa-bell" class="menu-icon"></i>
                </button>
            </span>
            <span><a href="../../php/cerrarSesion.php" class="username" id="usuario">Iniciar
                    sesión/Registrarse</a></span>
            <a href="../panel/perfil.php" class="menu-icon">
                <i class="bi bi-person-circle" style="font-size: 30px;"></i>
            </a>
        </div>
    </header>
    <!-- Segunda barra -->
    <nav class="menu-bar">
        <ul>
            <li><a href="../inicio.html"><i class="fas fa-home"></i> Inicio</a></li>
            <li><a href="../productos.html"><i class="fas fa-box icon"></i> Productos</a></li>
            <li><a href="../categorias.html"><i class="fas fa-list"></i> Categorías</a></li>
            <li><a href="../reservas.html"><i class="fas fa-bookmark"></i> Reservas</a></li>
            <li><a href="../about_us.html"><i class="fas fa-info-circle"></i> Sobre nosotros</a></li>
            <li><a href="../contactanos.html"><i class="fas fa-envelope"></i> Contáctanos</a></li>
            <li><a href="../ayuda.html"><i class="fas fa-question-circle"></i> Ayuda</a></li>
        </ul>
    </nav>

    <!-- Contenedor Principal -->
    <main class="actualizar-perfil-container">
        <div class="actualizar-perfil-formulario">
            <h2>Actualizar Perfil</h2>
            <form id="updateProfileForm" class="needs-validation" action="" method="post"
                enctype="multipart/form-data" novalidate>
                <!-- Nombre -->
                <div class="form-actualizar-perfil">
                    <label for="name" class="form-label">Nombre Completo</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $NOMBRE; ?>"
                        required>
                    <div class="invalid-feedback">
                        Por favor, ingresa tu nombre completo.
                    </div>
                </div>

                <!-- Usuario -->
                <div class="form-actualizar-perfil">
                    <label for="USUARIO" class="form-label">Usuario</label>
                    <input type="text" class="form-control" id="name" name="USUARIO" value="<?php echo $USUARIO; ?>"
                        required>
                    <div class="invalid-feedback">
                        Por favor, ingresa tu nombre completo.
                    </div>
                </div>

                <!-- Documento -->
                <div class="form-actualizar-perfil">
                    <label for="DOCUMENTO" class="form-label">Documento</label>
                    <input type="number" class="form-control" id="documento" name="DOCUMENTO"
                        value="<?php echo $DOCUMENTO; ?>" required>
                    <div class="invalid-feedback">
                        Por favor, ingresa un correo electrónico válido.
                    </div>
                </div>

                <!-- Direccion -->
                <div class="form-actualizar-perfil">
                    <label for="DIRECCION" class="form-label">Direccion</label>
                    <input type="text" class="form-control" id="DIRECCION" name="DIRECCION"
                        value="<?php echo $DIRECCION; ?>" required>
                    <div class="invalid-feedback">
                        Por favor, ingresa un correo electrónico válido.
                    </div>
                </div>

                <!-- Correo Electrónico -->
                <div class="form-actualizar-perfil">
                    <label for="CORREO" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" name="CORREO" value="<?php echo $CORREO; ?>"
                        required>
                    <div class="invalid-feedback">
                        Por favor, ingresa un correo electrónico válido.
                    </div>
                </div>

                <!-- METODO PAGO -->
                <div class="form-actualizar-perfil">
                    <label for="METODO_PAGO" class="form-label">Metodo pago preferido</label>
                    <input type="text" class="form-control" id="METODO_PAGO" name="METODO_PAGO"
                        value="<?php echo $METODO_PAGO; ?>" required>
                    <div class="invalid-feedback">
                        Por favor, ingresa un correo electrónico válido.
                    </div>
                </div>

                <!-- FECHA NACIMIENTO? -->
                <div class="form-actualizar-perfil">
                    <label for="FECHA_NACIMIENTO" class="form-label">Fecha nacimiento</label>
                    <input type="date" class="form-control" id="FECHA_NACIMIENTO" name="FECHA_NACIMIENTO"
                        value="<?php echo $FECHA_NACIMIENTO; ?>" required>
                    <div class="invalid-feedback">
                        Por favor, ingresa un correo electrónico válido.
                    </div>
                </div>

                <!-- Botones -->
                <div class="actualizar-perfil-btn">
                    <a href="../panel/perfil.php" class="volver-perfil-btn">Volver al Perfil</a>
                    <button type="submit" class="guardar-perfil-btn">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </main>

    <!-- Pie de página -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-column">
                <h3>Enlaces rápidos</h3>
                <ul>
                    <li><a href="../inicio.html">Inicio</a></li>
                    <li><a href="../categorias.html">Categorías</a></li>
                    <li><a href="../contacto.html">Contáctanos</a></li>
                    <li><a href="../about us.html">Sobre nosotros</a></li>
                    <li><a href="../mapa.html">Mapa del sitio</a></li>
                    <li><a href="../404.html">Error 404</a></li>
                    <li><a href="../500.html">Error 500</a></li>
                    <li><a href="../Dashboard.html">Dashboard</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h3>Contacto</h3>
                <p>📍 Dirección: Calle Principal #123</p>
                <p>📞 Teléfono: +57 123 456 789</p>
                <p>📧 Email: <a href="mailto:info@agrosellnova.com">info@agrosellnova.com</a></p>
            </div>

            <div class="footer-column">
                <h3>Síguenos</h3>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Agrosell Nova. Todos los derechos reservados. <a href="terminos.html">Términos y
                    condiciones</a></p>
        </div>
    </footer>

    <script>
        document.getElementById('notificationButton').addEventListener('click', () => alert("No tienes notificaciones pendientes"));
        window.addEventListener("scroll", () => {
            const menuBar = document.querySelector(".menu-bar");
            menuBar.classList.toggle("scrolled", window.scrollY > 50);
        });
        (() => {
            'use strict';
            document.querySelectorAll('.needs-validation').forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                });
            });
        })();
    </script>
</body>

</html>