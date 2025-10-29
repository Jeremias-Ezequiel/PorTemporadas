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
                    <form action="?seccion=verStock" method="post" class="form-actualizar">
                        <input type="hidden" name="id" value="<?= $res['id'] ?>">
                        <input type="hidden" name="cant_actual" value="<?= $res['cantidad_total']; ?>">
                        <input type="number" name="cantidad" placeholder="Ingrese cantidad a ingresar o eliminar">
                        <button name="agregar">Agregar</button>
                        <button name="quitar">Quitar</button>
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
