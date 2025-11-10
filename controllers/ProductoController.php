<?php

require_once __DIR__ . "/../config/Database.php";
require_once __DIR__ . "/../models/Producto.php";

class ProductoController
{
    private $con;

    public function __construct()
    {
        $db = new Database();
        $this->con = $db->getCon();
    }

    public function alta(Producto $producto)
    {
        $query = "INSERT INTO producto (nombre ,cantidad ,stock_minimo) VALUES (:nombre,:cantidad,:stock);";

        $stmt = $this->con->prepare($query);
        $data = [
            ":nombre" => $producto->getNombre(),
            ":cantidad" => $producto->getCantidad(),
            ":stock" => $producto->getStockMinimo(),
        ];

        if ($stmt->execute($data)) {
            return ["status" => "success", "message" => "Producto creado correctamente"];
        } else {
            return ["status" => "error", "message" => "Error al crear el producto"];
        }
    }

    public function obtenerProductos()
    {
        $query = "SELECT * FROM producto";

        $stmt = $this->con->prepare($query);

        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public function obtenerProducto($id)
    {
        $query = "SELECT * FROM producto WHERE id = :id";

        $data = [
            ":id" => $id,
        ];

        $stmt = $this->con->prepare($query);

        if ($stmt->execute($data)) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public function agregar($id, $cantidad)
    {
        $producto = $this->obtenerProducto($id);

        if (!$producto) {
            return ["status" => "error", "message" => "El producto no se ha encontrado"];
        }

        $query = "UPDATE producto SET cantidad = cantidad + :cantidad WHERE id = :id";

        $data = [
            ":cantidad" => $cantidad,
            ":id" => $id,
        ];

        $stmt = $this->con->prepare($query);
        if ($stmt->execute($data)) {
            if ($stmt->rowCount()) {
                return ["status" => "succes", "message" => "Se han agregado $cantidad unidades correctamente!"];
            }
        } else {
            return ["status" => "error", "message" => "Ha ocurrido un error al agregar unidades al producto"];
        }
    }

    public function quitar($id, $cantidad)
    {
        $producto = $this->obtenerProducto($id);

        if (!$producto) {
            return ["status" => "error", "message" => "El producto no se ha encontrado"];
        }

        if ($cantidad > $producto['cantidad']) {
            return ["status" => "error", "message" => "No se puede eliminar más de la cantidad actual del producto"];
        }

        $query = "UPDATE producto SET cantidad = cantidad - :cantidad WHERE id = :id";

        $data = [
            ":cantidad" => $cantidad,
            ":id" => $id,
        ];

        $stmt = $this->con->prepare($query);
        if ($stmt->execute($data)) {
            if ($stmt->rowCount()) {
                return ["status" => "succes", "message" => "Se han eliminado $cantidad unidades correctamente!"];
            }
        } else {
            return ["status" => "error", "message" => "Ha ocurrido un error al eliminar unidades del producto"];
        }
    }
}
