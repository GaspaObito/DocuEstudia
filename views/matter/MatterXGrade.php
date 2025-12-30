<?php
require_once(__DIR__ . "/../../config/config.php");
require_once(ROOT_PATH . "/templates/HomeHeader.php");
require_once(ROOT_PATH . "/config/ProtectPages.php");
require_once(ROOT_PATH . "/models/MatterModel.php");
?>
<main class="ContainerGeneral">
  <div class="anotaciones">
    <h1 id="TitleStart">MATERIAS POR GRADO <?php echo $IdMateria ?> <i class="fa-solid fa-book"></i></h1>
    <!-- ALERTAS -->
    <?php include(ROOT_PATH . "/templates/alerts.php"); ?>
    <div class="Container1">
      <form action="<?php echo BASE_URL; ?>/views/matter/MatterXGrade.php" method="POST" class="formulario">
        <fieldset>
          <!-- Selección de grado -->
          <div>
            <label for="Grado">Seleccione el Grado:</label>
            <div class="setting">
              <input type="hidden" name="IdGrado" value="<?= $IdGrado ?>">
              <select id="Grado" name="IdGrado" class="Input_Text" <?php echo $isUpdate ? 'disabled' : '' ?>>
                <option disabled>-- SELECCIONE --</option>
                <option selected>Asignado: <?php echo htmlspecialchars($NomGrado) ?></option>
                <?php foreach ($mt_grados as $opciones): ?>
                  <option value="<?php echo $opciones['IdGrado']; ?>" <?php echo (isset($_GET['Grado']) && $_GET['Grado'] == $opciones['IdGrado']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($opciones['NomGrado']); ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <br>
          <!-- Selección múltiple de materias -->
          <?php if ($isUpdate) { ?>
            <div>
              <label>Seleccione las materias:<label>
                  <div class="setting">
                    <?php if ($isUpdate) { ?>
                      <select name="FornIdMateria[]" multiple size="1" class="Input_Text">
                        <option disabled>...</option>
                        <?php
                        foreach ($mt_materias as $opciones): ?>
                          <option value="<?= $opciones['IdMateria']; ?>" <?= in_array($opciones['IdMateria'], $materiasAsignadas) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($opciones['NomMateria']); ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    <?php } else { ?>
                      <option disabled>...</option>
                    <?php } ?>
                  </div>
                <?php } ?>
        </fieldset>
        <div class="alinear-boton">
          <?php if ($isUpdate) { ?>
            <button class="boton" name="IdGrado" value="0"><i class="fa-solid fa-xmark"></i></i> CANCELAR</button>
            <button class="boton" name="action" value="AsigMultipleMatter" type="submit"><i
                class="fa-solid fa-floppy-disk"></i></i> ASIGNAR MATERIAS</button>
          <?php } else { ?>
            <button class="boton" name="action" value="readMatterXGrade" type="submit"><i class="fas fa-search"></i>
              CONSULTAR GRADO</button>
          <?php } ?>
        </div>
      </form>
    </div>
  </div>
</main>
<?php include(ROOT_PATH . "/templates/HomeFooter.php"); ?>