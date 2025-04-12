<?php

class modulo_usuarios{
     public $ID_USUARIOS;
     public $NOMBRE_USUARIOS;
     public $DOCUMENTO;
     public $TELEFONO;
     public $DIRECCION;
     public $CORREO;
     public $METODO_PAGO;
     public $FECHA_NACIMIENTO;
     public $CONTRASEÑA;
     public $ROL;
     public $roles_ID_roles;
     
    public function __construct($ID_USUARIOS, $NOMBRE_USUARIOS, $DOCUMENTO, $TELEFONO, $DIRECCION, $CORREO, $METODO_PAGO, $FECHA_NACIMIENTO, $CONTRASEÑA, $ROL, $roles_ID_roles) {
        $this->ID_USUARIOS = $ID_USUARIOS;
        $this->NOMBRE_USUARIOS = $NOMBRE_USUARIOS;
        $this->DOCUMENTO = $DOCUMENTO;
        $this->TELEFONO = $TELEFONO;
        $this->DIRECCION = $DIRECCION;
        $this->CORREO = $CORREO;
        $this->METODO_PAGO = $METODO_PAGO;
        $this->FECHA_NACIMIENTO = $FECHA_NACIMIENTO;
        $this->CONTRASEÑA = $CONTRASEÑA;
        $this->ROL = $ROL;
        $this->roles_ID_roles = $roles_ID_roles;
    }

    public function getID_USUARIOS() {
        return $this->ID_USUARIOS;
    }

    public function setID_USUARIOS($ID_USUARIOS) {
        $this->ID_USUARIOS = $ID_USUARIOS;
    }

    public function getNOMBRE_USUARIOS() {
        return $this->NOMBRE_USUARIOS;
    }

    public function setNOMBRE_USUARIOS($NOMBRE_USUARIOS) {
        $this->NOMBRE_USUARIOS = $NOMBRE_USUARIOS;
    }

    public function getDOCMENTO() {
        return $this->DOCUMENTO;
    }

    public function setDOCMENTO($DOCUMENTO) {
        $this->DOCUMENTO = $DOCUMENTO;
    }

    public function getTELEFONO() {
        return $this->TELEFONO;
    }

    public function setTELEFONO($TELEFONO) {
        $this->TELEFONO = $TELEFONO;
    }

    public function getDIRECCION() {
        return $this->DIRECCION;
    }

    public function setDIRECCION($DIRECCION) {
        $this->DIRECCION = $DIRECCION;
    }

    public function getCORREO() {
        return $this->CORREO;
    }

    public function setCORREO($CORREO) {
        $this->CORREO = $CORREO;
    }

    public function getMETODO_PAGO() {
        return $this->METODO_PAGO;
    }

    public function setMETODO_PAGO($METODO_PAGO) {
        $this->METODO_PAGO = $METODO_PAGO;
    }

    public function getFECHA_NACIMIENTO() {
        return $this->FECHA_NACIMIENTO;
    }

    public function setFECHA_NACIMIENTO($FECHA_NACIMIENTO) {
        $this->FECHA_NACIMIENTO = $FECHA_NACIMIENTO;
    }

    public function getCONTRASEÑA() {
        return $this->CONTRASEÑA;
    }

    public function setCONTRASEÑA($CONTRASEÑA) {
        $this->CONTRASEÑA = $CONTRASEÑA;
    }

    public function getROL() {
        return $this->ROL;
    }

    public function setROL($ROL) {
        $this->ROL = $ROL;
    }

    public function getRoles_ID_roles() {
        return $this->roles_ID_roles;
    }

    public function setRoles_ID_roles($roles_ID_roles) {
        $this->roles_ID_roles = $roles_ID_roles;
    }
}

// Instancia de la clase modulo_usuarios
$modulo_usuarios = new modulo_usuarios(1, "ISMEL", 12406213, 3056423628, "Cra 113f #45 42", "ssismel28@gmail.com", "efectivo", "1998-08-28", "123456", "admin", 1);

echo "ID DEL USUARIO: " . $modulo_usuarios->getID_USUARIOS() . "\n";
echo "NOMBRE DEL USUARIO: " . $modulo_usuarios->getNOMBRE_USUARIOS() . "\n";
echo "DOCUMENTO DEL USUARIO: " . $modulo_usuarios->getDOCMENTO() . "\n";
echo "TELEFONO DEL USUARIO: " . $modulo_usuarios->getTELEFONO() . "\n";
echo "DIRECCION DEL USUARIO: " . $modulo_usuarios->getDIRECCION() . "\n";
echo "CORREO DEL USUARIO: ". $modulo_usuario->getCORREO() . "\n";
echo "METODO DE PAGO DEL USUARIO: " . $modulo_usuarios->getMETODO_PAGO() . "\n";
echo "FECHA DE NACIMIENTO DEL USUARIO: " . $modulo_usuarios->getFECHA_NACIMIENTO() . "\n";
echo "CONTRASEÑA DEL USUARIO: " . $modulo_usuarios->getCONTRASEÑA() . "\n";
echo "ROL DEL USUARIO: " . $modulo_usuarios->getROL() . "\n";
echo "ID DEL ROL DEL USUARIO: " . $modulo_usuarios->getRoles_ID_roles() . "\n";
echo "\n";

$modulo_usuarios->setID_USUARIOS(2);
$modulo_usuarios->setNOMBRE_USUARIOS("JUAN PEREZ");
$modulo_usuarios->setDOCMENTO(12345678);
$modulo_usuarios->setTELEFONO(3001234567);
$modulo_usuarios->setDIRECCION("Calle 123 #45-67");
$modulo_usuarios->setCORREO("correo@gmail.com");
$modulo_usuarios->setMETODO_PAGO("tarjeta de credito");
$modulo_usuarios->setFECHA_NACIMIENTO("1990-01-01");
$modulo_usuarios->setCONTRASEÑA("nueva_contraseña");
$modulo_usuarios->setROL("usuario");
$modulo_usuarios->setRoles_ID_roles(2);

echo "ID DEL USUARIO: " . $modulo_usuarios->getID_USUARIOS() . "\n";
echo "NOMBRE DEL USUARIO: " . $modulo_usuarios->getNOMBRE_USUARIOS() . "\n";
echo "DOCUMENTO DEL USUARIO: " . $modulo_usuarios->getDOCMENTO() . "\n";
echo "TELEFONO DEL USUARIO: " . $modulo_usuarios->getTELEFONO() . "\n";
echo "DIRECCION DEL USUARIO: " . $modulo_usuarios->getDIRECCION() . "\n";
echo "CORREO DEL USUARIO: ". $modulo_usuario->getCORREO() . "\n";
echo "METODO DE PAGO DEL USUARIO: " . $modulo_usuarios->getMETODO_PAGO() . "\n";
echo "FECHA DE NACIMIENTO DEL USUARIO: " . $modulo_usuarios->getFECHA_NACIMIENTO() . "\n";
echo "CONTRASEÑA DEL USUARIO: " . $modulo_usuarios->getCONTRASEÑA() . "\n";
echo "ROL DEL USUARIO: " . $modulo_usuarios->getROL() . "\n";
echo "ID DEL ROL DEL USUARIO: " . $modulo_usuarios->getRoles_ID_roles() . "\n";
echo "\n";

?>

