<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario']) || !isset($_SESSION['rol'])) {
    header("Location: ../index.html"); // Redirigir al login si no hay sesión
    exit;
}

// Obtener datos del usuario
$usuario = $_SESSION['usuario'];
$rol = $_SESSION['rol'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de control</title>
    <link rel="stylesheet" href="../../css/panel.css">
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

                    <?php elseif ($rol == 'productor'): ?>
                        <li><a href="../inicio.html">Inicio</a></li>
                        <li><a href="ofertar_producto.php">Ofertar Producto</a></li>
                        <li><a href="gestionar_productos.php">Gestionar productos </a></li>
                    <?php elseif ($rol == 'cliente'): ?>

                    <?php endif; ?>
                    <li><a href="../../php/cerrarSesion.php">Cerrar Sesión</a></li>
                </ul>
            </div>
        </aside>

        <main class="ofertar-container">
            <h2 class="ofertar-titulo">Ofertar Producto</h2>
            <form action="../../php/guardar_producto.php" method="post" class="needs-validation" novalidate
                enctype="multipart/form-data">
                    <!-- Enviar el nombre de usuario -->
                <input type="hidden" name="USUARIO" id="USUARIO" value="<?php echo $usuario; ?>">
                
                <!-- foto -->
                <div class="ofertar-form">
                    <label for="foto" class="form-label">Foto del Producto</label>
                    <input type="file" name="PRODUCTO_IMAGEN" id="PRODUCTO_IMAGEN" class="form-control" accept="image/*"
                        required>
                    <div class="invalid-feedback">Por favor, selecciona una foto.</div>
                </div>

                <!-- Producto -->
                <div class="ofertar-form">
                    <label for="producto" class="form-label">Nombre producto</label>
                    <input type="text" name="NOMBRE_PRODUCTO" id="NOMBRE_PRODUCTO" class="form-control"
                        placeholder="Nombre del producto" required>
                    <div class="invalid-feedback">Por favor, selecciona un producto.</div>
                </div>


                <!-- Precio -->
                <div class="ofertar-form">
                    <label for="precio" class="form-label">Precio del producto - POR Kg</label>
                    <input type="number" name="PRECIO" id="PRECIO" class="form-control"
                        placeholder="Ingrese el precio del producto" required>
                    <div class="invalid-feedback">Por favor, ingrese un precio.</div>
                </div>

                <!-- Descripción -->
                <div class="ofertar-form">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea name="DESCRIPCION" id="DESCRIPCION" class="form-control" placeholder="Describa la oferta" required></textarea>
                    <div class="invalid-feedback">
                        Por favor, ingrese una descripción.
                    </div>
                </div>

                <!-- PESO KG -->
                <div class="ofertar-form">
                    <label for="peso_kg" class="form-label">Peso en KG</label>
                    <input type="number" name="PESO_KG" id="PESO_KG" class="form-control"
                        placeholder="Ingrese el peso en KG" required>
                    <div class="invalid-feedback">Por favor, ingrese un peso.</div>
                </div>

                <!-- STOCK -->
                <div class="ofertar-form">
                    <label for="STOCK" class="form-label">Stock</label>
                    <input type="number" name="STOCK" id="STOCK" class="form-control"
                        placeholder="Ingrese el Stock del producto" required>
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