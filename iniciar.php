<?php
require_once 'Database.php';

if (isset($_POST['pass']) && isset($_POST['email'])) {
    $query = "SELECT email FROM usuario WHERE email = $_POST[email]";

    header("Location: inicio.html");
}
