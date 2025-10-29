<?php

if (isset($_POST['agregar'])) {
    require_once './Database.php';
    $pdo = new Database('temporadas');
    $con = $pdo->getCon();
    $cantidad = $_POST['cantidad'];
    $id = $_POST['id'];

    $query = "UPDATE producto SET cantidad_total = cantidad_total + $cantidad WHERE id = $id";
    $stmt = $con->prepare($query);
    $stmt->execute();
}

if (isset($_POST['quitar'])) {
    require_once './Database.php';
    $pdo = new Database('temporadas');
    $con = $pdo->getCon();
    $cantidad = $_POST['cantidad'];
    $id = $_POST['id'];

    echo $_POST['cant_actual'];
    echo $cantidad;

    if ($cantidad > $_POST['cant_actual']) {
        header("Location: ?error=noCant");
    }

    $query = "UPDATE producto SET cantidad_total = cantidad_total - $cantidad WHERE id = $id";
    $stmt = $con->prepare($query);
    $stmt->execute();
}
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
            <li><a href="?seccion=verStock">Ver Stock</a></li>
            <!--<li><a href="?seccion=cargarProd">Cargar Producto</a></li>-->
        </ul>
    </nav>
    <main class="main">
        <?php
        if (isset($_GET['seccion'])) {
            switch ($_GET['seccion']) {
                case 'verStock':
                    require_once './components/stock.php';
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