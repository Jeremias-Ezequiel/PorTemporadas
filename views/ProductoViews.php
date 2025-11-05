<?php

require_once __DIR__ . "/../controllers/ProductoController.php";

class ProductoViews
{
    private $productoController;

    public function __construct()
    {
        $this->productoController = new ProductoController();
    }

    public function mostrarProductos()
    {
        $productos = $this->productoController->obtenerProductos();

        var_dump($productos);
    }
}
