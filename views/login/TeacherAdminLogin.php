<?php 
$RootPath = ($_SERVER['DOCUMENT_ROOT'] . "/proyectos/DocuEstudia");
include ("$RootPath/templates/HomeHeader.php");?>
<div class="bienvenido">
  <div class="bienvenido__login">
    <h1 id="TitleStart">BIENVENIDO</h1>
    <p>Por favor ingrese los siguientes datos para iniciar sesión como profesor</p>
    <form class="Form_Acudiente" action="<?php echo BASE_URL; ?>/models/auth/UserAuth.php" method="post">
      <div>
        <label>Ingresar E-mail</label>
        <div class="contacto">
          <svg class="img" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
            id="Capa_1" x="0px" y="0px" width="40" height="40" viewBox="0 0 510 510"
            style="enable-background:new 0 0 510 510;" xml:space="preserve">
            <g id="account-circle">
              <path
                d="M255,0C114.75,0,0,114.75,0,255s114.75,255,255,255s255-114.75,255-255S395.25,0,255,0z M255,76.5    c43.35,0,76.5,33.15,76.5,76.5s-33.15,76.5-76.5,76.5c-43.35,0-76.5-33.15-76.5-76.5S211.65,76.5,255,76.5z M255,438.6    c-63.75,0-119.85-33.149-153-81.6c0-51,102-79.05,153-79.05S408,306,408,357C374.85,405.45,318.75,438.6,255,438.6z" />
            </g>
          </svg>
          <input class="Input_Text" type="text" name="Correo" placeholder="E-mail">
        </div>
      </div>
      <div>
        <label>Ingresar Constraseña</label>
        <div class="contacto">
          <svg class="img" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
            id="Capa_1" width="40" height="40" viewBox="0 0 516.375 516.375"
            style="enable-background:new 0 0 516.375 516.375;" xml:space="preserve">
            <g>
              <path
                d="M353.812,0C263.925,0,191.25,72.675,191.25,162.562c0,19.125,3.825,38.25,9.562,57.375L0,420.75v95.625h95.625V459H153   v-57.375h57.375l86.062-86.062c17.213,5.737,36.338,9.562,57.375,9.562c89.888,0,162.562-72.675,162.562-162.562S443.7,0,353.812,0   z M401.625,172.125c-32.513,0-57.375-24.862-57.375-57.375s24.862-57.375,57.375-57.375S459,82.237,459,114.75   S434.138,172.125,401.625,172.125z" />
            </g>
          </svg>
          <input class="Input_Text" type="password" name="Contrasena" placeholder="Constraseña" id="ShowPassW">
          <i><input class="ShowPass" type="checkbox" onclick="ShowPassword()"></i>
        </div>
      </div>
      <div class="alinear-boton">
        <button class="boton" type="submit" name='button_Auth'>INICIAR SESION</button>
      </div>
    </form>
  </div>
  <div class="bonito">
    <h1 id="TitleStart" style="text-align: unset;">Contactenos</h1>
    <p>Para mas información contactarse a nuestros equipos de trabajo</p>
    <div>
      <div class="contacto">
        <svg class="img" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone-call" width="40"
          height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round"
          stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <path
            d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
          <path d="M15 7a2 2 0 0 1 2 2" />
          <path d="M15 3a6 6 0 0 1 6 6" />
        </svg>
        <label>(+57) 359 876 6548</label>
      </div>
      <div class="contacto">
        <svg class="img" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail" width="40"
          height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round"
          stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
          <path d="M3 7l9 6l9 -6" />
        </svg>
        <label>aveces.igual@gmail.com</label>
      </div>
    </div>
  </div>
</div>
<?php include ("$RootPath/templates/HomeFooter.php"); ?>