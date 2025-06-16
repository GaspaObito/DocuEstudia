<?php
$RootPath = ($_SERVER['DOCUMENT_ROOT'] . "/proyectos/DocuEstudia");
include ("$RootPath/templates/HomeHeader.php");
include ("$RootPath/models/DatabaseConnection.php");?>

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
  $consultar = mysqli_query($conexion, "SELECT NumDocEst, h.*, o.NumDocEst
        FROM historial_operaciones h
        LEFT JOIN observador o ON h.IdEstOpera = o.IdEst") or die("ERROR AL TRAER LOS DATOS");
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
            <td><?php echo $extraido['NomProfOpera']; ?></td>
            <td><?php echo $extraido['IdAnotaOpera']; ?></td>
            <td><?php echo $extraido['NumDocEst']; ?></td>
            <td><?php echo $extraido['TipoFalAntOpera']; ?></td>
            <td><?php echo $extraido['FecModifOpera']; ?></td>
            <td><?php echo $extraido['TipoCambOpera']; ?></td>
            <td class="descripcion-anterior"><?php echo $extraido['DescAntOpera']; ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</main>
<?php include ("$RootPath/templates/HomeFooter.php"); ?>