<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
  header("Location: login.html");
  exit();
}

// Cargar servicios
$conexion = new mysqli("localhost", "root", "", "phonographystudio");
$servicios = [];
if (!$conexion->connect_error) {
  $resultado = $conexion->query("SELECT id, nombre FROM servicios");
  while ($row = $resultado->fetch_assoc()) {
    $servicios[] = $row;
  }
  $conexion->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Mi Perfil - Phonography Studio</title>

  <!-- Bootstrap + fuentes -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@300;500;700&display=swap" rel="stylesheet">

  <style>
    body {
      background-color: #121212;
      color: #f5f5f5;
      font-family: 'Barlow', sans-serif;
      position: relative;
    }

    .container {
      max-width: 800px;
      margin-top: 100px;
    }

    .logo {
      text-align: center;
      margin-bottom: 30px;
    }

    .logo img {
      max-height: 100px;
    }

    .logout {
      position: absolute;
      top: 20px;
      right: 30px;
    }

    .btn-custom {
      background-color: #d4af37;
      color: #121212;
      font-weight: 600;
      border: none;
    }

    .btn-custom:hover {
      background-color: #b8902c;
    }

    .reserva-item {
      background-color: #1e1e1e;
      border-left: 5px solid #d4af37;
      padding: 15px 20px;
      margin-bottom: 10px;
      border-radius: 5px;
      position: relative;
    }

    .reserva-item .eliminar {
      position: absolute;
      top: 10px;
      right: 15px;
      color: #ff6666;
      cursor: pointer;
      font-weight: bold;
    }

    .reserva-scroll {
      max-height: 300px;
      overflow-y: auto;
      margin-top: 20px;
    }

    /* Snackbar */
    #snackbar {
      visibility: hidden;
      min-width: 250px;
      background-color: #333;
      color: #fff;
      text-align: center;
      border-radius: 4px;
      padding: 12px;
      position: fixed;
      bottom: 30px;
      left: 50%;
      transform: translateX(-50%);
      z-index: 9999;
    }

    #snackbar.show {
      visibility: visible;
      animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }

    @keyframes fadein {
      from { bottom: 0; opacity: 0; }
      to   { bottom: 30px; opacity: 1; }
    }

    @keyframes fadeout {
      from { bottom: 30px; opacity: 1; }
      to   { bottom: 0; opacity: 0; }
    }
  </style>
</head>

<body>
  <!-- Cerrar sesión arriba derecha -->
  <div class="logout">
    <a href="../backend/logout.php" class="btn btn-sm btn-custom">Cerrar sesión</a>
  </div>

  <div class="container">
    <!-- Logo -->
    <div class="logo">
      <img src="assets/logo.png" alt="Phonography Studio">
    </div>

    <h2 class="text-center mb-3">Mi Perfil</h2>
    <p class="text-center">Bienvenido, <strong><?= $_SESSION['usuario'] ?></strong></p>

    <!-- Formulario reserva -->
    <div class="mt-4 mb-4">
      <h4 class="text-center mb-3">Reservar el estudio</h4>
      <form id="form-reserva" action="../backend/crear-reserva.php" method="POST" class="d-flex flex-column align-items-center gap-3">
        <input type="date" name="fecha" class="form-control w-50" required>
        <select name="id_servicio" class="form-select w-50" required>
          <option value="">Selecciona un servicio</option>
          <?php foreach ($servicios as $servicio): ?>
            <option value="<?= $servicio['id'] ?>"><?= $servicio['nombre'] ?></option>
          <?php endforeach; ?>
        </select>
        <button type="submit" class="btn btn-custom">Reservar</button>
      </form>
    </div>

    <!-- Contenedor con scroll -->
    <div class="reserva-scroll" id="lista-reservas">
      <p class="text-center text-muted">Cargando reservas...</p>
    </div>
  </div>

  <!-- Snackbar -->
  <div id="snackbar">Reserva realizada</div>

  <script src="js/perfil.js"></script>
</body>
</html>
