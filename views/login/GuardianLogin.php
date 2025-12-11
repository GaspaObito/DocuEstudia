<?php
define("PAGE_CSS", "Login");
require_once(__DIR__ . "/../../config/config.php");
require_once(ROOT_PATH . "/templates/HomeHeader.php");
?>
<main class="ContainerGeneral">
  <div class="bienvenido">
    <div class="bienvenido__login">
      <h1 id="TitleStart"><i class="fa-solid fa-lock"></i> INICIAR SESION</h1>
      <br>
      <form class="Form_Acudiente" action="<?php echo BASE_URL; ?>/models/auth/UserAuth.php" method="post">
        <div>
          <label>Correo Electronico</label>
          <div class="contacto">
            <i class="fa-solid fa-user fa-2x"></i>
            <input class="Input_Text" type="text" name="Correo" placeholder="E-mail">
          </div>
        </div>
        <div>
          <label>Constraseña</label>
          <div class="contacto">
            <i class="fa-solid fa-key fa-2x"></i>
            <input class="Input_Text" type="password" name="Contrasena" placeholder="Constraseña" id="ShowPassW">
            <i><input class="ShowPass" type="checkbox" onclick="ShowPassword()"></i>
          </div>
        </div>
        <?php if (isset($_SESSION['error'])): ?>
          <div class="alert alert-danger"><?= $_SESSION['error']; ?></div>
          <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        <div class="alinear-boton">
          <button class="boton" type="submit" name='button_Auth'>INICIAR SESION</button>
        </div>
      </form>
    </div>
    <div class="bienvenido__login BannerStudent">
      <h1 id="TitleStart" style="margin-bottom: 5rem;">ESTUDIANTE</h1>
      <div style="color:white">
        <h2 id="TitleStart">Contactenos</h2>
        <div class="contacto">
          <i class="fa-solid fa-phone fa-2x"></i>
          <label>(+57) 359 876 6548</label>
        </div>
        <div class="contacto text-white">
          <i class="fa-solid fa-envelope fa-2x"></i>
          <label>soporte_docuestudia@gmail.com</label>
        </div>
      </div>
    </div>
  </div>
</main>

<?php include(ROOT_PATH . "/templates/HomeFooter.php"); ?>