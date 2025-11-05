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

CREATE TABLE producto (
    id INT(7) NOT NULL AUTO_INCREMENT,
    sku VARCHAR(30),
    nombre VARCHAR(60) NOT NULL,
    descripcion VARCHAR(250),
    cantidad INT(7) UNSIGNED NOT NULL DEFAULT 0, -- No puede ser menor a cero,
    stock_minimo INT(7) UNSIGNED NOT NULL DEFAULT 0,-- NO puede ser menor a cero,
    precio DECIMAL(8,2) UNSIGNED DEFAULT 0.0,
    PRIMARY KEY(id)
);
