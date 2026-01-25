<?php
require_once(__DIR__ . "/../../config/config.php");
require_once(ROOT_PATH . "/templates/HomeHeader.php");
require_once(ROOT_PATH . "/config/ProtectPages.php");
require_once(ROOT_PATH . "/controllers/ScoreController.php");
?>
<main class="ContainerGeneral">
  <div class="anotaciones">
    <h1 id="TitleStart"><?php echo $isUpdate ? 'ACTUALIZAR ' : 'REGISTRAR '; ?>NOTAS PARA ESTUDIANTE
      <?php echo $IdNota ?> <i class="fa-solid fa-book"></i>
    </h1>
    <!-- ALERTAS -->
    <?php include(ROOT_PATH . "/templates/alerts.php"); ?>
    <div class="Container1">
      <form method="POST" class="formulario" enctype="multipart/form-data">
        <fieldset>
          <div class="formulario__campos1">
            <input type="hidden" name="IdNota_Actual" value="<?php echo htmlspecialchars($IdNota) ?>">
            <?php if ($isUpdate) { ?>
              <div>
                <label># Documento</label>
                <div class="setting">
                  <input type="text" name="Nombre" class="Input_Text" disabled value="<?php echo htmlspecialchars($IdObs); ?>">
                </div>
              </div>
              <div>
                <label>Nombre Estudiante</label>
                <div class="setting">
                  <input type="text" name="Periodo" class="Input_Text" disabled value="<?php echo htmlspecialchars($full_name); ?>">
                </div>
              </div>
            <?php } ?>
            <div>
              <label>Nombre de la Materia *</label>
              <div class="setting">
                <input type="text" name="Periodo" class="Input_Text" <?php echo $isUpdate ? 'disabled' : '' ?> value="<?php echo htmlspecialchars($NomMateria); ?>" placeholder="Apellido del Profesor" required>
              </div>
            </div>
            <div>
              <label>Periodo *</label>
              <div class="setting">
                <input type="hidden" name="Periodo_Actual" value="<?php echo htmlspecialchars($Periodo) ?>">
                <select type="text" name="Periodo" class="Input_Text">
                  <?php if ($isUpdate) { ?>
                    <option value="mantener" selected>Asignado:<?php echo htmlspecialchars($Periodo) ?></option>
                  <?php } else { ?>
                    <option disabled selected>...</option>
                  <?php } ?>
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                </select>
              </div>
            </div>
            <div>
              <label>Observacion</label>
              <div class="setting">
                <input type="text" name="Observacion" class="Input_Text" value="<?php echo htmlspecialchars($Observacion); ?>" placeholder="Digite la observacion">
              </div>
            </div>
            <div>
              <label>Nota</label>
              <div class="setting">
                <input type="number" name="Nota" class="Input_Text" value="<?php echo htmlspecialchars($Nota); ?>" placeholder="Digite la Nota" required>
              </div>
            </div>
            <?php if ($isUpdate) { ?>
              <div>
                <label>FechCreado</label>
                <div class="setting">
                  <input type="text" class="Input_Text" readonly value="<?php echo htmlspecialchars($FechCreado); ?>">
                </div>
              </div>
              <div>
                <label>FechActualizado</label>
                <div class="setting">
                  <input type="text" class="Input_Text" readonly value="<?php echo htmlspecialchars($FechActualizado); ?>">
                </div>
              </div>
            <?php } ?>
        </fieldset>
        <div class="alinear-boton">
          <input type="hidden" name="action" value="updateScore">
          <input type="submit" name="EnviarScore" class="boton" value="Enviar">
        </div>
      </form>
    </div>
  </div>
</main>
<?php include(ROOT_PATH . "/templates/HomeFooter.php"); ?>