<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.html"); // Si no ha iniciado sesión, redirigir al login
    exit();
}

$usuario = $_SESSION['usuario']; // Obtener el nombre de usuario de la sesión

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

// Obtener los datos del usuario
$sql = "SELECT * FROM usuarios WHERE USUARIO = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "Usuario no encontrado.";
    exit();
}

$conn->close();
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="../../js/mostrarNombre.js" defer></script>
</head>

<body>
    <header class="top-bar">
        <div class="header-content">
            <img src="../img/logo.png" alt="Agrosell Nova" class="logo">
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
            <span><a href="../../php/cerrarSesion.php" class="username" id="usuario">Iniciar sesión/Registrarse</a></span>
            <a href="perfil.php" class="menu-icon">
                <i class="bi bi-person-circle" style="font-size: 30px;"></i>
            </a>
        </div>
    </header>

    <!-- Segunda barra -->
    <nav class="menu-bar">
        <ul>
            <li><a href="../inicio.html"><i class="fas fa-home"></i> Inicio</a></li>
            <li><a href="../productos.php"><i class="fas fa-box icon"></i> Productos</a></li>
            <li><a href="../categorias.html"><i class="fas fa-list"></i> Categorías</a></li>
            <li><a href="../reservas.html"><i class="fas fa-bookmark"></i> Reservas</a></li>
            <li><a href="../about_us.html"><i class="fas fa-info-circle"></i> Sobre nosotros</a></li>
            <li><a href="../contactanos.html"><i class="fas fa-envelope"></i> Contáctanos</a></li>
            <li><a href="../ayuda.html"><i class="fas fa-question-circle"></i> Ayuda</a></li>
        </ul>
    </nav>

    <!-- Contenedor Principal -->
    <main class="perfil-container">
        <div class="profile-container">
            <div class="row">
                <div class="col-md-4 text-center">
                    <img src="https://adaptcommunitynetwork.org/wp-content/uploads/2023/09/person-placeholder.jpg" alt="Foto de perfil" class="img-fluid rounded-circle profile-img">
                    <h3 class="mt-3"><?php echo htmlspecialchars($user['NOMBRE']); ?></h3>
                    <p class="text-muted"><?php echo htmlspecialchars($user['ROL']); ?></p>
                </div>
                <div class="col-md-8">
                    <h4>Detalles del Perfil</h4>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>ID Usuario:</strong> <?php echo htmlspecialchars($user['ID_USUARIO']); ?></li>
                        <li class="list-group-item"><strong>Nombre:</strong> <?php echo htmlspecialchars($user['NOMBRE']); ?></li>
                        <li class="list-group-item"><strong>Usuario:</strong> <?php echo htmlspecialchars($user['USUARIO']); ?></li>
                        <li class="list-group-item"><strong>Correo Electrónico:</strong> <?php echo htmlspecialchars($user['CORREO']); ?></li>
                        <li class="list-group-item"><strong>Documento:</strong> <?php echo htmlspecialchars($user['DOCUMENTO']); ?> </li>
                        <li class="list-group-item"><strong>Direccion:</strong> <?php echo htmlspecialchars($user['DIRECCION']); ?> </li>
                        <li class="list-group-item"><strong>Fecha de nacimiento:</strong> <?php echo htmlspecialchars($user['FECHA_NACIMIENTO']); ?> </li>
                        <li class="list-group-item"><strong>Rol:</strong> <?php echo htmlspecialchars($user['ROL']); ?></li>
                        <li class="list-group-item"><strong>ID rol:</strong> <?php echo htmlspecialchars($user['roles_ID_roles']); ?></li>
                    </ul>
                    <div class="d-flex justify-content-between mt-4">
                        <a href="../formulario/actualizar_datos_perfil.php?id=<?php echo $user['ID_USUARIO']; ?>" class="btn btn-warning">Editar Perfil</a>
                        <a href="../../php/cerrarSesion.php" class="btn btn-danger">Cerrar sesión</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-column">
                <h3>Enlaces rápidos</h3>
                <ul>
                    <li><a href="../inicio.html">Inicio</a></li>
                    <li><a href="../categorias.html">Categorías</a></li>
                    <li><a href="../contacto.html">Contáctanos</a></li>
                    <li><a href="../about_us.html">Sobre nosotros</a></li>
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
            <p>&copy; 2024 Agrosell Nova. Todos los derechos reservados. <a href="terminos.html">Términos y condiciones</a></p>
        </div>
    </footer>

    <script>

        document.getElementById('notificationButton').addEventListener('click', function() {
            alert("No tienes notificaciones pendientes");
        });
    
        function debounce(func, wait) {
            let timeout;
            return function(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func.apply(this, args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }
    
        window.addEventListener("scroll", debounce(function () {
            const menuBar = document.querySelector(".menu-bar");
            if (window.scrollY > 50) {
                menuBar.classList.add("scrolled");
            } else {
                menuBar.classList.remove("scrolled");
            }
        }, 100));
        </script>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>