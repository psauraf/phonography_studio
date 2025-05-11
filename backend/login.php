<?php
session_start();

// Conexión básica a la base de datos
$conexion = new mysqli("localhost", "root", "", "phonographystudio");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Recibir datos del formulario
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    die("Faltan datos de acceso.");
}

// Consultar usuario
$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();

    // Debug opcional para verificación
    // echo "Hash en BD: " . $usuario['password'] . "<br>";
    // echo "Contraseña introducida: " . $password . "<br>";

    if (password_verify($password, $usuario['password'])) {
        $_SESSION['usuario'] = $usuario['nombre'];
        $_SESSION['id_usuario'] = $usuario['id'];
        header("Location: ../frontend/perfil.php");
        exit();
    } else {
        echo "⚠️ Contraseña incorrecta.";
    }
} else {
    echo "⚠️ Usuario no encontrado.";
}

$stmt->close();
$conexion->close();
?>
