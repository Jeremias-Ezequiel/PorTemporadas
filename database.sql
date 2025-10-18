CREATE DATABASE IF NOT EXISTS temporadas;

USE temporadas;

CREATE TABLE usuario (
    id INT(7) NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(70) NOT NULL,
    apellido VARCHAR(70) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(70) NOT NULL,
    PRIMARY KEY(id)
); 