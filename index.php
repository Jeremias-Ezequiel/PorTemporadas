<?php

session_start();

if (!isset($_SESSION['apellido'])) {
    header('Location: inicioSesion.php');
}

require_once __DIR__ . "/controllers/ProductoController.php";

$productoController = new ProductoController();

if (isset($_POST['crear'])) {
    $mensaje = $productoController->alta($_POST['nombre'], $_POST['precio'], $_POST['cantidad']);
}

$seccion = $_GET['seccion'] ?? 'inicio';
$tipo = $_GET['tipo'] ?? '';


if ($tipo == "agregar") {
    $mensaje = $productoController->agregar($_GET['id'], $_GET['cantidad']);
}

if ($tipo == "quitar") {
    $mensaje = $productoController->quitar($_GET['id'], $_GET['cantidad']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PorTemporada</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body class="container-gral">
    <header class="main-header">
        <img src="assets/LogoLetras.png" height="100px" alt="">
    </header>
    <nav class="main-nav">
        <a id="bienvenida" href="?">Bienvenido <?= $_SESSION['apellido'] ?></a>
        <a id="cerrar-sesion" href="inicioSesion.php">Cerrar Sesión</a>
        <ul class="sec-nav">
            <li><a href="?">Ver Stock</a></li>
            <li><a href="?seccion=cargarProd">Cargar Producto</a></li>
        </ul>
    </nav>
    <main class="main">
        <?php
        if (isset($seccion)) {
            switch ($seccion) {
                case 'inicio':
                    if (isset($_GET['busqueda'])) {
                        $productos = $productoController->searchByName($_GET['buscar']);
                    } else {
                        $productos = $productoController->obtenerProductos();
                    }
        ?>
                    <div class="busqueda">
                        <form action="" method="get" autocomplete="off">
                            <label for="buscar">Buscar por nombre: </label>
                            <input type="text" required id="buscar" name="buscar">
                            <button type="submit" name="busqueda">Buscar</button>
                        </form>
                        <a href="?">Ver todo</a>
                    </div>

                    <?php

                    if (isset($productos) && isset($productos['status'])) {
                        echo "<div class='msg-error'> $productos[message] </div>";
                    } else {

                    ?>
                        <div class="tabla-productos">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Opcion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <form action="?" method="get">
                                        <?php
                                        foreach ($productos as $key => $producto) {
                                        ?>
                                            <tr>
                                                <td><?= $producto['id'] ?></td>
                                                <td><?= $producto['nombre'] ?></td>
                                                <td>
                                                    $<?= $producto['precio'] ?>
                                                </td>
                                                <td><?= $producto['cantidad'] ?></td>
                                                <td><input type="radio" name="producto" value="<?= $producto['id'] ?>" required></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                        <tr>
                                            <td colspan="5" style="text-align: center;">
                                                <button name="seccion" value="quitar" type="submit">Quitar</button>
                                                <button name="seccion" value="agregar" type="submit">Agregar</button>
                                            </td>
                                        </tr>
                                    </form>
                                </tbody>
                            </table>
                        </div>
                    <?php

                        if (isset($mensaje)) {
                            if ($mensaje['status'] === 'error') {
                                echo "<div class='msg-error'> {$mensaje['message']} </div>";
                            } else if ($mensaje['status'] === 'succes') {
                                echo "<div class='msg-exito'> {$mensaje['message']} </div>";
                            }
                        }
                    }
                    break;
                case 'quitar':
                    // Obtener Producto
                    $producto = $productoController->obtenerProducto($_GET['producto']);
                    ?>
                    <div class="actualizar">
                        <form action="" autocomplete="off">
                            <input type="hidden" name="id" value="<?= $producto['id'] ?>">
                            <h4>Producto: <?= $producto['nombre'] ?></h4>
                            <h5>Cantidad: <?= $producto['cantidad'] ?></h5>
                            <input type="number" min="0" required name="cantidad">
                            <button type="submit" name="tipo" value="quitar">Agregar</button>
                        </form>
                    </div>
                <?php
                    break;
                case 'agregar':
                    // Obtener Producto
                    $producto = $productoController->obtenerProducto($_GET['producto']);
                ?>
                    <div class="actualizar">
                        <form action="" autocomplete="off">
                            <input type="hidden" name="id" value="<?= $producto['id'] ?>">
                            <h4>Producto: <?= $producto['nombre'] ?></h4>
                            <h5>Cantidad: <?= $producto['cantidad'] ?></h5>
                            <input type="number" step="0.01" min="0" max="100" required name="cantidad">
                            <button type="submit" name="tipo" value="agregar">Agregar</button>
                        </form>
                    </div>
                <?php
                    break;
                case 'cargarProd':
                ?>
                    <form action="?" method="post" class="form-cargarProducto" autocomplete="off">
                        <div>
                            <label for="nombre">Nombre: </label>
                            <input type="text" min="0" required name="nombre" id="nombre">
                        </div>
                        <div>
                            <label for="precio">Precio: </label>
                            <input type="number" min="0" required name="precio" id="precio">
                        </div>
                        <div>
                            <label for="cantidad">Cantidad: </label>
                            <input type="number" min="0" max="100" required name="cantidad" id="cantidad">
                        </div>
                        <button type="reset">Cancelar</button>
                        <button type="submit" name="crear">Agregar</button>
                    </form>
        <?php
                    break;
                default:
                    echo "Página no encontrada";
                    break;
            }
        }

        ?>
    </main>
    <footer class="main-footer">

    </footer>
</body>

</html>