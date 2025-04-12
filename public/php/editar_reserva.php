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

// Obtener los datos de la reserva
$sql = "SELECT * FROM reservas WHERE USUARIO_CLIENTE = '$usuario' AND ID_Reservas = '" . $_GET['id'] . "'";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    $producto = $resultado->fetch_assoc();

    // Inicializar las variables con los datos de la reserva
    $USUARIO_DOCUMENTO = $producto['USUARIO_DOCUMENTO'];
    $USUARIO_TELEFONO = $producto['USUARIO_TELEFONO'];
    $USUARIO_CORREO = $producto['USUARIO_CORREO'];
    $PRODUCTO = $producto['PRODUCTO'];
    $CANTIDAD = $producto['CANTIDAD_KG'];
    $METODO_PAGO = $producto['METODO_PAGO'];
} else {
    echo "No se encontró la reserva.";
    exit;
}

$ID_Reservas = $producto['ID_Reservas'];

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos enviados desde el formulario
    $USUARIO_DOCUMENTO = $conn->real_escape_string($_POST['USUARIO_DOCUMENTO']);
    $USUARIO_TELEFONO = $conn->real_escape_string($_POST['USUARIO_TELEFONO']);
    $USUARIO_CORREO = $conn->real_escape_string($_POST['USUARIO_CORREO']);
    $PRODUCTO = $conn->real_escape_string($_POST['NOMBRE_PRODUCTO']);
    $CANTIDAD = $conn->real_escape_string($_POST['CANTIDAD_KG']);
    $METODO_PAGO = $conn->real_escape_string($_POST['METODO_PAGO']);

    // Actualizar el producto en la base de datos
    $sql_update = "UPDATE reservas 
                   SET USUARIO_DOCUMENTO = '$USUARIO_DOCUMENTO', 
                       USUARIO_TELEFONO = '$USUARIO_TELEFONO', 
                       USUARIO_CORREO = '$USUARIO_CORREO', 
                       PRODUCTO = '$PRODUCTO', 
                       CANTIDAD_KG = '$CANTIDAD', 
                       METODO_PAGO = '$METODO_PAGO' 
                   WHERE ID_Reservas = '$ID_Reservas'";

    if ($conn->query($sql_update) === TRUE) {
        echo "<script>alert('Reserva actualizada correctamente.');</script>";
        header("Location: ../web/panel/gestionar_reservas.php");
        exit;
    } else {
        echo "<script>alert('Error al actualizar la reserva: " . $conn->error . "');</script>";
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
            <h2 class="ofertar-titulo">Editar reserva</h2>
            <form action="" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                <!-- Enviar el nombre de usuario -->
                <input type="hidden" name="usuario" value="<?php echo $usuario; ?>">
                <input type="hidden" name="ID_Reservas" value="<?php echo $ID_Reservas; ?>">

                <!-- documento -->
                <div class="ofertar-form">
                    <label for="documento" class="form-label">Documento</label>
                    <input type="text" name="USUARIO_DOCUMENTO" id="USUARIO_DOCUMENTO"
                        value="<?php echo $USUARIO_DOCUMENTO; ?>" class="form-control" required>
                        <div class="invalid-feedback">Por favor, ingresa un documento.</div>
                </div>

                <!-- Telefono -->
                <div class="ofertar-form">
                    <label for="telefono" class="form-label">Telefono</label>
                    <input type="text" name="USUARIO_TELEFONO" id="USUARIO_TELEFONO"
                        value="<?php echo $USUARIO_TELEFONO; ?>" class="form-control" required>
                    <div class="invalid-feedback">Por favor, ingresa un telefono.</div>
                </div>

                <!-- correo -->
                <div class="ofertar-form">
                    <label for="correo" class="form-label">Correo</label>
                    <input type="email" name="USUARIO_CORREO" id="USUARIO_CORREO"
                        value="<?php echo $USUARIO_CORREO; ?>" class="form-control" required>
                    <div class="invalid-feedback">Por favor, ingrese un correo.</div>
                </div>

                <!-- Producto -->
                <div class="ofertar-form">
                    <label for="producto" class="form-label">Nombre producto</label>
                    <input type="text" name="NOMBRE_PRODUCTO" id="NOMBRE_PRODUCTO"
                        value="<?php echo $PRODUCTO; ?>" class="form-control" required>
                    <div class="invalid-feedback">Por favor, selecciona un producto.</div>
                </div>

                <!-- cantidad -->
                <div class="ofertar-form">
                    <label for="cantidad" class="form-label">Cantidad</label>
                    <input type="number" name="CANTIDAD_KG" id="CANTIDAD_KG"
                        value="<?php echo $CANTIDAD; ?>" class="form-control" required>
                    <div class="invalid-feedback">Por favor, ingrese una cantidad.</div>
                </div>

                <!-- metodo de pago -->
                <div class="ofertar-form">
                    <label for="metodo_pago" class="form-label">Metodo de pago</label>
                    <select type="text" name="METODO_PAGO" id="METODO_PAGO"
                        value="<?php echo $METODO_PAGO; ?>" class="form-control" required>
                        <option value="DE_CONTADO">De contado</option>
                        <option value="EFECTIVO">Efectivo</option>
                        <option value="TARJETA">Tarjeta</option>
                        <option value="TRANSFERENCIA">Transferencia</option>
                        <option value="NEQUI">Nequi</option>
                    </select>
                    <div class="invalid-feedback">Por favor, ingrese un metodo de pago.</div>
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