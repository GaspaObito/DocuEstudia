<?php
require_once(__DIR__ . "/../../config/config.php");
require_once(ROOT_PATH . "/templates/HomeHeader.php");
require_once(ROOT_PATH . "/config/ProtectPages.php");
require_once(ROOT_PATH . "/models/MatterModel.php");
?>
<main class="ContainerGeneral">
  <div class="anotaciones">
    <h1 id="TitleStart">MATERIAS POR GRADO <?php echo $IdGrado ?> <i class="fa-solid fa-book"></i></h1>
    <div class="Container1">
      <form action="<?php echo BASE_URL; ?>/views/matter/MatterXGrade.php" method="POST" class="formulario">
        <fieldset>
          <!-- Selección de grado -->
          <div>
            <label for="Grado">Seleccione el Grado:</label>
            <div class="setting">
              <select id="Grado" name="IdGrado" class="Input_Text">
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
            <a href="<?php echo BASE_URL; ?>/views/matter/MatterXGrade.php">
              <button class="boton" name="IdGrado" value="0" type="submit"><i class="fa-solid fa-plus"></i>
                CANCELAR</button>
            </a>
            <a href="<?php echo BASE_URL; ?>/views/matter/MatterXGrade.php">
              <input type="hidden" name="action" value="AsigMultipleMatter">
              <button class="boton" type="submit"><i class="fa-solid fa-plus"></i> ASIGNAR MATERIAS</button>
            </a>
          <?php } else { ?>
            <input type="hidden" name="action" value="readMatterXGrade">
            <button class="boton" type="submit"><i class="fas fa-search"></i> CONSULTAR GRADO</button>
          <?php } ?>
        </div>
      </form>
    </div>
  </div>
</main>
<?php include(ROOT_PATH . "/templates/HomeFooter.php"); ?>