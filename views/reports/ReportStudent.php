<?php
define("PAGE_CSS", "Annotation");
require_once(__DIR__ . "/../../config/config.php");
require_once(ROOT_PATH . "/templates/HomeHeader.php");
require_once(ROOT_PATH . "/config/ProtectPages.php");
require_once(ROOT_PATH . "/controllers/StudentController.php");
?>
<main class="ContainerGeneral">
  <div class="ContainerUser">
    <?php include(ROOT_PATH . "/views/teacher/TeacherInfo.php"); ?>
    <div class="anotaciones">
      <h1 id="TitleStart">GENERADOR DE BOLETIN ESTUDIANTE <i class="fa-solid fa-pen-clip"></i></h1>
      <!-- ALERTAS -->
      <?php include(ROOT_PATH . "/templates/alerts.php"); ?>
      <form action="<?php echo BASE_URL; ?>/views/teacher/AnnotationsSearch.php" method="GET">
        <fieldset>
          <legend>Filtrar Estudiante</legend>
          <div class="formulario__campos1">
            <!-- Filtro por DNI -->
            <div>
              <label for="DNI"># Documento Identidad:</label>
              <div class="setting">
                <input class="Input_Text" type="text" id="DNI" name="DNI"
                  value="<?php echo isset($_GET['DNI']) ? htmlspecialchars($_GET['DNI']) : ''; ?>"
                  placeholder="DNI del Estudiante">
              </div>
            </div>
            <!-- Filtro por Nombre -->
            <div>
              <label for="Nombre">Nombre:</label>
              <div class="setting">
                <input class="Input_Text" type="text" id="Nombre" name="Nombre"
                  value="<?php echo isset($_GET['Nombre']) ? htmlspecialchars($_GET['Nombre']) : ''; ?>"
                  placeholder="Nombre del Estudiante">
              </div>
            </div>
            <!-- Filtro por Apellido -->
            <div>
              <label for="Apellido">Apellido:</label>
              <div class="setting">
                <input class="Input_Text" type="text" id="Apellido" name="Apellido"
                  value="<?php echo isset($_GET['Apellido']) ? htmlspecialchars($_GET['Apellido']) : ''; ?>"
                  placeholder="Apellido del Estudiante">
              </div>
            </div>
            <!-- Filtro por Grado -->
            <div>
              <label for="Grado">Grado:</label>
              <div class="setting">
                <select id="Grado" name="Grado" class="Input_Text">
                  <option value="">-- TODOS --</option>
                  <?php foreach ($mt_grados as $opciones): ?>
                    <option value="<?php echo $opciones['IdGrado']; ?>" <?php echo (isset($_GET['Grado']) && $_GET['Grado'] == $opciones['IdGrado']) ? 'selected' : ''; ?>>
                      <?php echo htmlspecialchars($opciones['NomGrado']); ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
          <!-- Botón -->
          <div class="alinear-boton">
            <button class="boton" type="submit"><i class="fa-solid fa-magnifying-glass"></i> BUSCAR ESTUDIANTE</button>
          </div>
        </fieldset>
      </form>
      <div class="Container1">
        <label>Resultados Obtenidos: (<?php echo $totalFilas ?>)</label>
        <table class="Custom_Table">
          <thead>
            <tr>
              <th># Documento</th>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Grado</th>
              <th>Grupo</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($extraido = mysqli_fetch_array($sql_observador)) { ?>
              <tr>
                <td><?php echo $extraido['NumDcto'] ?></td>
                <td><?php echo $extraido['Nombre'] ?></td>
                <td><?php echo $extraido['Apellido'] ?></td>
                <td><?php echo $extraido['NomGrado'] ?></td>
                <td><?php echo $extraido['IdGrupo'] ?></td>
                <td class="td_Actions">
                  <!-- CHANGE ANNOTATION SCORE STUDENT -->
                  <form action="<?php echo BASE_URL; ?>/views/reports/ReportNotas.php" method="post">
                    <input type="hidden" name="NumeroModificar" value="<?php echo $extraido['IdObs'] ?>">
                    <input type="hidden" name="action" >
                    <button class="custom-button" type="submit">
                      <svg class="navbar-icon" style="margin:0">
                        <use href="<?php echo BASE_URL; ?>/assets/images/svg/Sprite.svg#icon-FilePDF"></use>
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