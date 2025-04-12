<?php

class moduloreservas{
    public $ID_Reservas;
    public $ID_Producto;
    public $Cantidad_Kg;
    public $FECHA_RESERVA;
    public $Metodo_pago;
    public $USUARIO_CLIENTE;
    public $usuarios_ID_USUARIO;


    public function __construct($ID_Reservas, $ID_Producto, $Cantidad_Kg, $FECHA_RESERVA, $Metodo_pago, $USUARIO_CLIENTE, $usuarios_ID_USUARIO){
        $this->ID_Reservas = $ID_Reservas;
        $this->ID_Producto = $ID_Producto;
        $this->Cantidad_Kg = $Cantidad_Kg;
        $this->FECHA_RESERVA = $FECHA_RESERVA;
        $this->Metodo_pago = $Metodo_pago;
        $this->USUARIO_CLIENTE = $USUARIO_CLIENTE;
        $this->usuarios_ID_USUARIO = $usuarios_ID_USUARIO;
    }
    
    public function get_ID_Reservas(){
        return $this->ID_Reservas;    
    }
    public function get_ID_Producto(){
        return $this->ID_Producto;
    }
    public function get_Cantidad_Kg(){
        return $this->Cantidad_Kg;

    }
    public function get_FECHA_RESERVA(){
        return $this->FECHA_RESERVA;
    }
    public function get_USUARIO_CLIENTE(){
        return $this->USUARIO_CLIENTE;
    }
    public function get_usuario_ID_USUARIO(){
        return $this->usuarios_ID_USUARIO;
    }

    public function set_ID_Reservas($ID_Reservas){
        $this->ID_Reservas=$ID_Reservas;    
    }
    public function set_ID_Producto($ID_Producto){
        $this->ID_Producto=$ID_Producto;
    }
    public function set_Cantidad_Kg($Cantidad_Kg){
        $this->Cantidad_Kg=$Cantidad_Kg;

    }
    public function set_FECHA_RESERVA($FECHA_RESERVA){
        $this->FECHA_RESERVA=$FECHA_RESERVA;
    }
    public function set_USUARIO_CLIENTE($USUARIO_CLIENTE){
        $this->USUARIO_CLIENTE=$USUARIO_CLIENTE;
    }
    public function set_usuario_ID_USUARIO($usuario_ID_USUARIO){
        $this->usuarios_ID_USUARIO=$usuario_ID_USUARIO;
    }

}

$moduloReservas = new moduloreservas(1,1,5,"29/03/2025","Efectivo","Laura","Laura123");
echo "N° Reserva: " . $moduloReservas->get_ID_Reservas() . "\n";
echo "ID Producto: " . $moduloReservas->get_ID_Producto() . "\n";                      
echo "Cantidad_Kg: " . $moduloReservas->get_Cantidad_Kg() . "\n";
echo "Fecha de reserva: " . $moduloReservas->get_FECHA_RESERVA() . "\n";
echo "Metodo pago: " . $moduloReservas->get_USUARIO_CLIENTE() . "\n";
echo "Cliente: " . $moduloReservas->get_USUARIO_CLIENTE() . "\n";
echo "Id cliente: " . $moduloReservas->get_usuario_ID_USUARIO() . "\n";
echo"\n";
$moduloReservas ->set_ID_Reservas(2);
$moduloReservas ->set_ID_Producto(2);
$moduloReservas -> set_Cantidad_kg(15);
$moduloReservas ->set_FECHA_RESERVA("29/03/2025");
$moduloReservas -> set_USUARIO_CLIENTE(2);
$moduloReservas ->set_usuario_ID_USUARIO(2);


echo "N° Reserva: " . $moduloReservas->get_ID_Reservas() . "\n";
echo "ID Producto: " . $moduloReservas->get_ID_Producto() . "\n";                      
echo "Cantidad_Kg: " . $moduloReservas->get_Cantidad_Kg() . "\n";
echo "Fecha de reserva: " . $moduloReservas->get_FECHA_RESERVA() . "\n";
echo "Metodo pago: " . $moduloReservas->get_USUARIO_CLIENTE() . "\n";
echo "Cliente: " . $moduloReservas->get_USUARIO_CLIENTE() . "\n";
echo "Id cliente: " . $moduloReservas->get_usuario_ID_USUARIO() . "\n";
echo"\n";
?>
