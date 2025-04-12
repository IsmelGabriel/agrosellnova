<?php
// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'agrosell');

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Inicializar consulta base
$sql = "SELECT * FROM producto WHERE 1=1";

// Obtener parámetros de búsqueda
$nombre_producto = isset($_GET['producto']) ? trim($_GET['producto']) : '';
$precioMin = isset($_GET['precioMin']) ? (float)$_GET['precioMin'] : null;
$precioMax = isset($_GET['precioMax']) ? (float)$_GET['precioMax'] : null;
$orden = isset($_GET['orden']) ? $_GET['orden'] : 'recientes';

// Agregar filtros dinámicos
if (!empty($nombre_producto)) {
    $sql .= " AND NOMBRE_PRODUCTO LIKE '%" . $conn->real_escape_string($nombre_producto) . "%'";
}

// Agregar orden dinámico
switch ($orden) {
    case 'precio_menor':
        $sql .= " ORDER BY PRECIO ASC";
        break;
    case 'precio_mayor':
        $sql .= " ORDER BY PRECIO DESC";
        break;
    case 'nombre':
        $sql .= " ORDER BY NOMBRE_PRODUCTO ASC";
        break;
    default:
        $sql .= " ORDER BY ID_PRODUCTO DESC"; // Más recientes
        break;
}

// Ejecutar consulta
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos - Agrosell nova</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="../js/mostrarNombre.js"></script>
</head>
<body>
    <header class="top-bar">
        <div class="header-content">
            <img src="../img/logo.png" alt="Agrosell Nova" class="logo">
            <h1 class="menu-title">AGROSELL NOVA</h1>
            <div class="panel-option">
                <button id="panelControl">
                    <a href="panel/panel_control.php" class="menu-icon"><i class="fa fa-cog"></i></a>
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
            <span><a href="../php/cerrarSesion.php" class="username" id="usuario">Iniciar sesión/Registrarse</a></span>
            <a href="panel/perfil.php" class="menu-icon">
                <i class="bi bi-person-circle" style="font-size: 30px;"></i>
            </a>
        </div>
    </header>
    <!-- Segunda barra -->
    <nav class="menu-bar">
        <ul>
            <li><a href="inicio.html"><i class="fas fa-home"></i> Inicio</a></li>
            <li><a href="productos.php"><i class="fas fa-box icon"></i> Productos</a></li>
            <li><a href="categorias.html"><i class="fas fa-list"></i> Categorías</a></li>
            <li><a href="reservas.html"><i class="fas fa-bookmark"></i> Reservas</a></li> 
            <li><a href="about_us.html"><i class="fas fa-info-circle"></i> Sobre nosotros</a></li>
            <li><a href="contactanos.html"><i class="fas fa-envelope"></i> Contáctanos</a></li>
            <li><a href="ayuda.html"><i class="fas fa-question-circle"></i> Ayuda</a></li>
        </ul>
    </nav>
<main>
    <!-- Título de la página -->
    <section class="producto-titulo">
        <h1>¡Todos los productos que buscas están aquí!</h1>
    </section>

<!-- Filtros de productos -->
<section class="filtra-productos">
    <form action="" method="get">
        <label for="producto">Producto:</label>
        <input type="text" name="producto" id="nombre_producto" placeholder="Ej: Manzanas">
        
        <label for="orden">Ordenar por:</label>
        <select name="orden" id="orden">
            <option value="recientes">Más recientes</option>
            <option value="precio_menor">Precio menor</option>
            <option value="precio_mayor">Precio mayor</option>
            <option value="nombre">A-Z</option>
        </select>
        
        <button type="submit">BUSCAR PRODUCTO</button>
    </form>
</section>

    <!-- Lista de productos -->
    <section id="productos" class="productos-section">
        <?php
            //mostrar imagen nombre y precio del producto
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="productos-imagenes">';
                    echo '<img src="' . $row["PRODUCTO_IMAGEN"] . '" alt="IMAGEN NO ENCONTRADA">';
                    echo '<div class="productos-texto">';
                    echo '<h3>' . $row["NOMBRE_PRODUCTO"] . '</h3>';
                    echo '<p>$' . $row["PRECIO"] . ' Kg<br>' . 'Stock: ' . $row["STOCK"] . '</p>';
                    echo '<a href="#" class="btn-añadir-carrito" onclick="agregarAlCarrito(\'' . $row["NOMBRE_PRODUCTO"] . '\', ' . $row["PRECIO"] . ', \'' . $row["PRODUCTO_IMAGEN"] . '\')">Añadir al carrito</a>';
                    echo '</div></div>';
                }
            } else {
                echo "No hay productos disponibles.";
            }  
        ?>
    </section>
</main>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-column">
                <h3>Enlaces rápidos</h3>
                <ul>
                    <li><a href="inicio.html">Inicio</a></li>
                    <li><a href="categorias.html">Categorías</a></li>
                    <li><a href="contacto.html">Contáctanos</a></li>
                    <li><a href="about_us.html">Sobre nosotros</a></li>
                    <li><a href="mapa.html">Mapa del sitio</a></li>
                    <li><a href="404.html">Error 404</a></li>
                    <li><a href="500.html">Error 500</a></li>
                    <li><a href="Dashboard.html">Dashboard</a></li>
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

        function agregarAlCarrito(nombre, precio, imagen) {
            let cantidad = prompt(Ingrese la cantidad de "${nombre}" que desea agregar:, "1");

            // Validar si el usuario presionó "Cancelar" o dejó el campo vacío
            if (cantidad === null || cantidad.trim() === "" || isNaN(cantidad) || cantidad <= 0) {
                alert("Operación cancelada o cantidad inválida. No se agregó el producto al carrito.");
                return; // Salir de la función sin agregar el producto
            }

            cantidad = parseInt(cantidad); // Convertir a número entero

            // Obtener carrito desde el localStorage
            const carrito = JSON.parse(localStorage.getItem("carrito")) || [];

            // Crear objeto producto
            const producto = { nombre, precio, imagen, cantidad };
            
            // Agregar al carrito
            carrito.push(producto);
            localStorage.setItem("carrito", JSON.stringify(carrito));

            alert(${nombre} (${cantidad}) se ha añadido al carrito.);
        }
    </script>
</body>
</html>