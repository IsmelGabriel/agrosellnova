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


$sql = "SELECT * FROM producto WHERE USUARIO_CAMPESINO = '$usuario' AND ID_PRODUCTO = '" . $_GET['id'] . "'";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    $producto = $resultado->fetch_assoc();
} else {
    echo "No se encontró el producto.";
    exit;
}

$NOMBRE_PRODUCTO = $producto['NOMBRE_PRODUCTO'];
$PRECIO = $producto['PRECIO'];
$DESCRIPCION = $producto['DESCRIPCION'];
$PESO_KG = $producto['PESO_KG'];
$STOCK = $producto['STOCK'];
$ID_PRODUCTO = $producto['ID_PRODUCTO'];
$USUARIO_CAMPESINO = $producto['USUARIO_CAMPESINO'];


// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $NOMBRE_PRODUCTO = $_POST['NOMBRE_PRODUCTO'];
    $PRECIO = $_POST['PRECIO'];
    $DESCRIPCION = $_POST['DESCRIPCION'];
    $PESO_KG = $_POST['PESO_KG'];
    $STOCK = $_POST['STOCK'];

    // Actualizar el producto en la base de datos
    $sql_update = "UPDATE producto SET NOMBRE_PRODUCTO='$NOMBRE_PRODUCTO', PRECIO='$PRECIO', DESCRIPCION='$DESCRIPCION', PESO_KG='$PESO_KG', STOCK='$STOCK' WHERE ID_PRODUCTO='$ID_PRODUCTO'";
    
    if ($conn->query($sql_update) === TRUE) {
        echo "<script>alert('Producto actualizado correctamente.');</script>";
        header("Location: ../web/panel/gestionar_productos.php"); // Redirigir a la página de gestión de productos
        exit;
    } else {
        echo "<script>alert('Error al actualizar el producto: ');</script>";
    }
}


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de control</title>
    <link rel="stylesheet" href="../css/panel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css"
        rel="stylesheet">
</head>

<body class="panel-control">
    <header class="Bienvenido">
        <h1>Bienvenido, <?php echo ucfirst($usuario); ?></h1>
        <p>Rol: <?php echo ucfirst($rol); ?></p>
    </header>
    <div class="panel-container">
        <!-- Barra lateral -->
        <aside class="sidebar">
            <div class="lateral-content">
                <ul>
                    <?php if ($rol == 'administrador'): ?>
                        <li><a href="../inicio.html">Inicio</a></li>
                        <li><a href="reporte_ventas.php">Reporte de Ventas</a></li>
                        <li><a href="reporte_reservas.php">Reporte de Reservas</a></li>
                        <!--<li><a href="reporte_inventario.php">Reporte de Inventario</a></li>-->
                        <li><a href="reporte_pqrs.php">Reporte de PQRS</a></li>
                        <li><a href="actualizar_datos.php">Actualizar Roles</a></li>
                        <li><a href="usuarios_registrados.php">Usuarios Registrados</a></li>
                    <?php elseif ($rol == 'productor'): ?>
                        <li><a href="../inicio.html">Inicio</a></li>
                        <li><a href="ofertar_producto.php">Ofertar Producto</a></li>
                        <li><a href="gestionar_productos.php">Gestionar productos </a></li>
                    <?php elseif ($rol == 'cliente'): ?>
                        <li><a href="../inicio.html">Inicio</a></li>
                        <li><a href="../productos.php">Ver Productos</a></li>
                        <li><a href="../reservas.html">Realizar Reserva</a></li>
                    <?php endif; ?>
                    <li><a href="cerrarSesion.php">Cerrar Sesión</a></li>
                </ul>
            </div>
        </aside>

        <main class="ofertar-container">
            <h2 class="ofertar-titulo">Editar Producto</h2>
            <form action="" method="post" class="needs-validation" novalidate
                enctype="multipart/form-data">
                    <!-- Enviar el nombre de usuario -->

                <!-- Producto -->
                <div class="ofertar-form">
                    <label for="producto" class="form-label">Nombre producto</label>
                    <input type="text" name="NOMBRE_PRODUCTO" id="NOMBRE_PRODUCTO" value="<?php echo $NOMBRE_PRODUCTO; ?>" class="form-control" required>
                    <div class="invalid-feedback">Por favor, selecciona un producto.</div>
                </div>


                <!-- Precio -->
                <div class="ofertar-form">
                    <label for="precio" class="form-label">Precio del producto - POR Kg</label>
                    <input type="number" name="PRECIO" id="PRECIO" value="<?php echo $PRECIO; ?>" class="form-control" required>
                    <div class="invalid-feedback">Por favor, ingrese un precio.</div>
                </div>

                <!-- Descripción -->
                <div class="ofertar-form">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea name="DESCRIPCION" id="DESCRIPCION" value="<?php echo $DESCRIPCION; ?>" class="form-control" required></textarea>
                    <div class="invalid-feedback">
                        Por favor, ingrese una descripción.
                    </div>
                </div>

                <!-- PESO KG -->
                <div class="ofertar-form">
                    <label for="peso_kg" class="form-label">Peso en KG</label>
                    <input type="number" name="PESO_KG" id="PESO_KG" value="<?php echo $PESO_KG; ?>" class="form-control" required>
                    <div class="invalid-feedback">Por favor, ingrese un peso.</div>
                </div>

                <!-- STOCK -->
                <div class="ofertar-form">
                    <label for="STOCK" class="form-label">Stock</label>
                    <input type="number" name="STOCK" id="STOCK" value="<?php echo $STOCK; ?>" class="form-control" required>
                    <div class="invalid-feedback">Por favor, ingrese el Stock.</div>
                </div>
                <!-- Botón -->
                <button type="submit" class="confirmar-oferta-btn">Guardar Oferta</button>
            </form>

        </main>
    </div>

    <script>
        window.addEventListener("scroll", () => {
            const menuBar = document.querySelector(".menu-bar");
            menuBar.classList.toggle("scrolled", window.scrollY > 50);
        });
        // Validación de Bootstrap
        (function () {
            'use strict'
            const forms = document.querySelectorAll('.needs-validation')
            Array.from(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
</body>
</html>