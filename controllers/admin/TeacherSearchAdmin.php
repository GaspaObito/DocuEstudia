<?php 
$RootPath = ($_SERVER['DOCUMENT_ROOT'] . "/proyectos/DocuEstudia");
include ("$RootPath/templates/HomeHeader.php");
include ("$RootPath/models/TeacherModel.php"); 
include ("$RootPath/config/ProtectPages.php");?>
<main class="ContainerGeneral">
  <div class="anotaciones">
    <h1 id="TitleStart">ACTUALIZAR PROFESOR</h1>
    <form action="<?php echo BASE_URL; ?>/controllers/admin/TeacherSearchAdmin.php" method="GET">
      <fieldset>
        <legend>Buscar Docente por DNI</legend>
        <div class="Formulario_Campos1">
          <div style="display:flex;">
            <label for="DNI" style="padding: 10px 10px 10px 0;">D.N.I</label>
            <input class="Input_Text" type="text" id="DNI" name="DNI" placeholder="DNI del Docente">
          </div>
          <div class="alinear-boton">
            <button class="boton" type="submit">BUSCAR DOCENTE</button>
          </div>
        </div>
      </fieldset>
    </form>
    <div class="Container1">
      <label>Resultados Obtenidos: (<?php echo $totalFilas ?>)</label>
      <table class="Custom_Table">
        <thead>
          <tr>
            <th>Numero Documento</th>
            <th>Nombre</th>
            <th>Asignado</th>
            <th>Curso</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($extraido = mysqli_fetch_array($consultar)) { ?>
            <tr>
              <td><?php echo $extraido['NumDocProf']; ?></td>
              <td><?php echo $extraido['NombreCompleto']; ?></td>
              <td><?php echo $extraido['AsigProf']; ?></td>
              <td><?php echo $extraido['NomCurso']; ?></td>
              <td class="td_Actions">
                <form action="<?php echo BASE_URL; ?>/views/forms/ManageTeacher.php" method="post">
                  <input type="hidden" name="NumeroModificar" value="<?php echo $extraido['IdProf']; ?>">
                  <input type="hidden" name="action" value="delete">
                  <button type="submit" class="custom-button">
                    <svg class="navbar-icon" style="margin:0">
                      <use xlink:href="<?php echo BASE_URL; ?>/assets/images/svg/Trash.svg#Trash-icon">
                    </svg>
                  </button>
                </form>
                <form action="<?php echo BASE_URL; ?>/views/forms/ManageTeacher.php" method="post">
                  <input type="hidden" name="NumeroModificar" value="<?php echo $extraido['IdProf']; ?>">
                  <input type="hidden" name="action" value="read">
                  <button type="submit" class="custom-button">
                    <svg class="navbar-icon" style="margin:0">
                      <use xlink:href="<?php echo BASE_URL; ?>/assets/images/svg/Edit.svg#Edit-icon">
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
    <a href="<?php echo BASE_URL; ?>/views/forms/ManageTeacher.php">
      <button class="boton" type="submit">AÑADIR PROFESOR</button>
    </a>
  </div>
</main>
<?php include ("$RootPath/templates/HomeFooter.php"); ?>