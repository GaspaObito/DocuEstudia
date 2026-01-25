<?php
define("PAGE_CSS", "Annotation");
require_once(__DIR__ . "/../../config/config.php");
require_once(ROOT_PATH . "/templates/HomeHeader.php");
require_once(ROOT_PATH . "/config/ProtectPages.php");
require_once(ROOT_PATH . "/controllers/ScoreController.php");
?>
<main class="ContainerGeneral">
  <div class="anotaciones">
    <h1 id="TitleStart">MAESTRO NOTAS ACADEMICAS <i class="fa-solid fa-chalkboard-user"></i></h1>
    <!-- ALERTAS -->
    <?php include(ROOT_PATH . "/templates/alerts.php"); ?>
    <form action="<?php echo BASE_URL; ?>/views/score/MtScore.php" method="GET">
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
          <!-- Filtro por Materia -->
          <div>
            <label for="Materia">Materia:</label>
            <div class="setting">
              <select id="Materia" name="Materia" class="Input_Text">
                <option value="">-- TODOS --</option>
                <?php foreach ($mt_materias as $opciones): ?>
                  <option value="<?php echo $opciones['IdMateria']; ?>" <?php echo (isset($_GET['Materia']) && $_GET['Materia'] == $opciones['IdMateria']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($opciones['NomMateria']); ?>
                  </option>
                <?php endforeach; ?>
              </select>
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
          <!-- Filtro por Grupo -->
          <div>
            <label for="Grupo">Grupo:</label>
            <div class="setting">
              <select id="Grupo" name="Grupo" class="Input_Text">
                <option value="">-- TODOS --</option>
                <?php foreach ($mt_grupos as $opciones): ?>
                  <option value="<?php echo $opciones['IdGrupo']; ?>" <?php echo (isset($_GET['Grupo']) && $_GET['Grupo'] == $opciones['IdGrupo']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($opciones['IdGrupo']); ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>
  </div>
  <!-- Botón -->
  <div class="alinear-boton">
    <input type="hidden" name="action" value="listar">
    <button class="boton" type="submit"><i class="fas fa-search"></i> FILTRAR</button>
  </div>
  </fieldset>
  </form>
  <div class="Container1">
    <label>Resultados Obtenidos: (<?php echo $totalFilas ?>)</label>
    <table class="Custom_Table">
      <thead>
        <tr>
          <th>IdNota</th>
          <th># Documento</th>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Grado</th>
          <th>Grupo</th>
          <th>IdMateria</th>
          <th>Periodo</th>
          <th>Nota</th>
          <th>Observacion</th>
          <th>FechCreado</th>
          <th>FechActualizado</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($extraido = mysqli_fetch_array($consultar)) { ?>
          <tr>
            <td><?php echo $extraido['IdNota']; ?></td>
            <td><?php echo $extraido['NumDcto']; ?></td>
            <td><?php echo $extraido['Nombre'] ?></td>
            <td><?php echo $extraido['Apellido'] ?></td>
            <td><?php echo $extraido['NomGrado'] ?></td>
            <td><?php echo $extraido['IdGrupo'] ?></td>
            <td><?php echo $extraido['NomMateria']; ?></td>
            <td><?php echo $extraido['Periodo']; ?></td>
            <td><?php echo $extraido['Nota']; ?></td>
            <td><?php echo $extraido['Observacion']; ?></td>
            <td><?php echo $extraido['FechCreado']; ?></td>
            <td><?php echo $extraido['FechActualizado']; ?></td>
            <td class="td_Actions">
              <form action="<?php echo BASE_URL; ?>/views/score/MtScore.php" method="post">
                <input type="hidden" name="NumeroModificar" value="<?php echo $extraido['IdNota']; ?>">
                <input type="hidden" name="action" value="deleteScore">
                <button type="submit" class="custom-button"
                  onclick="return confirm('¿Está seguro de eliminar esta nota?')">
                  <svg class="navbar-icon" style="margin:0">
                    <use href="<?php echo BASE_URL; ?>/assets/images/svg/Sprite.svg#icon-trash"></use>
                  </svg>
                </button>
              </form>
              <form action="<?php echo BASE_URL; ?>/views/forms/ManageScore.php" method="post">
                <input type="hidden" name="NumeroModificar" value="<?php echo $extraido['IdNota']; ?>">
                <input type="hidden" name="action" value="readScore">
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
    <button class="boton" onclick="exportarExcel()">
      <i class="fa-solid fa-file-excel"></i> EXPORTAR XLSX
    </button>
  </div>
</main>
<?php include(ROOT_PATH . "/templates/HomeFooter.php"); ?>