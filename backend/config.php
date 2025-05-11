<?php
$host = 'localhost'; // Servidor de base de datos
$db = 'phonographystudio'; // Nombre de la base de datos
$user = 'root'; // Usuario de MySQL (por defecto en XAMPP)
$pass = ''; // Contraseña de MySQL (vacía por defecto en XAMPP)

try {
$conexion = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
die("Error de conexión: " . $e->getMessage());
}
?>