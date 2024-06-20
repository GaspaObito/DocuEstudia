<?php include ("../../templates/AnnotationHeader.php");
include '../../models/DatabaseConnection.php'; ?>
<main class="ContainerGeneral">
  <div class="ContainerUser">
    <div class="usuario__especifico">
      <?php
      if (isset($_POST['Id_Est'])) {
        $Id_Est = $_POST['Id_Est'];
        $_SESSION['Id_Session'] = $Id_Est;
      }
      $Id_Est = $_SESSION['Id_Session'];
      /* Utilizar Join para Ingresar el otro Campos de Curso */
      $consultar = mysqli_query($conexion, "SELECT CONCAT(o.Nombre_Estudiante, ' ', o.Apellido_Estudiante) AS NombreCompleto, o.*, c.Nom_Curso, i.Nombre_Imagen
            FROM observador o LEFT JOIN imagenes i ON o.Id_Imagen = i.Id_Imagen LEFT JOIN curso c ON o.Id_Curso = c.Id_Curso WHERE o.Id_Estudiante='$Id_Est'") or die("ERROR AL TRAER LOS DATOS");
      while ($extraido = mysqli_fetch_array($consultar)) { ?>
        <h3 id="DataUser">Perfil</h3>
        <div class="imagen">
          <img width="100"
            src="<?php echo BASE_URL; ?>/assets/images/photostude2nt/<?php echo $extraido['Nombre_Imagen'] ?>">
        </div>
        <h3 id="DataUser">DATOS DEL ESTUDIANTE</h3>
        <div class="usuario__campo">
          <?php $IdGeneral = $extraido['Id_Estudiante'];
          $NomGeneral = $extraido['NombreCompleto']; ?>
          <label>Nombre:</label>
          <input type="hidden" name="Id_Est" value="<?php $_SESSION['Id_Session'] ?>">
          <input readonly class="Input_Text" type="text" value="<?php echo $extraido['NombreCompleto'] ?>">
        </div>
        <div class="usuario__campo">
          <label>N.I:</label>
          <input readonly class="Input_Text" type="text" value="<?php echo $extraido['Numero_Documento'] ?>">
        </div>
        <div class="usuario__campo">
          <label>Curso:</label>
          <input readonly class="Input_Text" type="text" value="<?php echo $extraido['Nom_Curso'] ?>">
        </div>
      <?php } ?>
    </div>
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
      $consultar2 = mysqli_query($conexion, "select * from anotacion WHERE Id_Estudiante='$Id_Est'") or die("ERROR AL TRAER LOS DATOS");
      $query = "SELECT COUNT(*) AS total FROM anotacion WHERE Id_Estudiante='$Id_Est'";
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
                <td><?php echo $extraido['Tipo_Falta'] ?></td>
                <td><?php echo $extraido['Fecha_Creacion'] ?></td>
                <td><?php echo $extraido['Fecha_Modificacion'] ?></td>
                <td class="td_Actions">
                  <form action="historial_anotaciones.php" method="post">
                    <input type="hidden" name="NumeroEliminar" value="<?php echo $extraido['Id_Anotacion'] ?>">
                    <button name="EliminarDato" class="custom-button" type="submit">
                      <svg class="navbar-icon" style="margin:0">
                        <use xlink:href="<?php echo BASE_URL; ?>/assets/images/svg/Trash.svg#Trash-icon">
                      </svg>
                    </button>
                  </form>
                  <form action="AnnotationsDescription.php" method="post">
                    <input type="hidden" name="NumeroModificar" value="<?php echo $extraido['Id_Anotacion'] ?>">
                    <input type="hidden" name="NumeroInsertar" value="<?php echo $Id_Est ?>">
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
<?php include ("../../templates/TeacherFooter.php"); ?>