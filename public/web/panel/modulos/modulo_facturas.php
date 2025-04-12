<?php

class modulo_factura {
    public $ID;
    public $ID_factura;
    public $cliente;
    public $direccion;
    public $metodo_pago;
    public $correo;
    public $telefono;
    public $valor_compra;
    public $descuento;
    public $productos;
    public $cantidad;
    public $fecha;
    public $impuesto;
        
    public function __construct($ID, $ID_factura, $cliente, $direccion, $metodo_pago, $correo, $telefono, $valor_compra, $descuento, $productos, $cantidad, $fecha, $impuesto) {
        $this->ID = $ID;
        $this->ID_factura = $ID_factura;
        $this->cliente = $cliente;
        $this->direccion = $direccion;
        $this->metodo_pago = $metodo_pago;
        $this->correo = $correo;
        $this->telefono = $telefono;
        $this->valor_compra = $valor_compra;
        $this->descuento = $descuento;
        $this->productos = $productos;
        $this->cantidad = $cantidad;
        $this->fecha = $fecha;
        $this->impuesto = $impuesto;
    }
    public function getID() {
        return $this->ID;
    }

    public function setID($ID) {
        $this->ID = $ID;
    }

    public function getID_factura() {
        return $this->ID_factura;
    }

    public function setID_factura($ID_factura) {
        $this->ID_factura = $ID_factura;
    }

    public function getCliente() {
        return $this->cliente;
    }

    public function setCliente($cliente) {
        $this->cliente = $cliente;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    public function getMetodo_pago() {
        return $this->metodo_pago;
    }

    public function setMetodo_pago($metodo_pago) {
        $this->metodo_pago = $metodo_pago;
    }

    public function getCorreo() {
        return $this->correo;
    }

    public function setCorreo($correo) {
        $this->correo = $correo;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function getValor_compra() {
        return $this->valor_compra;
    }

    public function setValor_compra($valor_compra) {
        $this->valor_compra = $valor_compra;
    }

    public function getDescuento() {
        return $this->descuento;
    }

    public function setDescuento($descuento) {
        $this->descuento = $descuento;
    }

    public function getProductos() {
        return $this->productos;
    }

    public function setProductos($productos) {
        $this->productos = $productos;
    }

    public function getCantidad() {
        return $this->cantidad;
    }

    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function getImpuesto() {
        return $this->impuesto;
    }

    public function setImpuesto($impuesto) {
        $this->impuesto = $impuesto;
    }
}

$moduloFactura = new modulo_factura(
    2, 3002, "Maria Lopez", "Avenida Siempre Viva 742", "PayPal", 
    "maria.lopez@example.com", "987654321", 200000, 10000, 
    "Combo de conos", 3, "02/02/2023", 3800);

echo "ID: " . $moduloFactura->getID() . "\n";
echo "ID Factura: " . $moduloFactura->getID_factura() . "\n";
echo "Cliente: " . $moduloFactura->getCliente() . "\n";
echo "Dirección: " . $moduloFactura->getDireccion() . "\n";
echo "Método de pago: " . $moduloFactura->getMetodo_pago() . "\n";
echo "Correo: " . $moduloFactura->getCorreo() . "\n";
echo "Teléfono: " . $moduloFactura->getTelefono() . "\n";
echo "Valor de compra: $" . $moduloFactura->getValor_compra() . "\n";
echo "Descuento: $" . $moduloFactura->getDescuento() . "\n";
echo "Productos: " . $moduloFactura->getProductos() . "\n";
echo "Cantidad: " . $moduloFactura->getCantidad() . "\n";
echo "Fecha: " . $moduloFactura->getFecha() . "\n";
echo "Impuesto: $" . $moduloFactura->getImpuesto() . "\n";
echo "\n";

// Segundo objeto - Juan Pérez con datos diferentes
$moduloFactura->setID(3);
$moduloFactura->setID_factura(4003);
$moduloFactura->setCliente("Juan Perez");
$moduloFactura->setDireccion("Calle 456");
$moduloFactura->setMetodo_pago("Efectivo");
$moduloFactura->setCorreo("juan.perez2@example.com");
$moduloFactura->setTelefono("123123123");
$moduloFactura->setValor_compra(175000);
$moduloFactura->setDescuento(7000);
$moduloFactura->setProductos("Cono de jamón y queso");
$moduloFactura->setCantidad(4);
$moduloFactura->setFecha("03/03/2023");
$moduloFactura->setImpuesto(3200);

// Mostrar información de Juan Pérez
echo "ID: " . $moduloFactura->getID() . "\n";
echo "ID Factura: " . $moduloFactura->getID_factura() . "\n";
echo "Cliente: " . $moduloFactura->getCliente() . "\n";
echo "Dirección: " . $moduloFactura->getDireccion() . "\n";
echo "Método de pago: " . $moduloFactura->getMetodo_pago() . "\n";
echo "Correo: " . $moduloFactura->getCorreo() . "\n";
echo "Teléfono: " . $moduloFactura->getTelefono() . "\n";
echo "Valor de compra: $" . $moduloFactura->getValor_compra() . "\n";
echo "Descuento: $" . $moduloFactura->getDescuento() . "\n";
echo "Productos: " . $moduloFactura->getProductos() . "\n";
echo "Cantidad: " . $moduloFactura->getCantidad() . "\n";
echo "Fecha: " . $moduloFactura->getFecha() . "\n";
echo "Impuesto: $" . $moduloFactura->getImpuesto() . "\n";
echo "\n";

?>