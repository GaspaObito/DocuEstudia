<?php
require_once(__DIR__ . "/../../config/config.php");
require_once(ROOT_PATH . "/templates/HomeHeader.php");
require_once(ROOT_PATH . "/config/ProtectPages.php");
require_once(ROOT_PATH . "/controllers/MatterController.php");
?>
<main class="ContainerGeneral">
  <div class="anotaciones">
    <h1 id="TitleStart">MATERIAS ACADEMICAS <i class="fa-solid fa-book"></i></h1>
    <!-- ALERTAS -->
    <?php include(ROOT_PATH . "/templates/alerts.php"); ?>
    <div class="Container1">
      <label>Resultados Obtenidos: (<?php echo $totalFilas ?>)</label>
      <table class="Custom_Table">
        <thead>
          <tr>
            <th>Id_Materia</th>
            <th>Nombre_Materia</th>
            <th>Descripcion</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($extraido = mysqli_fetch_array($consultar)) { ?>
            <tr>
              <td><?php echo $extraido['IdMateria']; ?></td>
              <td><?php echo $extraido['NomMateria']; ?></td>
              <td><?php echo $extraido['Descripcion']; ?></td>
              <td class="td_Actions">
                <form action="<?php echo BASE_URL; ?>/views/forms/ManageMatter.php" method="post">
                  <input type="hidden" name="NumeroModificar" value="<?php echo $extraido['IdMateria']; ?>">
                  <input type="hidden" name="action" value="deleteMatter">
                  <button type="submit" class="custom-button" onclick="return confirm('¿Está seguro de eliminar esta materia?')">
                    <svg class="navbar-icon" style="margin:0">
                      <use href="<?php echo BASE_URL; ?>/assets/images/svg/Sprite.svg#icon-trash"></use>
                    </svg>
                  </button>
                </form>
                <form action="<?php echo BASE_URL; ?>/views/forms/ManageMatter.php" method="post">
                  <input type="hidden" name="NumeroModificar" value="<?php echo $extraido['IdMateria']; ?>">
                  <input type="hidden" name="action" value="readMatter">
                  <button type="submit" class="custom-button">
                    <svg class="navbar-icon" style="margin:0">
                      <use href="<?php echo BASE_URL; ?>/assets/images/svg/Sprite.svg#icon-edit"></use>
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
  <div class="alinear-boton">
    <a class="boton" href="<?php echo BASE_URL; ?>/views/forms/ManageMatter.php">
      <i class="fa-solid fa-plus"></i> AÑADIR MATERIA
    </a>
    <button class="boton" onclick="exportarExcel()">
      <i class="fa-solid fa-file-excel"></i> EXPORTAR XLSX
    </button>
  </div>
</main>
<?php include(ROOT_PATH . "/templates/HomeFooter.php"); ?>