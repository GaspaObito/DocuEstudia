<?php
define("PAGE_CSS", "Annotation");
require_once(__DIR__ . "/../../config/config.php");
require_once(ROOT_PATH . "/templates/HomeHeader.php");
require_once(ROOT_PATH . "/config/ProtectPages.php");
require_once(ROOT_PATH . "/controllers/ScoreController.php");
?>
<main class="ContainerGeneral">
  <div class="ContainerUser">
    <?php include(ROOT_PATH . "/views/teacher/StudentInfo.php"); ?>
    <div class="anotaciones">
      <div class="nav__miniventana">
        <a></a>
        <h1 id="TitleStart"><?php echo $isUpdate ? 'ACTUALIZAR ' : 'REGISTRAR ';?>NOTA <?php echo $IdNota ?> <i class="fa-solid fa-book"></i>
        </h1>
        <div>
          <a href="<?php echo BASE_URL; ?>/views/matter/MatterxTeacher.php?action=listarMATTERxTEACHER">
            <?php if (isset($_SESSION['IdRol']) && in_array($_SESSION['IdRol'], [2, 3])): ?>
              <div class="botonAtras">
                <div class="margen__boton">
                  <svg class="navbar-icon" style="margin:0;">
                    <use href="<?php echo BASE_URL; ?>/assets/images/svg/Sprite.svg#icon-Arrow_Back"></use>
                  </svg>
                </div>
              </div>
            <?php endif; ?>
          </a>
        </div>
      </div>
      <!-- ALERTAS -->
      <?php include(ROOT_PATH . "/templates/alerts.php"); ?>
      <div class="Container1">
        <form action="<?php echo BASE_URL; ?>/views/forms/ManageScore.php" method="POST" class="formulario">
          <fieldset>
            <input type="hidden" name="IdNota_Actual" value="<?php echo htmlspecialchars($IdNota) ?>">
            <input type="hidden" name="IdObs" value="<?php echo $IdObs; ?>">
            <?php if (isset($_SESSION['IdRol']) && in_array($_SESSION['IdRol'], [2, 3])): ?>
              <input type="hidden" name="Nom_Prof" value="<?php echo $_SESSION['NombreProfe'] ?>">
            <?php endif; ?>
            <div>
              <label>PERIODO *</label>
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
              <label>NOTA *</label>
              <div class="setting">
                <input type="number" name="Nota" class="Input_Text"   step="0.1" min="0" max="5" value="<?php echo htmlspecialchars($Nota); ?>"
                  placeholder="Digite la Nota" required>
              </div>
            </div>
            <div>
              <label>OBSERVACIONES</label>
              <div class="setting">
                <input type="text" name="Observacion" class="Input_Text"
                  value="<?php echo htmlspecialchars($Observacion); ?>" placeholder="Digite la observacion">
              </div>
            </div>
            <?php if ($isUpdate): ?>
              <div>
                <label>FECHA DE CREACION</label>
                <div class="setting">
                  <input readonly class="Input_Text" type="text" value="<?php echo htmlspecialchars($FechCreado); ?>">
                </div>
              </div>
              <div class="Add_Anotacion">
                <label>FECHA DE MODIFICACION</label>
                <div class="setting">
                  <input readonly class="Input_Text" type="text"
                    value="<?php echo htmlspecialchars($FechActualizado); ?>">
                </div>
              </div>
            <?php endif; ?>
          </fieldset>
          <?php if ($_SESSION['rol'] == 2 || $_SESSION['rol'] == 3): ?>
            <div class="alinear-boton">
              <input type="hidden" name="action" value="<?php echo $isUpdate ? 'updateScore' : 'createScore'; ?>">
              <button type="submit" name="EnviarScore" class="boton"><i class="fa-solid fa-paper-plane"></i> ENVIAR NOTA</button>
            </div>
          <?php endif; ?>
        </form>
      </div>
      <div class="alinear-boton">
        <form action="<?php echo BASE_URL; ?>/views/score/ScoreHistory.php" method="post">
          <input type="hidden" name="IdObs" value="<?php echo $IdObs; ?>">
          <input type="hidden" name="action" value="viewHistory">
          <button type="submit" class="boton"><i class="fa-solid fa-clock-rotate-left"></i> VER HISTORIAL</button>
        </form>
      </div>
    </div>
  </div>
  </div>
</main>
<?php include(ROOT_PATH . "/templates/HomeFooter.php"); ?>