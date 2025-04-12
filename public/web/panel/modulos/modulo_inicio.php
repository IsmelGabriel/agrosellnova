<?php

class ModuloInicio {
    public $ID;
    public $usuario;
    public $contraseña;


    public function __construct($ID, $usuario, $contraseña) {
        $this->ID = $ID;
        $this->usuario = $usuario;
        $this->contraseña = $contraseña;
    }

    public function get_ID() {
        return $this->ID;
    }

    public function get_usuario() {
        return $this->usuario;
    }

    public function get_contraseña() {
        return $this->contraseña;
    }

    public function set_ID($ID) {
        $this->ID = $ID;
    }

    public function set_usuario($usuario) {
        $this->usuario = $usuario;
    }

    public function set_contraseña($contraseña) {
        $this->contraseña = $contraseña;
    }
}

$inicio = new ModuloInicio(1, "ismel", "salazar28");

echo "ID: " . $inicio->get_ID() . "\n";
echo "Usuario: " . $inicio->get_usuario() . "\n";
echo "Contraseña: " . $inicio->get_contraseña() . "\n";

echo "\nIniciando sesion...\n";

$inicio->set_ID(2);
$inicio->set_usuario("ismel gabriel salazar");
$inicio->set_contraseña("salazar28");

echo "ID: " . $inicio->get_ID() . "\n";
echo "Usuario: " . $inicio->get_usuario() . "\n";
echo "Contraseña: " . $inicio->get_contraseña() . "\n";


?>