<?php
require_once(__DIR__ . "/../config/config.php");
require_once (ROOT_PATH."/templates/HomeHeader.php");
require_once (ROOT_PATH."/models/DatabaseConnection.php");
?>
<main class="ContainerGeneral" style="max-height: 180rem;">
  <div class="nav__miniventana">
    <a></a>
    <h1 id="TitleStart">HISTORIAL DE ACCIONES <i class="fa-solid fa-clock-rotate-left"></i></h1>
    <div>
      <a href="<?php echo BASE_URL; ?>/controllers/teacher/AnnotationsSearch.php">
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
  $sql_triggerOper = mysqli_query($conexion, "SELECT h.*,u.NumDcto FROM historial_operaciones h
        LEFT JOIN observador o ON h.IdEstOpera = o.IdObs
        LEFT JOIN usuarios u ON u.IdUser = o.IdUser ORDER BY FecModifOpera DESC") or die("ERROR AL TRAER LOS DATOS");
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
        <?php while ($extraido = mysqli_fetch_array($sql_triggerOper)) { ?>
          <tr>
            <td><?php echo $extraido['NomProfOpera']; ?></td>
            <td><?php echo $extraido['IdAnotaOpera']; ?></td>
            <td><?php echo $extraido['NumDcto']; ?></td>
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
<?php include (ROOT_PATH."/templates/HomeFooter.php"); ?>