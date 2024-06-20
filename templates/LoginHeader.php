<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DocuEstudia</title>
  <?php define('BASE_URL', '/proyectos/DocuEstudia'); ?>
  <link rel="icon" href="<?php echo BASE_URL; ?>/assets/logo/favicon.ico" type="icon" />
  <link rel="preload" href="<?php echo BASE_URL; ?>/assets/css/normalize.css" as="style">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/Login.css">
  <script src="<?php echo BASE_URL; ?>/assets/js/Navbar_Toggler.js"></script>
</head>

<body>
  <header>
    <nav class="navbar">
      <div class="LogoHeader">
        <a href="../index.php">
          <img src="<?php echo BASE_URL; ?>/assets/logo/favicon.ico" alt="" width="60px" height="60px">
        </a>
        <h2>DocuEstudia</h2>
      </div>
      <div class="navbar-align">
        <button class="navbar-toggler" onclick="toggleMenu()">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30">
            <path stroke="#000000" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"
              d="M4 7h22M4 15h22M4 23h22" />
          </svg>
        </button>
      </div>
      <ul class="navbar-menu" id="navbarMenu">
        <?php
        session_start();
        if (isset($_SESSION['Id_Estudiante']) || isset($_SESSION['Id_Profe'])) { ?>
          <a href="<?php echo BASE_URL; ?>/index.php">Inicio</a>
          <a href="../EscanearCodigos.php">Acerca de</a>
          <?php if (isset($_SESSION['Id_Profe'])) { ?>
            <a href="<?php echo BASE_URL; ?>/controllers/teacher/AnnotationsSearch.php">Observadores</a>
          <?php } ?>
          <?php if (isset($_SESSION['Id_Admin'])) { ?>
            <a href="<?php echo BASE_URL; ?>/controllers/admin/TeacherSearchAdmin.php">Maestros</a>
          <?php } ?>
          <form action="<?php echo BASE_URL; ?>/models/auth/UserAuth.php" method="POST">
            <button class="botonAtras" type="submit" name="Cerrar_Login">
              <div class="margen__boton">
                <svg class="navbar-icon" style="margin:0">
                  <use xlink:href="../Assets/Svg/Logout.svg#Logout-icon">
                </svg>
              </div>
              </div>
            </button>
          </form>
        <?php } else { ?>
          <a href="<?php echo BASE_URL; ?>/index.php">Inicio</a>
          <a href="EscanearCodigos.php">Acerca de</a>
          <a href="<?php echo BASE_URL; ?>/views/login/GuardianLogin.php">Estudiante</a>
          <a href="<?php echo BASE_URL; ?>/views/login/TeacherAdminLogin.php">Profesor</a>
        <?php } ?>
      </ul>
    </nav>
  </header>