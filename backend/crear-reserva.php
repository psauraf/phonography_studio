<?php
session_start();

if (!isset($_SESSION['id_usuario'])) {
  header("Location: login.html");
  exit();
}

$conexion = new mysqli("localhost", "root", "", "phonographystudio");
if ($conexion->connect_error) {
  die("Error de conexión: " . $conexion->connect_error);
}

$fecha = $_POST['fecha'];
$id_servicio = $_POST['id_servicio']; // normalmente 1 para "reserva estudio"
$id_usuario = $_SESSION['id_usuario'];

$sql = "INSERT INTO reservas (id_usuario, id_servicio, fecha, estado) VALUES (?, ?, ?, 'pendiente')";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("iis", $id_usuario, $id_servicio, $fecha);
$stmt->execute();

$stmt->close();
$conexion->close();

header("Location: ../perfil.php");
exit();
?>
