-- Crear base de datos
CREATE DATABASE IF NOT EXISTS phonographystudio;
USE phonographystudio;

-- Tabla de usuarios
CREATE TABLE usuarios (
id INT AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(100) NOT NULL,
email VARCHAR(100) UNIQUE NOT NULL,
password VARCHAR(255) NOT NULL,
rol ENUM('cliente', 'admin') DEFAULT 'cliente'
);

-- Tabla de servicios
CREATE TABLE servicios (
id INT AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(100) NOT NULL,
descripcion TEXT,
precio DECIMAL(10,2) NOT NULL
);

-- Tabla de reservas
CREATE TABLE reservas (
id INT AUTO_INCREMENT PRIMARY KEY,
id_usuario INT NOT NULL,
id_servicio INT NOT NULL,
fecha DATE NOT NULL,
estado ENUM('pendiente', 'confirmada', 'cancelada') DEFAULT 'pendiente',
FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE,
FOREIGN KEY (id_servicio) REFERENCES servicios(id) ON DELETE CASCADE
);

-- Tabla de publicaciones (opcional)
CREATE TABLE publicaciones (
id INT AUTO_INCREMENT PRIMARY KEY,
titulo VARCHAR(150) NOT NULL,
contenido TEXT,
fecha_publicacion DATE
);

-- Insertar usuario demo
INSERT INTO usuarios (nombre, email, password, rol) VALUES
('Usuario Demo', 'demo@phonographystudio.com', '$2y$10$qzY5r17KgE3oRMcZ9p4vWOT5LrDKWfxU9w6NeP2fAbz0zRCkruVm2', 'cliente');
-- (contraseña: demo1234)

-- Insertar servicios de ejemplo
INSERT INTO servicios (nombre, descripcion, precio) VALUES
('Grabación Completa', 'Grabación de pistas completas en el estudio.', 200.00),
('Mezcla de Pistas', 'Mezcla profesional de grabaciones existentes.', 100.00),
('Mastering', 'Masterización final para distribución.', 50.00),
('Grabación Podcast', 'Grabación profesional de podcast en estudio.', 120.00);