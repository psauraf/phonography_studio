<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
  http_response_code(403); // Prohibido
  exit();
}

if (!isset($_GET['id'])) {
  http_response_code(400); // Petición incorrecta
  exit();
}

$conexion = new mysqli("localhost", "root", "", "phonographystudio");
if ($conexion->connect_error) {
  http_response_code(500);
  exit();
}

$id_reserva = intval($_GET['id']);
$id_usuario = $_SESSION['id_usuario'];

// Solo puede eliminar sus propias reservas
$sql = "DELETE FROM reservas WHERE id = ? AND id_usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ii", $id_reserva, $id_usuario);
$stmt->execute();

$stmt->close();
$conexion->close();

http_response_code(200);
exit();
?>
