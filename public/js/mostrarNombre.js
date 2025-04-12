document.addEventListener("DOMContentLoaded", function () {
    const nombreUsuario = localStorage.getItem("usuario");
    const usuarioElemento = document.getElementById("usuario");

    if (nombreUsuario) {
        usuarioElemento.textContent = nombreUsuario; // Mostrar nombre de usuario
    } else {
        usuarioElemento.textContent = "Iniciar sesion/ Registrate";
    }
});
