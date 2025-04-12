document.addEventListener("DOMContentLoaded", function () {
    fetch("../php/mostrar_productos.php")
        .then(response => response.json())
        .then(data => mostrarProductos(data))
        .catch(error => console.error("Error al obtener los productos:", error));
});

function mostrarProductos(productos) {
    const contenedorProductos = document.getElementById("productos");

    productos.forEach(producto => {
        const contenedor = document.createElement("div");
        contenedor.classList.add("productos-imagenes");

        const imagen = document.createElement("img");
        imagen.src = producto.PRODUCTO_IMAGEN || "../img/logo.png";
        imagen.alt = "IMAGEN NO ENCONTRADA";
        imagen.onerror = function () {
            this.src = "../img/imagen-no-encontrada.jpg";
        };

        const texto = document.createElement("div");
        texto.classList.add("productos-texto");

        const nombre = document.createElement("h3");
        nombre.textContent = producto.NOMBRE_PRODUCTO;

        const precio = document.createElement("p");
        precio.textContent = `$${producto.PRECIO} LB`;

        const enlace = document.createElement("a");
        enlace.href = "#";
        enlace.classList.add("btn-añadir-carrito");
        enlace.textContent = "Añadir al carrito";
        enlace.onclick = function () {
            agregarAlCarrito(producto.NOMBRE_PRODUCTO, producto.PRECIO, producto.PRODUCTO_IMAGEN);
            return false; // para que no se recargue la página
        };

        texto.appendChild(nombre);
        texto.appendChild(precio);
        texto.appendChild(enlace);

        contenedor.appendChild(imagen);
        contenedor.appendChild(texto);

        contenedorProductos.appendChild(contenedor);
    });
}

function agregarAlCarrito(nombre, precio, imagen) {
    let carrito = JSON.parse(localStorage.getItem("carrito")) || [];
    carrito.push({ NOMBRE_PRODUCTO: nombre, PRECIO: precio, PRODUCTO_IMAGEN: imagen });
    localStorage.setItem("carrito", JSON.stringify(carrito));
    alert(`Has añadido "${nombre}" al carrito.`);
}
