<?php
$RootPath = ($_SERVER['DOCUMENT_ROOT'] . "/proyectos/DocuEstudia");
include ("$RootPath/templates/HomeHeader.php");
include ("$RootPath/config/ProtectPages.php");
include ("$RootPath/models/DatabaseConnection.php"); ?>
<main class="ContainerGeneral">
  <div class="ContainerUser">
    <?php include ("$RootPath/controllers/teacher/StudentInfo.php"); ?>
    <div class="anotaciones">
      <div class="nav__miniventana">
        <a></a>
        <h1 id="TitleStart">ANOTACIONES</h1>
        <div>
          <a href="Annotations.php">
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
      <?php
      $consultar2 = mysqli_query($conexion, "select * from anotacion WHERE IdEst='$Id_Est'") or die("ERROR AL TRAER LOS DATOS");
      $query = "SELECT COUNT(*) AS total FROM anotacion WHERE IdEst='$Id_Est'";
      $resultado = mysqli_query($conexion, $query);
      $datos = mysqli_fetch_assoc($resultado);
      $totalFilas = $datos['total'];
      $contador = 1; ?>
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
            <?php while ($extraido = mysqli_fetch_array($consultar2)) { ?>
              <tr>
                <td><?php echo $contador++ ?></td>
                <td><?php echo $extraido['TipoFalta'] ?></td>
                <td><?php echo $extraido['FecCreacion'] ?></td>
                <td><?php echo $extraido['FecModif'] ?></td>
                <td class="td_Actions">
                  <form action="<?php echo BASE_URL; ?>/models/AnnotationsModel.php" method="post">
                    <input type="hidden" name="NumIdAnnotation" value="<?php echo $extraido['IdAnot'] ?>">
                    <input type="hidden" name="action" value="delete">
                    <button name="EliminarDato" class="custom-button" type="submit">
                      <svg class="navbar-icon" style="margin:0">
                        <use xlink:href="<?php echo BASE_URL; ?>/assets/images/svg/Trash.svg#Trash-icon">
                      </svg>
                    </button>
                  </form>
                  <form action="AnnotationsDescription.php" method="post">
                    <input type="hidden" name="NumIdAnnotation" value="<?php echo $extraido['IdAnot'] ?>">
                    <input type="hidden" name="action" value="read">
                    <button name="InsertarAnotacion" class="custom-button" type="submit">
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
      <?php
      if (isset($_POST["EliminarDato"])) {
        $NumeroEliminar = $_POST['NumeroEliminar'];
        echo '<script>
                var numeroEliminar = "' . $NumeroEliminar . '";
                if (confirm("¿Estás seguro de que deseas eliminar los datos?")) {
                    // Redirigir al servidor para eliminar los datos
                    location.href = "../Config/Ft_Eliminar_Anota.php?NumeroEliminar=" + numeroEliminar;
                } else {
                    // Cancelar la eliminación, redirigir a otra página o realizar acciones adicionales
                    alert("Eliminación cancelada");
                    location.href = "historial_anotaciones.php";
                }
              </script>';
      }
      ?>
    </div>
  </div>
</main>
<?php include ("$RootPath/templates/HomeFooter.php"); ?>