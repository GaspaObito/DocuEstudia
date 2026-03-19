<?php
define("PAGE_CSS", "Annotation");
require_once(__DIR__ . "/../../config/config.php");
require_once(ROOT_PATH . "/templates/HomeHeader.php");
require_once(ROOT_PATH . "/config/ProtectPages.php");
require_once(ROOT_PATH . "/controllers/MatterController.php");
?>
<main class="ContainerGeneral">
  <div class="ContainerUser">
    <?php include(ROOT_PATH . "/views/teacher/TeacherInfo.php"); ?>
    <div class="anotaciones">
      <h1 id="TitleStart">MATERIAS DOCENTE <?php echo $Id_Profe ?><i class="fa-solid fa-eye"></i></h1>
      <!-- ALERTAS -->
      <?php include(ROOT_PATH . "/templates/alerts.php"); ?>
      </form>
      <div class="Container1">
        <label>Resultados Obtenidos: (<?php echo $totalFilas ?>)</label>
        <table class="Custom_Table">
          <thead>
            <tr>
              <th>Nombre de la Materia</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($extraido = mysqli_fetch_array($consultar)) { ?>
              <tr>
                <td><?php echo $extraido['NomMateria'] ?></td>
                <td class="td_Actions">
                  <form action="<?php echo BASE_URL; ?>/views/teacher/AnnotationsSearch.php" method="POST">
                    <input type="hidden" name="NumeroModificar" value="<?php echo $extraido['IdMateria'] ?>">
                    <input type="hidden" name="action" value="listarNOTAS">
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
</main>
<?php include(ROOT_PATH . "/templates/HomeFooter.php"); ?>