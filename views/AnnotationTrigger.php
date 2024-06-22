<?php
$RootPath = ($_SERVER['DOCUMENT_ROOT'] . "/proyectos/DocuEstudia");
include ("$RootPath/templates/HomeHeader.php");?>
<main class="ContainerGeneral" style="max-height: 180rem;">
  <div class="nav__miniventana">
    <a></a>
    <h1 id="TitleStart">HISTORIAL DE ACCIONES</h1>
    <div>
      <a href="../Profesor/anotaciones_busc.php">
        <div class="botonAtras">
          <div class="margen__boton">
            <svg class="navbar-icon" style="margin:0;">
              <use xlink:href="../Assets/Svg/Arrow_Back.svg#Arrow_Back-icon">
            </svg>
          </div>
        </div>
      </a>
    </div>
  </div>
  <?php
  include 'Conexion.php';
  $consultar = mysqli_query($conexion, "SELECT Numero_Documento, h.*, o.Numero_Documento
        FROM historial_operaciones h
        LEFT JOIN observador o ON h.Id_Estudiante = o.Id_Estudiante") or die("ERROR AL TRAER LOS DATOS");
  $query = "SELECT COUNT(*) AS total FROM historial_operaciones";
  $resultado = mysqli_query($conexion, $query);
  $datos = mysqli_fetch_assoc($resultado);
  $totalFilas = $datos['total'];
  ?>
  <div class="Container1" style="height: 80rem;">
    <div><label>Resultados Obtenidos: (<?php echo $totalFilas ?>)</label></div>
    <table class="Custom_Table">
      <thead>
        <tr>
          <th>Nombre_Usuario</th>
          <th>Id_Anota</th>
          <th>N.I Estudiante</th>
          <th>Falta_Anterior</th>
          <th>Fecha_Modificacion</th>
          <th>Tipo_cambio</th>
          <th>Descripcion_Anterior</th>
        </tr>
      </thead>
      <!-- TITULO DE LAS COLUMNAS -->
      <!-- CUERPO DE LA TABLA -->
      <tbody>
        <?php while ($extraido = mysqli_fetch_array($consultar)) { ?>
          <tr>
            <td><?php echo $extraido['Nombre_Profesor']; ?></td>
            <td><?php echo $extraido['Id_Anotacion']; ?></td>
            <td><?php echo $extraido['Numero_Documento']; ?></td>
            <td><?php echo $extraido['TipoFalta_Anterior']; ?></td>
            <td><?php echo $extraido['Fecha_Modificacion']; ?></td>
            <td><?php echo $extraido['Tipo_cambio']; ?></td>
            <td class="descripcion-anterior"><?php echo $extraido['Descripcion_Anterior']; ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</main>
<?php include ("$RootPath/templates/HomeFooter.php"); ?>