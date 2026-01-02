<?php
require_once(__DIR__ . "/../../config/config.php");
require_once(ROOT_PATH . "/templates/HomeHeader.php");
require_once(ROOT_PATH . "/config/ProtectPages.php");
require_once(ROOT_PATH . "/controllers/Group_GradeController.php");
?>
<main class="ContainerGeneral">
  <h1 id="TitleStart"><?php echo $isUpdate ? 'ACTUALIZAR ' : 'REGISTRAR '; ?>GRADO <?php echo $IdGrado ?> <i
      class="fa-solid fa-pen"></i></h1>
  <form method="post" class="formulario" enctype="multipart/form-data">
    <fieldset>
      <div class="formulario__campos1">
        <input type="hidden" name="IdGrado_Actual" value="<?php echo htmlspecialchars($IdGrado) ?>">
          <div>
            <label for="grupo">IdGrado</label>
            <div class="setting">
              <!-- Nuevo registro -->
              <input type="text" name="IdGrado" class="Input_Text" placeholder="Id Grado" maxlength="50"  <?php echo $isUpdate ? 'disabled' : '' ?> value="<?php echo htmlspecialchars($IdGrado) ?>">
            </div>
          </div>
          <div>
            <label for="grupo">Grado</label>
            <div class="setting">
              <!-- Nuevo registro -->
              <input type="text" name="NomGrado" class="Input_Text" placeholder="Nombre Grado" maxlength="50" value="<?php echo htmlspecialchars($NomGrado) ?>">
            </div>
          </div>
      </div>
      <div class="alinear-boton">
        <input type="hidden" name="action" value="<?php echo $isUpdate ? 'updateGrade' : 'createGrade'; ?>">
        <input type="submit" name="EnviarGrade" class="boton" value="Enviar">
      </div>
    </fieldset>
  </form>
</main>
<?php include(ROOT_PATH . "/templates/HomeFooter.php"); ?>