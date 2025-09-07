<?php
// 👇 Incluimos el archivo central de configuración
require_once(__DIR__ . "/../../config/config.php");
require_once(ROOT_PATH . "/templates/HomeHeader.php");
require_once(ROOT_PATH . "/config/ProtectPages.php");
require_once(ROOT_PATH . "/models/AnnotationsModel.php");
?>
<main class="ContainerGeneral">
  <div class="ContainerUser">
    <?php include(ROOT_PATH . "/controllers/teacher/StudentInfo.php"); ?>
    <div class="anotaciones">
      <div class="nav__miniventana">
        <a></a>
        <h1 id="TitleStart"><?php echo $isUpdate ? 'Actualizar ' : 'Registrar '; ?>Anotacion</h1>
        <div>
          <!-- Aquí usamos BASE_URL -->
          <a href="<?php echo BASE_URL; ?>/controllers/teacher/AnnotationsSearch.php">

            <div class="botonAtras">
              <div class="margen__boton">
                <svg class="navbar-icon" style="margin:0;">
                  <use xlink:href="<?php echo BASE_URL; ?>/assets/images/svg/Arrow_Back.svg#Arrow_Back-icon">
                </svg>
              </div>
            </div>
          </a>
        </div>
      </div>
      <div id="contenido"></div>
      <div class="Container1">
        <form action="<?php echo BASE_URL; ?>/models/AnnotationsModel.php" method="post" class="formulario">
          <fieldset>
            <input type="hidden" name="NumIdAnnotation" value="<?php echo $idAnot; ?>">
            <input type="hidden" name="IdObs" value="<?php echo $IdObs; ?>">
            <input type="hidden" name="Nom_Prof" value="<?php echo $_SESSION['NombreProfe'] ?>">
            <div>
              <div class="Add_Anotacion">
                <label>TIPO DE FALTA</label>
                <input type="hidden" name="tipoFaltaActual" value="<?php echo htmlspecialchars($TipoFalta)?>">
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
                <textarea maxlength="255" name="descripcion" class="Input_Text"><?php echo htmlspecialchars($DescFalta) ?></textarea>
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
                <input readonly class="Input_Text" type="text" value="<?php echo htmlspecialchars($FecModif); ?>">
              </div>
            <?php endif; ?>

          </fieldset>
          <div class="alinear-boton">
            <input type="hidden" name="action" value="<?php echo $isUpdate ? 'update' : 'create'; ?>">
            <input type="submit" name="SendAnnotation" class="boton" value="ENVIAR ANOTACION">
          </div>
        </form>
      </div>
      <div class="alinear-boton">
        <form action="<?php echo BASE_URL; ?>/controllers/teacher/AnnotationsHistory.php" method="post">
          <input type="hidden" name="IdObs" value="<?php echo $IdObs; ?>">
          <input type="hidden" name="action" value="read">
          <button type="submit" class="boton">VER HISTORIAL</button>
        </form>
      </div>
    </div>
  </div>
  </div>
</main>
<?php include(ROOT_PATH."/templates/HomeFooter.php"); ?>