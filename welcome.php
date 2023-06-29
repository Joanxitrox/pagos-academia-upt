<!DOCTYPE html>
<html>

<?php
// Inicio de sesión
session_start();

// Configurar tiempo de expiración de la cookie de sesión (en segundos)
$inactivity_timeout = 1800; // 30 minutos de inactividad

// Obtener el tiempo actual
$current_time = time();

// Verificar si existe una sesión activa y si ha pasado el tiempo de inactividad
if (isset($_SESSION['last_activity']) && ($current_time - $_SESSION['last_activity'] > $inactivity_timeout)) {
    // Cerrar sesión y destruir los datos de la sesión
    session_unset();
    session_destroy();

    // Redirigir al usuario a la página de inicio de sesión u otra página de tu elección
    header('Location: login.php');
    exit(); // Detener la ejecución del script después de redirigir al usuario
}

// Actualizar el tiempo de actividad
$_SESSION['last_activity'] = $current_time;
?>

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <link rel="icon" type="image/x-icon" href="photo_2023-04-05_12-28-13.jpg">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <?php
  if (!isset($_SESSION['login_id']))
    header('location:login.php');
  include('./header.php');

  ?>
  <style>
    body {
      background-color: #f8f9fa;
    }

    .container {
      margin-top: 100px;
      text-align: center;
    }

    h1 {
      color: #007bff;
      font-size: 36px;
      font-weight: bold;
    }

    h5 {
      color: #333;
      font-size: 24px;
    }

    p {
      color: #555;
      font-size: 18px;
    }

    .btn {
      margin-top: 20px;
      padding: 12px 24px;
      font-size: 20px;
      border-radius: 30px;
      background-color: #007bff;
      color: #fff;
      transition: background-color 0.3s ease;
    }

    .btn:hover {
      background-color: #0056b3;
    }
  </style>
</head>

<body>
  <?php include 'topbar.php' ?>
  <?php include 'navbar.php' ?>
  <div class="container">
    <h1>Bienvenido(a)</h1>
    <h5>Diseñado y Desarrolado por:</h5>
    <p>Kariannys Quijada<br>Joan Hernandez</p>
    <a href="index.php?page=payments" class="btn btn-primary">Iniciar</a>
  </div>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>