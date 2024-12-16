-- Crear la base de datos (si no existe)
CREATE DATABASE IF NOT EXISTS pruebas;
USE pruebas;
-- Crear la tabla usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombreusuario VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(50) NOT NULL,
    tipo ENUM('admin', 'usuario') NOT NULL
);
-- Insertar usuarios de ejemplo
INSERT INTO usuarios (nombreusuario, password, tipo)
VALUES ('admin1', 'adminpass1', 'admin'),
    -- Admin usuario 1
    ('admin2', 'adminpass2', 'admin'),
    -- Admin usuario 2
    ('usuario1', 'userpass1', 'usuario'),
    -- Usuario regular 1
    ('usuario2', 'userpass2', 'usuario');
-- Usuario regular 2