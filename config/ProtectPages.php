<?php
require_once(__DIR__ . "/../config/config.php");
// Verificar si el usuario está logueado
if (empty($_SESSION['Id_Profe']) && empty($_SESSION['Id_Estu'])){
  // Si no está logueado, redirigir a la página de login
  echo "<script>alert('Debes iniciar sesión para acceder a esta página.')</script>";
  echo "<script>location.href='".BASE_URL."/index.php'</script>";
  exit();
  }
