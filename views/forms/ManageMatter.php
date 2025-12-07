<?php
require_once(__DIR__ . "/../../config/config.php");
require_once(ROOT_PATH . "/templates/HomeHeader.php");
require_once(ROOT_PATH . "/config/ProtectPages.php");
require_once(ROOT_PATH . "/models/MatterModel.php");
?>
<main class="ContainerGeneral">
  <h1 id="TitleStart"><?php echo $isUpdate ? 'ACTUALIZAR ' : 'REGISTRAR '; ?>MATERIA <?php echo $IdMateria ?> <i
      class="fa-solid fa-pen"></i></h1>
  <form method="post" class="formulario" enctype="multipart/form-data">
    <fieldset>
      <div class="formulario__campos1">
        <input type="hidden" name="IdMateria_Actual" value="<?php echo htmlspecialchars($IdMateria) ?>">
          <div>
            <label for="grupo">Nombre Materia</label>
            <div class="setting">
              <!-- Nuevo registro -->
              <input type="text" name="NomMateria" class="Input_Text" placeholder="Ingrese Materia" maxlength="50"  value="<?php echo htmlspecialchars($NomMateria) ?>">
            </div>
          </div>
          <div>
            <label for="grupo">Descripcion</label>
            <div class="setting">
              <!-- Nuevo registro -->
              <input type="text" name="Descripcion" class="Input_Text" placeholder="Ingrese Descripcion" maxlength="50" value="<?php echo htmlspecialchars($Descripcion) ?>">
            </div>
          </div>
      </div>
      <div class="alinear-boton">
        <input type="hidden" name="action" value="<?php echo $isUpdate ? 'updateMatter' : 'createMatter'; ?>">
        <input type="submit" name="EnviarGrade" class="boton" value="Enviar">
      </div>
    </fieldset>
  </form>
</main>
<?php include(ROOT_PATH . "/templates/HomeFooter.php"); ?>