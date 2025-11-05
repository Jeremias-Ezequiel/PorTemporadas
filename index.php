<?php
require_once __DIR__ . "/controllers/ProductoController.php";
require_once __DIR__ . "/views/ProductoViews.php";

$productoController = new ProductoController();
$productoVistas = new ProductoViews();

$seccion = $_GET['seccion'] ?? 'inicio';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DeTemporada</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body class="container-gral">
    <header class="main-header">
        <img src="assets/LogoLetras.png" height="100px" alt="">
    </header>
    <nav class="main-nav">
        <a id="cerrar-sesion" href="index.html">Cerrar Sesión</a>
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
                    echo $productoVistas->mostrarProductos();
                    break;
                case 'cargarProd':
                    require_once './components/cargarProd.html';
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