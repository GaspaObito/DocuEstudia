<?php
define("PAGE_CSS", "Annotation");
require_once(__DIR__ . "/../../config/config.php");
require_once(ROOT_PATH . "/templates/HomeHeader.php");
require_once(ROOT_PATH . "/config/ProtectPages.php");
require_once(ROOT_PATH . "/controllers/AnnotationsController.php");
?>
<main class="ContainerGeneral">
  <div class="ContainerUser">
    <?php include(ROOT_PATH . "/views/teacher/StudentInfo.php"); ?>
    <div class="anotaciones">
      <div class="nav__miniventana">
        <a></a>
        <h1 id="TitleStart"><?php echo $isUpdate ? 'ACTUALIZAR ' : 'REGISTRAR '; ?>ANOTACION <i
            class="fa-solid fa-book"></i></h1>
        <div>
          <a href="<?php echo BASE_URL; ?>/views/teacher/AnnotationsSearch.php">
            <?php if ($_SESSION['rol'] == 2 || $_SESSION['rol'] == 3): ?>
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
        <form action="<?php echo BASE_URL; ?>/controllers/AnnotationsController.php" method="POST" class="formulario">
          <?php foreach ($datos as $fila) { ?>
            <input type="hidden" name="EmailUser" value="<?php echo $fila['Email']; ?>">
          <?php } ?>
          <fieldset>
            <input type="hidden" name="IdObs" value="<?php echo $IdObs; ?>">
            <?php if ($_SESSION['rol'] == 2 || $_SESSION['rol'] == 3): ?>
              <input type="hidden" name="Nom_Prof" value="<?php echo $_SESSION['NombreProfe'] ?>">
            <?php endif; ?>
            <div>
              <div class="Add_Anotacion">
                <label>TIPO DE FALTA</label>
                <input type="hidden" name="tipoFaltaActual" value="<?php echo htmlspecialchars($TipoFalta) ?>">
                <select name="tipoFalta" class="Input_Text">
                  <?php if ($isUpdate) { ?>
                    <option value="mantener" selected>Asignado:<?php echo htmlspecialchars($TipoFalta) ?></option>
                  <?php } else { ?>
                    <option disabled selected>...</option>
                  <?php } ?>
                  <option>Leve</option>
                  <option>Grave</option>
                  <option>Muy grave</option>
                </select>
              </div>
              <div class="Add_Anotacion">
                <label>DESCRIPCION DE LA ANOTACIÓN</label>
                <textarea required maxlength="255" name="descripcion"
                  class="Input_Text"><?php echo htmlspecialchars($DescFalta) ?></textarea>
              </div>
            </div>
            <?php if ($isUpdate): ?>
              <div class="Add_Anotacion">
                <label>ANOTACION CREADA POR</label>
                <input readonly class="Input_Text" type="text" value="<?php echo htmlspecialchars($NomProfCread); ?>">
              </div>
              <div class="Add_Anotacion">
                <label>FECHA DE CREACION</label>
                <input readonly class="Input_Text" type="text" value="<?php echo htmlspecialchars($FecCreacion); ?>">
              </div>
              <div class="Add_Anotacion">
                <label>ULTIMA MODIFICACION REALIZADA POR</label>
                <input readonly class="Input_Text" type="text" value="<?php echo htmlspecialchars($NomProfModif); ?>">
              </div>
              <div class="Add_Anotacion">
                <label>FECHA DE MODIFICACION</label>
                <input readonly class="Input_Text" type="text" value="<?php echo htmlspecialchars($FecModif ?? ''); ?>">
              </div>
            <?php endif; ?>
          </fieldset>
          <?php if ($_SESSION['rol'] == 2 || $_SESSION['rol'] == 3): ?>
            <div class="alinear-boton">
              <input type="hidden" name="action" value="<?php echo $isUpdate ? 'update' : 'create'; ?>">
              <input type="hidden" name="NumIdAnnotation" value="<?php echo htmlspecialchars($idAnot); ?>">
              <button type="submit" name="SendAnnotation" class="boton"><i class="fa-solid fa-paper-plane"></i> ENVIAR ANOTACION</button>
            </div>
          <?php endif; ?>
        </form>
      </div>
      <div class="alinear-boton">
        <form action="<?php echo BASE_URL; ?>/views/teacher/AnnotationsHistory.php" method="post">
          <input type="hidden" name="IdObs" value="<?php echo $IdObs; ?>">
          <input type="hidden" name="action" value="read">
          <button type="submit" class="boton"><i class="fa-solid fa-clock-rotate-left"></i> VER HISTORIAL</button>
        </form>
      </div>
    </div>
  </div>
  </div>
</main>
<?php include(ROOT_PATH . "/templates/HomeFooter.php"); ?>