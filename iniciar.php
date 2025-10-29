<?php
require_once 'Database.php';

if (isset($_POST['pass']) && isset($_POST['email'])) {
    $query = "SELECT id FROM usuario WHERE email = :email";

    $db = new Database("temporadas");
    $con = $db->getCon();

    $stmt = $con->prepare($query);
    $data = [
        ":email" => $_POST['email'],
    ];

    if ($stmt->execute($data)) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            header("Location: inicio.php");
            die();
        } else {
            header("Location: index.html?error=noUser");
        }
    }
}
