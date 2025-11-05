<?php

require_once __DIR__ . "/../config/Database.php";
require_once __DIR__ . "/../models/Usuario.php";

class UsuarioController
{
    private $con;

    public function __construct()
    {
        $this->con = new Database()->getCon();
    }

    public function registrar(Usuario $user)
    {

        $userExist = $this->obtenerUsuario($user->getEmail());

        if ($userExist) {
            return ["status" => "error", "message" => "El correo ya ha sido registrado anteriormente"];
        }

        $query = "INSERT INTO usuario (nombre, apellido, email, password) VALUES (:nombre, :apellido, :email, :password);";

        $data = [
            ":nombre" => $user->getNombre(),
            ":apellido" => $user->getApellido(),
            ":email" => $user->getEmail(),
            ":password" => $user->getPassword(),
        ];

        $stmt = $this->con->prepare($query);

        if ($stmt->execute($data)) {
            return ["status" => "success", "message" => "Usuario creado correctamente!"];
        } else {
            return ["status" => "error", "message" => "El usuario no se ha podido registrar"];
        }
    }

    public function obtenerUsuario($email)
    {
        $query = "SELECT password FROM usuario WHERE email = :email;";

        $stmt = $this->con->prepare($query);
        $data = [
            ":email" => $email,
        ];

        if ($stmt->execute($data)) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }
}
