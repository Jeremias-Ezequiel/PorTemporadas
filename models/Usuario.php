<?php

class Usuario
{
    private $nombre;
    private $apellido;
    private $email;
    private $password;

    public function __construct($nombre, $apellido, $email, $password)
    {
        $this->setNombre($nombre);
        $this->setApellido($apellido);
        $this->setEmail($email);
        $this->setPassword($password);
    }

    function getNombre()
    {
        return $this->nombre;
    }
    function getApellido()
    {
        return $this->apellido;
    }
    function getEmail()
    {
        return $this->email;
    }

    function getPassword()
    {
        return $this->password;
    }

    function setNombre($nombre)
    {
        $nombre_clean = trim($nombre);

        if (empty($nombre_clean)) {
            throw new InvalidArgumentException("El nombre es obligatorio");
        } elseif (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ' ]+$/", $nombre_clean)) {
            throw new InvalidArgumentException("El nombre solo puede contener letras, espacios y apóstrofes");
        }

        $this->nombre = $nombre_clean;
    }

    function setApellido($apellido)
    {
        $apellido_clean = trim($apellido);

        if (empty($apellido_clean)) {
            throw new InvalidArgumentException("El apellido es obligatorio");
        } elseif (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ' ]+$/", $apellido_clean)) {
            throw new InvalidArgumentException("El apellido solo puede contener letras, espacios y apóstrofes");
        }
        $this->apellido = $apellido_clean;
    }

    function setEmail($email)
    {
        $email_clean = trim($email);


        if (empty($email_clean)) {
            throw new InvalidArgumentException("El email es obligatorio");
        } elseif (!filter_var($email_clean, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("El formato del email no es válido");
        }

        $this->email = $email_clean;
    }

    function setPassword($pass)
    {
        $pass_clean = trim($pass);
        $this->password = $pass_clean;
    }
}
