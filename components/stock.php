<?php
require_once "Database.php";

// Obtener los datos de la base de datos
$db = new Database("temporadas");
$con = $db->getCon();

$query = "SELECT * FROM producto;";

$stmt = $con->prepare($query);

if ($stmt->execute()) {
    if ($stmt->rowCount()) {
        echo "<section class='listar-productos'>";
        while ($res = $stmt->fetch()) {
?>
            <div class="producto-card">
                <h3><?= $res['nombre'] ?></h3>
                <p>Cantidad: <?= $res['cantidad_total'] ?></p>
                <div>
                    <form action="" method="post">
                        <input type="number" placeholder="Ingrese cantidad a ingresar o eliminar">
                        <button>Agregar</button>
                        <button>Quitar</button>
                    </form>
                </div>
            </div>
<?php
        }
        echo "</section>";
    } else {
        echo "Aún no hay productos agregados";
    }
}
