<?php

class ModuloReseñas {
    public $ID;
    public $usuario_id;
    public $puntuacion;
    public $comentario;
    public $fecha_reseña;

    public function __construct($ID, $usuario_id, $puntuacion, $comentario, $fecha_reseña) {
        $this->ID = $ID;
        $this->usuario_id = $usuario_id;
        $this->puntuacion = $puntuacion;
        $this->comentario = $comentario;
        $this->fecha_reseña = $fecha_reseña;
    }

    public function get_ID() {
        return $this->ID;
    }
    public function get_usuario_id() {
        return $this->usuario_id;
    }
    public function get_puntuacion() {
        return $this->puntuacion;
    }
    public function get_comentario() {
        return $this->comentario;
    }
    public function get_fecha_reseña() {
        return $this->fecha_reseña;
    }

    public function set_ID($ID) {
        $this->ID = $ID;
    }
    public function set_usuario_id($usuario_id) {
        $this->usuario_id = $usuario_id;
    }
    public function set_puntuacion($puntuacion) {
        $this->puntuacion = $puntuacion;
    }
    public function set_comentario($comentario) {
        $this->comentario = $comentario;
    }
    public function set_fecha_reseña($fecha_reseña) {
        $this->fecha_reseña = $fecha_reseña;
    }
}

$reseña = new ModuloReseñas(1, 101, 5, "Excelente producto, muy recomendado!", "03/04/2025");

echo "ID Reseña: " . $reseña->get_ID() . "\n";
echo "ID Usuario: " . $reseña->get_usuario_id() . "\n";
echo "Puntuación: " . $reseña->get_puntuacion() . "\n";
echo "Comentario: " . $reseña->get_comentario() . "\n";
echo "Fecha de Reseña: " . $reseña->get_fecha_reseña() . "\n";

echo "\nActualizando datos...\n";
$reseña->set_ID(2);
$reseña->set_usuario_id(202);
$reseña->set_puntuacion(4);
$reseña->set_comentario("Muy bueno, pero puede mejorar.");
$reseña->set_fecha_reseña("04/04/2025");

echo "ID Reseña: " . $reseña->get_ID() . "\n";
echo "ID Usuario: " . $reseña->get_usuario_id() . "\n";
echo "Puntuación: " . $reseña->get_puntuacion() . "\n";
echo "Comentario: " . $reseña->get_comentario() . "\n";
echo "Fecha de Reseña: " . $reseña->get_fecha_reseña() . "\n";
?>
