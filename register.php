<?php

if (isset($_POST['email'])) {
    $pass = $_POST['pass'];
    $rep_pass = $_POST['rep_pass'];

    if ($pass != $rep_pass) {
        header("Location: register.html?error=nomatch&$pass&$rep_pass");
        die();
    }

    $name = $_POST['name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];

    require_once 'Database.php';

    $query = "INSERT INTO usuario VALUES (default,'$name','$last_name','$email','$pass');";

    require_once 'Database.php';

    $con = new Database("temporadas");

    $result = $con->query($query);

    if ($result === true) {
        header("Location: index.html?success");
        die();
    }
}
