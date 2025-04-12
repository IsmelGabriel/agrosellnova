<?php
class ModuloRegistro{
    public $ID;
    public $nombre;
    public $usuario;
    public $correo;
    public $contrasena;


    public function __construct($ID, $nombre, $usuario, $correo, $contrasena) {
        $this->ID = $ID;
        $this->nombre = $nombre;
        $this->usuario = $usuario;
        $this->correo = $correo;
        $this->contrasena = $contrasena;
    }

    public function get_ID() {
        return $this->ID;
    }

    public function get_nombre() {
        return $this->nombre;
    }

    public function get_usuario() {
        return $this->usuario;
    }

    public function get_correo() {
        return $this->correo;
    }

    public function get_contrasena() {
        return $this->contrasena;
    }

    public function set_ID($ID) {
        $this->ID = $ID;
    }

    public function set_nombre($nombre) {
        $this->nombre = $nombre;
    }

    public function set_usuario($usuario) {
        $this->usuario = $usuario;
    }

    public function set_correo($correo) {
        $this->correo = $correo;
    }

    public function set_contrasena($contrasena) {
        $this->contrasena = $contrasena;
    }
}

$registro = new ModuloRegistro(1, "ismel gabriel salazar", "ismel", "ssismel28@gmail.com", "salazar28");

echo "Registro de Usuario:\n";
echo "ID: " . $registro->get_ID() . "\n";
echo "Nombre: " . $registro->get_nombre() . "\n";
echo "Usuario: " . $registro->get_usuario() . "\n";
echo "Correo: " . $registro->get_correo() . "\n";
echo "Contraseña: " . $registro->get_contrasena() . "\n";

echo "\nRegistrado...\n";
$registro->set_ID(2);
$registro->set_nombre("Juan Perez");
$registro->set_usuario("juanperez");
$registro->set_correo("juan@gmail.com");
$registro->set_contrasena("juan1234");

echo "ID: " . $registro->get_ID() . "\n";
echo "Nombre: " . $registro->get_nombre() . "\n";
echo "Usuario: " . $registro->get_usuario() . "\n";
echo "Correo: " . $registro->get_correo() . "\n";
echo "Contraseña: " . $registro->get_contrasena() . "\n";


?>