<?php
$RootPath = ($_SERVER['DOCUMENT_ROOT'] . "/proyectos/DocuEstudia");
include($RootPath . "/templates/HomeHeader.php");
include($RootPath . "/config/ProtectPages.php");
include($RootPath . "/models/StudentModel.php");
include($RootPath . "/models/AnnotationsModel.php"); ?>
<main class="ContainerGeneral">
  <div class="ContainerUser">
    <?php include($RootPath . "/controllers/teacher/TeacherInfo.php"); ?>
    <div class="anotaciones">
      <h1 id="TitleStart">ANOTACIONES</h1>
      <form action="<?php echo BASE_URL; ?>/controllers/teacher/AnnotationsSearch.php" method="GET">
        <fieldset>
          <legend>Buscar Estudiante por DNI</legend>
          <div class="Formulario_Campos1">
            <div style="display:flex;">
              <label for="DNI" style="padding: 10px 10px 10px 0;">D.N.I</label>
              <input class="Input_Text" type="text" id="DNI" name="DNI" placeholder="DNI del estudiante">
            </div>
            <div class="alinear-boton">
              <button class="boton" type="submit">BUSCAR ESTUDIANTE</button>
            </div>
          </div>
        </fieldset>
      </form>
      <div class="alinear-boton">
        <a href="<?php echo BASE_URL; ?>/views/AnnotationTrigger.php">
          <button class="boton" type="submit" name='buscarDatos'>VER HISTORIAL SERVIDOR</button>
        </a>
      </div>
      <div class="Container1">
        <label>Resultados Obtenidos: (<?php echo $totalFilas ?>)</label>
        <table class="Custom_Table">
          <thead>
            <tr>
              <th>Numero Documento</th>
              <th>Nombre</th>
              <th>Curso</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($extraido = mysqli_fetch_array($sql_observador)) { ?>
              <tr>
                <td><?php echo $extraido['NumDcto'] ?></td>
                <td><?php echo $extraido['NombreCompleto'] ?></td>
                <td><?php echo $extraido['NomCurso'] ?></td>
                <td class="td_Actions">
                  <form action="<?php echo BASE_URL; ?>/views/forms/ManageStudent.php" method="post">
                    <input type="hidden" name="NumeroModificar" value="<?php echo $extraido['IdObs'] ?>">
                    <input type="hidden" name="action" value="delete">
                    <button class="custom-button" type="submit">
                      <svg class="navbar-icon" style="margin:0">
                        <use xlink:href="<?php echo BASE_URL; ?>/assets/images/svg/Trash.svg#Trash-icon">
                      </svg>
                    </button>
                  </form>
                  <form action="<?php echo BASE_URL; ?>/views/forms/ManageStudent.php" method="post">
                    <input type="hidden" name="NumeroModificar" value="<?php echo $extraido['IdObs'] ?>">
                    <input type="hidden" name="action" value="read">
                    <button class="custom-button" type="submit">
                      <svg class="navbar-icon" style="margin:0">
                        <use xlink:href="<?php echo BASE_URL; ?>/assets/images/svg/Edit.svg#Edit-icon">
                      </svg>
                    </button>
                  </form>
                  <form action="<?php echo BASE_URL; ?>/views/forms/ManageAnnotations.php" method="post">
                    <input type="hidden" name="NumeroModificar" value="<?php echo $extraido['IdObs'] ?>">
                    <input type="hidden" name="action">
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
      <div class="alinear-boton">
        <a href="<?php echo BASE_URL; ?>/views/forms/ManageStudent.php">
          <input type="hidden" name="action" value="create">
          <button class="boton" type="submit">AÑADIR ESTUDIANTE</button>
        </a>
      </div>
    </div>
</main>
<?php include("$RootPath/templates/HomeFooter.php"); ?>