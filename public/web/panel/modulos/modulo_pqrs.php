<?php

class modulo_pqrs{
    public $ID;

    public $USUARIO_ID;
    
    public $Usuario_cliente;

    public $Correo;

    public $Telefono;

    public $FECHA;

    public $MENSAJE;

public function __construct($ID, $USUARIO_ID, $Usuario_cliente, $Correo, $Telefono, $FECHA, $MENSAJE) {
    $this->ID = $ID;
    $this->USUARIO_ID = $USUARIO_ID;
    $this->Usuario_cliente = $Usuario_cliente;
    $this->Correo = $Correo;
    $this->Telefono = $Telefono;
    $this->FECHA = $FECHA;
    $this->MENSAJE = $MENSAJE;
}

public function getID() {
    return $this->ID;
}

public function setID($ID) {
    $this->ID = $ID;
}

public function getUSUARIO_ID() {
    return $this->USUARIO_ID;
}

public function setUSUARIO_ID($USUARIO_ID) {
    $this->USUARIO_ID = $USUARIO_ID;
}

public function getUsuario_cliente() {
    return $this->Usuario_cliente;
}

public function setUsuario_cliente($Usuario_cliente) {
    $this->Usuario_cliente = $Usuario_cliente;
}

public function getCorreo() {
    return $this->Correo;
}

public function setCorreo($Correo) {
    $this->Correo = $Correo;
}

public function getTelefono() {
    return $this->Telefono;
}

public function setTelefono($Telefono) {
    $this->Telefono = $Telefono;
}

public function getFECHA() {
    return $this->FECHA;
}

public function setFECHA($FECHA) {
    $this->FECHA = $FECHA;
}

public function getMENSAJE() {
    return $this->MENSAJE;
}

public function setMENSAJE($MENSAJE) {
    $this->MENSAJE = $MENSAJE;
}
}
$moduloPQRS = new modulo_pqrs(1, 101, "Juan Perez", "juan.perez@example.com", "123456789", "01/01/2023", "Mensaje de prueba");
echo "ID: " . $moduloPQRS->getID() . "\n";
echo "Usuario ID: " . $moduloPQRS->getUSUARIO_ID() . "\n";
echo "Usuario Cliente: " . $moduloPQRS->getUsuario_cliente() . "\n";
echo "Correo: " . $moduloPQRS->getCorreo() . "\n";
echo "Teléfono: " . $moduloPQRS->getTelefono() . "\n";
echo "Fecha: " . $moduloPQRS->getFECHA() . "\n";
echo "Mensaje: " . $moduloPQRS->getMENSAJE() . "\n";
echo "\n";

$moduloPQRS->setID(2);
$moduloPQRS->setUSUARIO_ID(102);
$moduloPQRS->setUsuario_cliente("Maria Lopez");
$moduloPQRS->setCorreo("maria.lopez@example.com");
$moduloPQRS->setTelefono("987654321");
$moduloPQRS->setFECHA("02/02/2023");
$moduloPQRS->setMENSAJE("Mensaje actualizado");

echo "ID: " . $moduloPQRS->getID() . "\n";
echo "Usuario ID: " . $moduloPQRS->getUSUARIO_ID() . "\n";
echo "Usuario Cliente: " . $moduloPQRS->getUsuario_cliente() . "\n";
echo "Correo: " . $moduloPQRS->getCorreo() . "\n";
echo "Teléfono: " . $moduloPQRS->getTelefono() . "\n";
echo "Fecha: " . $moduloPQRS->getFECHA() . "\n";
echo "Mensaje: " . $moduloPQRS->getMENSAJE() . "\n";
?>
