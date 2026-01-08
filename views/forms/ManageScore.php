<?php
require_once(__DIR__ . "/../../config/config.php");
require_once(ROOT_PATH . "/templates/HomeHeader.php");
require_once(ROOT_PATH . "/config/ProtectPages.php");
require_once(ROOT_PATH . "/controllers/ScoreController.php");
?>
<main class="ContainerGeneral">
  <div class="anotaciones">
    <h1 id="TitleStart"><?php echo $isUpdate ? 'ACTUALIZAR ' : 'REGISTRAR '; ?>NOTAS PARA ESTUDIANTE
      <?php echo $IdNota ?> <i class="fa-solid fa-book"></i></h1>
    <!-- ALERTAS -->
    <?php include(ROOT_PATH . "/templates/alerts.php"); ?>
    <div class="Container1">
      <form action="<?php echo BASE_URL; ?>/views/matter/MatterXGrade.php" method="POST" class="formulario">
        <fieldset>
          <div class="formulario__campos1">
            <?php if ($isUpdate) { ?>
              <div>
                <label># Documento</label>
                <div class="setting">
                  <input type="text" name="Nombre" class="Input_Text" disabled
                    value="<?php echo htmlspecialchars($IdObs); ?>">
                </div>
              </div>
              <div>
                <label>Nombre Estudiante</label>
                <div class="setting">
                  <input type="text" name="Nombre" class="Input_Text" disabled
                    value="<?php echo htmlspecialchars($full_name); ?>">
                </div>
              </div>
            <?php } ?>
            <div>
              <label>Nombre de la Materia *</label>
              <div class="setting">
                <input type="text" name="Apellido" class="Input_Text" <?php echo $isUpdate ? 'disabled' : '' ?>
                  value="<?php echo htmlspecialchars($NomMateria); ?>" placeholder="Apellido del Profesor" required>
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
                <input type="number" name="NumDocumento" class="Input_Text"
                  value="<?php echo htmlspecialchars($NumDocumento); ?>" placeholder="Digite Numero de documento"
                  required>
              </div>
            </div>
            <div>
              <label>Nota</label>
              <div class="setting">
                <input type="number" name="NumDocumento" class="Input_Text"
                  value="<?php echo htmlspecialchars($Nota); ?>" placeholder="Digite Numero de documento" required>
              </div>
            </div>
            <?php if ($isUpdate) { ?>
              <div>
                <label>FechCreado</label>
                <div class="setting">
                  <input type="text" name="NumDocumento" class="Input_Text"
                    value="<?php echo htmlspecialchars($FechCreado); ?>" placeholder="Digite Numero de documento"
                    required>
                </div>
              </div>
              <div>
                <label>FechActualizado</label>
                <div class="setting">
                  <input type="text" name="NumDocumento" class="Input_Text"
                    value="<?php echo htmlspecialchars($FechActualizado); ?>" placeholder="Digite Numero de documento"
                    required>
                </div>
              </div>
            <?php } ?>
        </fieldset>
        <div class="alinear-boton">
          <input type="hidden" name="action" value="<?php echo $isUpdate ? 'update' : 'create'; ?>">
          <input type="submit" name="EnviarScore" class="boton" value="Enviar">
        </div>
      </form>
    </div>
  </div>
</main>
<?php include(ROOT_PATH . "/templates/HomeFooter.php"); ?>