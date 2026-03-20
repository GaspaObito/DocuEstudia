<?php
define("PAGE_CSS", "Login");
require_once(__DIR__ . "/../../config/config.php");
require_once(ROOT_PATH . "/templates/HomeHeader.php");
?>
<main class="ContainerGeneral" style="padding: 0;">
  <div class="bienvenido">
    <div class="bienvenido__login">
      <div style="display: flex; flex-direction: column; align-items: center; margin-bottom: 4rem;">
        <i id="TitleStart" class="fa-solid fa-lock fa-4x"></i>
        <h1></i> INICIAR SESION</h1>
      </div>
      <br>
      <form class="Form_Acudiente" action="<?php echo BASE_URL; ?>/models/auth/UserAuth.php" method="post">
        <div>
          <label>Correo Electronico</label>
          <div class="input-group">
            <input class="Input_Text" type="text" name="Correo" placeholder="Digite Email">
            <i class="fa-solid fa-envelope"></i>
          </div>
        </div>
        <div>
          <label>Contraseña</label>
          <div class="input-group">
            <input class="Input_Text" type="password" name="Contrasena" placeholder="Digite Clave" id="ShowPassW">
            <i class="fa-solid fa-eye toggle-eye" onclick="ShowPassword()"></i>
          </div>
        </div>
        <!-- ALERTAS -->
        <?php include(ROOT_PATH . "/templates/alerts.php"); ?>
        <div class="alinear-boton">
          <button class="boton" type="submit" name='button_Auth'>INICIAR SESION</button>
        </div>
      </form>
    </div>
    <div class="bienvenido__login BannerTeacher" style="color:white;">
      <h1 style="display: flex;margin: 8.5rem 0 18.5rem 0;justify-content: center;">MAESTRO</h1>
      <div>
        <h2>Contactenos</h2>
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