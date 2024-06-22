<?php
// Verificar si el usuario está logueado
if (empty($_SESSION['Id_Admin']) || empty($_SESSION['Id_Profe'])){
  // Si no está logueado, redirigir a la página de login
  echo "<script>alert('Debes iniciar sesión para acceder a esta página.')</script>";
  echo "<script>location.href='/proyectos/DocuEstudia/index.php'</script>";
  exit();
  }
