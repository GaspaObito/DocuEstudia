<footer class="navbar-footer">
  <nav class="navegacion-principal">
    <div class="LogoHeader">
      <a href="index.php">
        <img src="<?php echo BASE_URL; ?>/assets/logo/favicon.ico" alt="" width="60px" height="60px">
      </a>
      <h2>Academic management</h2>
    </div>
    <div class="footer-menu">
      <?php
      if (isset($_SESSION['Id_Estudiante']) || isset($_SESSION['Id_Profe'])) { ?>
        <a href="index.php">Inicio</a>
        <a href="EscanearCodigos.php">Acerca de</a>
        <?php if (isset($_SESSION['Id_Profe'])) { ?>
          <a href="Profesor/anotaciones_busc.php">Observadores</a>
        <?php } ?>
        <?php if (isset($_SESSION['Id_Admin'])) { ?>
          <a href="Admin/Profesor_busc_Admin.php">Maestros</a>
        <?php } ?>
        <form action="../Config/auth/conectar_RegistroUsuario.php" method="POST">
          <button class="botonAtras" type="submit" name="Cerrar_Login">
            <div class="margen__boton">
              <svg class="navbar-icon" style="margin:0">
                <use xlink:href="<?php echo BASE_URL; ?>/assets/images/svg/Logout.svg#Logout-icon">
              </svg>
            </div>
      </div>
      </button>
      </form>
    <?php } else { ?>
      <a href="index.php">Inicio</a>
      <a href="EscanearCodigos.php">Acerca de</a>
      <a href="Login_Users/acudiente.php">Estudiante</a>
      <a href="Login_Users/profesor_y_admin.php">Profesor</a>
    <?php } ?>
    </div>
  </nav>
  <p>© 2023 PROYECTO. Todos los derechos reservados | Desarrollado por
    <a href="https://github.com/GaspaObito">JoseMiguel JuanFelipe JuanPablo</a>
  </p>
  <p>© GitHub
    <a href="https://github.com/GaspaObito/ProyectoQuintoSemestre"> Observador</a>
  </p>
</footer>
</body>

</html>