<?php 
$RootPath = ($_SERVER['DOCUMENT_ROOT'] . "/proyectos/DocuEstudia");
include ("$RootPath/templates/HomeHeader.php");
include ("$RootPath/config/ProtectPages.php");
include ("$RootPath/models/DatabaseConnection.php");
include ("$RootPath/models/StudentModel.php"); ?>
<main class="ContainerGeneral">
  <div class="ContainerUser">
    <?php
    $Id_Profe = $_SESSION['Id_Profe'];
    $consultar2 = mysqli_query($conexion, "SELECT CONCAT(NomProf, ' ', ApeProf) AS NombreCompleto, p.*, i.NomImg 
        FROM profesor p LEFT JOIN imagenes i ON p.IdImgProf = i.IdImg WHERE IdProf='$Id_Profe'") or die("ERROR AL TRAER LOS DATOS");
    while ($extraido = mysqli_fetch_array($consultar2)) {
      $_SESSION['NombreProfe'] = $extraido['NombreCompleto']; ?>
      <div class="usuario__especifico">
        <h3 id="DataUser">Perfil</h3>
        <div class="imagen">
          <img width="100"
            src="<?php echo BASE_URL; ?>/assets/images/phototeacher/<?php echo $extraido['NomImg'] ?>">
        </div>
        <h3 id="DataUser">DATOS DEL PROFESOR</h3>
        <div class="usuario__campo">
          <label>Nombre:</label>
          <input readonly class="Input_Text" type="text" value="<?php echo $extraido['NombreCompleto'] ?>">
        </div>
        <div class="usuario__campo">
          <label>DNI:</label>
          <input readonly class="Input_Text" type="text" value="<?php echo $extraido['NumDocProf'] ?>">
        </div>
        <div class="usuario__campo">
          <label>Asignatura:</label>
          <input readonly class="Input_Text" type="text" value="<?php echo $extraido['AsigProf'] ?>">
        </div>
        <div class="usuario__campo">
          <label>Email:</label>
          <input readonly class="Input_Text" type="text" value="<?php echo $extraido['EmailProf'] ?>">
        </div>
      </div>
      <?php $_SESSION['NombreProfe'] = $extraido['NombreCompleto'];
    }
    ?>
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
            <?php while ($extraido = mysqli_fetch_array($consultar)) { ?>
              <tr>
                <td><?php echo $extraido['NumDocEst'] ?></td>
                <td><?php echo $extraido['NombreCompleto'] ?></td>
                <td><?php echo $extraido['NomCurso'] ?></td>
                <td class="td_Actions">
                  <form action="<?php echo BASE_URL; ?>/views/forms/ManageStudent.php" method="post">
                    <input type="hidden" name="NumeroModificar" value="<?php echo $extraido['IdEst'] ?>">
                    <input type="hidden" name="action" value="delete">
                    <button class="custom-button" type="submit">
                      <svg class="navbar-icon" style="margin:0">
                        <use xlink:href="<?php echo BASE_URL; ?>/assets/images/svg/Trash.svg#Trash-icon">
                      </svg>
                    </button>
                  </form>
                  <form action="<?php echo BASE_URL; ?>/views/forms/ManageStudent.php" method="post">
                    <input type="hidden" name="NumeroModificar" value="<?php echo $extraido['IdEst'] ?>">
                    <input type="hidden" name="action" value="read">
                    <button class="custom-button" type="submit">
                      <svg class="navbar-icon" style="margin:0">
                        <use xlink:href="<?php echo BASE_URL; ?>/assets/images/svg/Edit.svg#Edit-icon">
                      </svg>
                    </button>
                  </form>
                  <form action="<?php echo BASE_URL; ?>/controllers/teacher/Annotations.php" method="post">
                    <input type="hidden" name="NumeroInsertar" value="<?php echo $extraido['IdEst'] ?>">
                    <input type="hidden" name="action" value="read">
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
          <button class="boton" type="submit">AÑADIR ESTUDIANTE</button>
        </a>
      </div>
    </div>
</main>
<?php include ("$RootPath/templates/HomeFooter.php"); ?>