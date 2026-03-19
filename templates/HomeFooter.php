<footer class="navbar-footer">
  <nav class="navegacion-principal">
    <div class="LogoHeader">
      <a href="index.php">
        <img src="<?php echo BASE_URL; ?>/assets/logo/favicon.ico" alt="" width="60px" height="60px">
      </a>
      <h2>DocuEstudia</h2>
    </div>
    <div class="footer-menu">
      <?php
      if (isset( $_SESSION['user_id'])) { ?>
          <a href="<?php echo BASE_URL; ?>/index.php">Inicio</a>
          <a href="#">Acerca de</a>
        <?php if (($_SESSION['rol'] == 2)) { ?>
          <a href="<?php echo BASE_URL; ?>/views/teacher/AnnotationsSearch.php">Observadores</a>
        <?php } ?>
        <?php if ($_SESSION['rol'] == 3) { ?>
          <a href="<?php echo BASE_URL; ?>/controllers/admin/ManageUsers.php?action=listar">Maestros</a>
        <?php } ?>
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
    </div>
  </nav>
  <p>© 2024 PROYECTO. Todos los derechos reservados | Desarrollado por
    <a href="https://github.com/GaspaObito">JoseMiguel-GaspaObito</a>
  </p>
  <p>© GitHub
    <a href="https://github.com/GaspaObito/DocuEstudia"> Observador</a>
  </p>
</footer>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>