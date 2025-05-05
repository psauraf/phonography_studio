<?php
session_start();

// Solo acceder si el usuario está logueado
if (!isset($_SESSION['id_usuario'])) {
header("Location: ../frontend/login.html");
exit();
}

// Conexión a base de datos
$conexion = new mysqli("localhost", "root", "", "phonographystudio");

if ($conexion->connect_error) {
die("Error de conexión: " . $conexion->connect_error);
}

// Obtener reservas del usuario
$id_usuario = $_SESSION['id_usuario'];

$sql = "SELECT r.id, s.nombre AS servicio, r.fecha
FROM reservas r
INNER JOIN servicios s ON r.id_servicio = s.id
WHERE r.id_usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$resultado = $stmt->get_result();

$reservas = [];

while ($fila = $resultado->fetch_assoc()) {
$reservas[] = $fila;
}

echo json_encode($reservas);

$stmt->close();
$conexion->close();
?>