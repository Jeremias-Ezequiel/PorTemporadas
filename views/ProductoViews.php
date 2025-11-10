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
?>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Opcion</th>
                </tr>
            </thead>
            <tbody>
                <form action="" method="get">
                    <?php

                    foreach ($productos as $producto) {
                    ?>
                        <tr>
                            <td><?= $producto['nombre'] ?></td>
                            <td><?= $producto['cantidad'] ?> </td>
                            <td><input type="radio" value="<?= $producto['id'] ?> " required name="producto"></td>
                        </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td colspan="3">
                            <input type="hidden">
                            <button name="seccion" value="eliminar">Eliminar</button>
                            <button name="seccion" value="agregar">Agregar</button>
                        </td>
                    </tr>
                </form>
            </tbody>
        </table>
    <?php
    }

    public function formulario($accion, $id)
    {
        $producto = $this->productoController->obtenerProducto($id);
    ?>
        <form action="" method="post">
            <h3><?= $producto['nombre'] ?> </h3>
            <input type="number" min="0" required name="cantidad">
            <input type="hidden" name="nombre" value="<?= $id['nombre'] ?>">
            <button name="tipo" value="<?= $accion ?>"><?= $accion ?></button>
        </form>
<?php
    }
}
