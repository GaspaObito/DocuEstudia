<!DOCTYPE html>
<html lang="en">
<head>
  <?php require_once(__DIR__ . "/../config/config.php"); ?>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DocuEstudia</title>
  <!-- Favicon -->
  <link rel="icon" href="<?php echo BASE_URL; ?>/assets/logo/favicon.ico" type="image/x-icon">
  <!-- CSS Base (Normalize → Globals → Layout) -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/base/Normalize.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/base/Globals.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/base/Layout.css">
  <!-- Iconos (Font Awesome) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <!-- JS globales (Navbar, Sidebar) -->
  <script src="<?php echo BASE_URL; ?>/assets/js/Navbar_Toggler.js" defer></script>
  <script src="<?php echo BASE_URL; ?>/assets/js/Sliderbar.js" defer></script>
  <!-- Librerías externas (XLSX, gráficos, etc.) -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js" defer></script>
  <script src="<?php echo BASE_URL; ?>/assets/js/Export_Xlsx.js" defer></script>
  <!-- CSS de cada Página (se carga dinámicamente en cada vista) -->
  <?php if (defined("PAGE_CSS")): ?>
      <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/pages/<?php echo PAGE_CSS; ?>.css">
  <?php endif; ?>
</head>
<body>
  <header>
    <nav class="navbar">
      <div class="LogoHeader">
        <a href="<?php echo BASE_URL; ?>/index.php">
          <img src="<?php echo BASE_URL; ?>/assets/logo/favicon.ico">
        </a>
        <h2> DocuEstudia</h2>
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
        if (isset($_SESSION['Id_Estu']) || isset($_SESSION['Id_Profe'])) { ?>
          <a href="<?php echo BASE_URL; ?>/index.php">Inicio</a>
          <a href="#">Acerca de</a>
          <?php if (isset($_SESSION['Id_Profe'])) { ?>
            <a href="<?php echo BASE_URL; ?>/views/teacher/AnnotationsSearch.php">Observadores</a>
          <?php } ?>
          <?php if (isset($_SESSION['IdRol']) && ($_SESSION['IdRol'] == 3)) { ?>
            <a href="<?php echo BASE_URL; ?>/views/admin/ManageUsers.php?action=listar">Maestros</a>
          <?php } ?>
           <!-- <?php if (isset($_SESSION['Id_Estu'])) { ?>
            <a href="<?php echo BASE_URL; ?>/controllers/teacher/AnnotationsHistory.php">Anotaciones</a>
          <?php } ?> -->
          <form action="<?php echo BASE_URL; ?>/models/auth/UserAuth.php" method="POST">
            <button class="botonAtras" type="submit" name="Cerrar_Login">
              <div class="margen__boton">
                <svg class="navbar-icon" style="margin:0">
                  <use href="<?php echo BASE_URL; ?>/assets/images/svg/Sprite.svg#icon-Logout"></use>
                </svg>
              </div>
              </div>
            </button>
          </form>
        <?php } else { ?>
          <a href="<?php echo BASE_URL; ?>/index.php">Inicio</a>
          <a href="<?php echo BASE_URL; ?>/views/login/GuardianLogin.php">Estudiante</a>
          <a href="<?php echo BASE_URL; ?>/views/login/TeacherAdminLogin.php">Profesor</a>
        <?php } ?>
      </ul>
    </nav>
  </header>
<?php require_once(__DIR__."/SliderBar.php");?>