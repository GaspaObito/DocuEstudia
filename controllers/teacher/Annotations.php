<?php
$RootPath = ($_SERVER['DOCUMENT_ROOT'] . "/proyectos/DocuEstudia");
include ("$RootPath/templates/HomeHeader.php");
include ("$RootPath/config/ProtectPages.php");
include ("$RootPath/models/DatabaseConnection.php"); ?>
<main class="ContainerGeneral">
  <div class="ContainerUser">
    <?php include ("$RootPath/controllers/teacher/StudentInfo.php"); ?>
    <div class="anotaciones">
      <div class="nav__miniventana">
        <a></a>
        <h1 id="TitleStart">ANOTACIONES</h1>
        <div>
          <a href="AnnotationsSearch.php">
            <div class="botonAtras">
              <div class="margen__boton">
                <svg class="navbar-icon" style="margin:0;">
                  <use xlink:href="<?php echo BASE_URL; ?>/assets/images/svg/Arrow_Back.svg#Arrow_Back-icon">
                </svg>
              </div>
            </div>
          </a>
        </div>
      </div>
      <div class="Container1">
        <form action="<?php echo BASE_URL; ?>/models/AnnotationsModel.php" method="post" class="formulario">
          <fieldset>
            <?php
            echo ' <input type="hidden" name="Id_Est" value="' . $_SESSION['Id_Session'] . '">';
            echo ' <input type="hidden" name="Nom_Prof" value="' . $_SESSION['NombreProfe'] . '">'; ?>
            <div>
              <div class="Add_Anotacion">
                <label>TIPO DE FALTA</label>
                <select name="tipoFalta" class="Input_Text">
                  <option disabled selected>...</option>
                  <option>Leve</option>
                  <option>Grave</option>
                  <option>Muy grave</option>
                </select>
              </div>
              <div class="Add_Anotacion">
                <label>DESCRIPCION DE LA ANOTACIÓN</label>
                <textarea maxlength="255" name="descripcion" class="Input_Text"></textarea>
              </div>
            </div>
          </fieldset>
          <div class="alinear-boton">
          <input type="hidden" name="action" value="create">
            <button class="boton" type="submit" name="SendAnnotation">ENVIAR ANOTACION</button>
          </div>
        </form>
      </div>
      <div class="alinear-boton">
        <form action="AnnotationsHistory.php" method="post">
          <?php echo '<input type="hidden" name="Id_Est" value="' . $IdGeneral . '">'; ?>
          <button name="VerHistorial" type="submit" class="boton">VER HISTORIAL</button>
        </form>
      </div>
    </div>
  </div>
  </div>
</main>
<?php include ("$RootPath/templates/HomeFooter.php"); ?>