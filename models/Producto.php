<?php

class Producto
{
    private $sku;
    private $nombre;
    private $descripcion;
    private $cantidad;
    private $stock_minimo;
    private $precio;

    public function __construct($nombre, $cantidad, $stock_minimo)
    {
        $this->setNombre($nombre);
        $this->setCantidad($cantidad);
        $this->setStockMinimo($stock_minimo);
    }


    public function getSku()
    {
        return $this->sku;
    }


    public function setSku($sku): self
    {
        $this->sku = $sku;

        return $this;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }


    public function getDescripcion()
    {
        return $this->descripcion;
    }


    public function setDescripcion($descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }


    public function getCantidad()
    {
        return $this->cantidad;
    }


    public function setCantidad($cantidad): self
    {
        $this->cantidad = $cantidad;

        return $this;
    }


    public function getStockMinimo()
    {
        return $this->stock_minimo;
    }


    public function setStockMinimo($stock_minimo): self
    {
        $this->stock_minimo = $stock_minimo;

        return $this;
    }


    public function getPrecio()
    {
        return $this->precio;
    }


    public function setPrecio($precio): self
    {
        $this->precio = $precio;

        return $this;
    }
}
