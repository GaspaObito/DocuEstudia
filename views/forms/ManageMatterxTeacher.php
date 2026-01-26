<?php
require_once(__DIR__ . "/../../config/config.php");
require_once(ROOT_PATH . "/templates/HomeHeader.php");
require_once(ROOT_PATH . "/config/ProtectPages.php");
require_once(ROOT_PATH . "/controllers/Group_GradeController.php");
?>
<main class="ContainerGeneral">
  <h1 id="TitleStart"><?php echo $isUpdate ? 'ACTUALIZAR ' : 'REGISTRAR '; ?>GRUPO <?php echo $IdGrupo ?> <i
      class="fa-solid fa-pen"></i></h1>
  <form method="post" class="formulario" enctype="multipart/form-data">
    <fieldset>
      <div class="formulario__campos1">
        <input type="hidden" name="IdGrupo_Actual" value="<?php echo htmlspecialchars($IdGrupo) ?>">
        <?php if (empty($isUpdate)) { ?>
          <div>
            <label for="grupo">Grupo</label>
            <div class="setting">
              <!-- Nuevo registro -->
              <input type="text" name="IdGrupo" id="grupo" class="Input_Text" placeholder="Id Grupo" maxlength="50">
            </div>
          </div>
        <?php } ?>
        <div>
          <label>Grado</label>
          <div class="setting">
            <input type="hidden" name="IdGrado_Actual" value="<?php echo htmlspecialchars($IdGrado) ?>">
            <select name="FornIdGrado" class="Input_Text">
              <?php if ($isUpdate) { ?>
                <option value="mantener" selected>Asignado: <?php echo htmlspecialchars($NomGrado) ?></option>
                <option value="quitar">Sin Grado</option>
              <?php } else { ?>
                <option disabled selected>...</option>
              <?php } ?>
              <?php
              foreach ($mt_grados as $opciones): ?>
                <option value="<?php echo $opciones['IdGrado'] ?>">
                  <?php echo $opciones['NomGrado'] ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div>
          <label>Profesores</label>
          <div class="setting">
            <input type="hidden" name="IdProf_Actual" value="<?php echo htmlspecialchars($IdProf) ?>">
            <select name="FornIdProf" class="Input_Text">
              <?php if ($isUpdate) { ?>
                <option value="mantener" selected>Asignado:<?php echo htmlspecialchars($NombreCompleto) ?></option>
                <option value="quitar">Sin Profesor</option>
              <?php } else { ?>
                <option disabled selected>...</option>
              <?php } ?>
              <?php
              foreach ($mt_profesores as $opciones): ?>
                <option value="<?php echo $opciones['IdProf'] ?>">
                  <?php echo $opciones['NombreCompleto'] ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div>
          <label>Nombre del Grupo</label>
          <div class="setting">
            <input type="text" name="NomGrupo" class="Input_Text" value="<?php echo htmlspecialchars($NomGrupo); ?>"
              placeholder="Correo del Profesor" maxlength="50">
          </div>
        </div>
      </div>
      <div class="alinear-boton">
        <input type="hidden" name="action" value="<?php echo $isUpdate ? 'updateGroup' : 'createGroup'; ?>">
        <input type="submit" name="Enviar2" class="boton" value="Enviar">
      </div>
    </fieldset>
  </form>
</main>
<?php include(ROOT_PATH . "/templates/HomeFooter.php"); ?>