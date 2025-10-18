<?php



if (isset($_POST['email'])) {
    if ($_POST['pass'] !== $_POST['rep_pass']) {
        header("Location: register.html?error=noMatch");
        die();
    }

    require_once "Database.php";
    $query = "INSERT INTO usuario VALUES (default,:nombre,:apellido,:email,:password);";

    $db = new Database("temporadas");
    $con = $db->getCon();

    $stmt = $con->prepare($query);

    $data = [
        ":nombre" => $_POST['name'],
        ":apellido" => $_POST['last_name'],
        ":email" => $_POST['email'],
        ":password" => $_POST['rep_pass'],
    ];

    try {
        if ($stmt->execute($data)) {
            header("Location: index.html?status=regSuccess");
            die();
        }
    } catch (PDOException $e) {
        header("Location: register.html?error=noReg");
        die();
    }
}
