<?php
require_once(__DIR__ . "/../../config/config.php");
require_once(ROOT_PATH . "/templates/HomeHeader.php");
require_once(ROOT_PATH . "/config/ProtectPages.php");
require_once(ROOT_PATH . "/models/TeacherGroup_Grade.php");
?>
<main class="ContainerGeneral">
  <h1 id="TitleStart"><?php echo $isUpdate ? 'ACTUALIZAR ' : 'REGISTRAR '; ?>GRADO <?php echo $IdGrado ?> <i
      class="fa-solid fa-pen"></i></h1>
  <form method="post" class="formulario" enctype="multipart/form-data">
    <fieldset>
      <div class="formulario__campos1">
        <input type="hidden" name="IdGrupo_Actual" value="<?php echo htmlspecialchars($IdGrupo) ?>">
        <?php if (empty($isUpdate)) { ?>
          <div>
            <label for="grupo">IdGrado</label>
            <div class="setting">
              <!-- Nuevo registro -->
              <input type="text" name="IdGrupo" id="grupo" class="Input_Text" placeholder="Id Grupo" maxlength="50">
            </div>
          </div>
        <?php } ?>
        <?php if (empty($isUpdate)) { ?>
          <div>
            <label for="grupo">Grado</label>
            <div class="setting">
              <!-- Nuevo registro -->
              <input type="text" name="IdGrupo" class="Input_Text" placeholder="Id Grupo" maxlength="50" value="<?php echo htmlspecialchars($NomGrado) ?>">
            </div>
          </div>
        <?php } ?>
      </div>
      <div class="alinear-boton">
        <input type="hidden" name="action" value="<?php echo $isUpdate ? 'update' : 'create'; ?>">
        <input type="submit" name="Enviar2" class="boton" value="Enviar">
      </div>
    </fieldset>
  </form>
</main>
<?php include(ROOT_PATH . "/templates/HomeFooter.php"); ?>