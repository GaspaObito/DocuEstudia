<?php
require_once(__DIR__ . "/../../config/config.php");
require_once(ROOT_PATH . "/templates/HomeHeader.php");
require_once(ROOT_PATH . "/config/ProtectPages.php");
require_once(ROOT_PATH . "/models/AnnotationsModel.php");
?>
<main class="ContainerGeneral">
  <div class="ContainerUser">
    <?php require_once(ROOT_PATH ."/controllers/teacher/StudentInfo.php"); ?>
    <div class="anotaciones">
      <div class="nav__miniventana">
        <a></a>
        <h1 id="TitleStart">ANOTACIONES <i class="fa-solid fa-book"></i></h1>
        <div>
          <a href="<?php echo BASE_URL; ?>/views/forms/ManageAnnotations.php">
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
      <div class="Container1">
        <label>Resultados Obtenidos: (<?php echo $totalFilas ?>)</label>
        <table class="Custom_Table">
          <thead>
            <tr>
              <th>Anotacion</th>
              <th>T.Falta</th>
              <th>F.Creada</th>
              <th>F.Modificada</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($extraido = mysqli_fetch_array($anotacionesConsulta)) { ?>
              <tr>
                <td><?php echo $contador++ ?></td>
                <td><?php echo $extraido['TipoFalta'] ?></td>
                <td><?php echo $extraido['FecCreacion'] ?></td>
                <td><?php echo $extraido['FecModif'] ?></td>
                <td class="td_Actions">
                  <form action="<?php echo BASE_URL; ?>/models/AnnotationsModel.php" method="post">
                    <input type="hidden" name="NumIdAnnotation" value="<?php echo $extraido['IdAnot'] ?>">
                    <input type="hidden" name="action" value="delete">
                    <button class="custom-button" type="submit">
                      <svg class="navbar-icon" style="margin:0">
                        <use xlink:href="<?php echo BASE_URL; ?>/assets/images/svg/Trash.svg#Trash-icon">
                      </svg>
                    </button>
                  </form>
                  <form action="<?php echo BASE_URL; ?>/views/forms/ManageAnnotations.php" method="post">
                    <input type="hidden" name="NumIdAnnotation" value="<?php echo $extraido['IdAnot'] ?>">
                    <input type="hidden" name="action" value="readespecefy">
                    <button class="custom-button" type="submit">
                      <svg class="navbar-icon" style="margin:0">
                        <use xlink:href="<?php echo BASE_URL; ?>/assets/images/svg/Arrow.svg#Arrow-icon">
                      </svg>
                    </button>
                  </form>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>
<?php include(ROOT_PATH ."/templates/HomeFooter.php"); ?>