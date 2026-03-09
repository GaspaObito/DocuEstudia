<?php
define("PAGE_CSS", "Annotation");
require_once(__DIR__ . "/../../config/config.php");
require_once(ROOT_PATH . "/templates/HomeHeader.php");
require_once(ROOT_PATH . "/config/ProtectPages.php");
require_once(ROOT_PATH . "/controllers/ScoreController.php");
?>
<main class="ContainerGeneral">
  <div class="ContainerUser">
    <?php require_once(ROOT_PATH . "/views/teacher/StudentInfo.php"); ?>
    <div class="anotaciones">
      <div class="nav__miniventana">
        <a></a>
        <h1 id="TitleStart">HISTORICO DE NOTAS <i class="fa-solid fa-book"></i></h1>
        <div>
          <a href="<?php echo BASE_URL; ?>/views/forms/ManageScore.php">
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
      <div class="Container1">
        <label>Resultados Obtenidos: (<?php echo $totalFilas ?>)</label>
        <table class="Custom_Table">
          <thead>
            <tr>
              <th>Periodo</th>
              <th>Nota</th>
              <th>Observacion</th>
              <th>F.Creada</th>
              <th>F.Modificada</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($extraido = mysqli_fetch_array($ScoreHistory)) { ?>
              <tr>
                <td><?php echo $extraido['Periodo']; ?></td>
                <td><?php echo $extraido['Nota']; ?></td>
                <td><?php echo $extraido['Observacion']; ?></td>
                <td><?php echo $extraido['FechCreado']; ?></td>
                <td><?php echo $extraido['FechActualizado']; ?></td>
                <td class="td_Actions">
                  <?php if (isset($_SESSION['IdRol']) && in_array($_SESSION['IdRol'], [2, 3])): ?>
                    <form action="<?php echo BASE_URL; ?>/views/score/ScoreHistory.php" method="post">
                      <input type="hidden" name="NumIdScore" value="<?php echo $extraido['IdNota'] ?>">
                      <input type="hidden" name="action" value="deleteScore">
                      <button class="custom-button" type="submit"
                        onclick="return confirm('¿Está seguro de eliminar esta nota?')">
                        <svg class="navbar-icon" style="margin:0">
                          <use href="<?php echo BASE_URL; ?>/assets/images/svg/Sprite.svg#icon-trash"></use>
                        </svg>
                      </button>
                    </form>
                  <?php endif; ?>
                  <form action="<?php echo BASE_URL; ?>/views/forms/ManageScore.php" method="post">
                    <input type="hidden" name="IdObs" value="<?php echo $IdObs; ?>">
                    <input type="hidden" name="NumIdScore" value="<?php echo $extraido['IdNota'] ?>">
                    <input type="hidden" name="action" value="readScore">
                    <button class="custom-button" type="submit">
                      <svg class="navbar-icon" style="margin:0">
                        <use href="<?php echo BASE_URL; ?>/assets/images/svg/Sprite.svg#icon-arrow_next"></use>
                      </svg>
                    </button>
                  </form>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <div class="alinear-boton">
        <button class="boton" onclick="exportarExcel()">
          <i class="fa-solid fa-file-excel"></i> EXPORTAR XLSX
        </button>
      </div>
    </div>
  </div>
</main>
<?php include(ROOT_PATH . "/templates/HomeFooter.php"); ?>