<?php
require_once(__DIR__ . "/../../config/config.php");
require_once ROOT_PATH . '/models/DatabaseConnection.php';
require_once ROOT_PATH . '/views/reports/PdfGenerator.php';
require_once ROOT_PATH . '/models/StudentInfoModel.php';

// Consulta de notas
$result = $conexion->query("SELECT a.IdMateria, b.NomMateria,
    AVG(CASE WHEN Periodo = 1 THEN Nota END) AS P1,
    AVG(CASE WHEN Periodo = 2 THEN Nota END) AS P2,
    AVG(CASE WHEN Periodo = 3 THEN Nota END) AS P3,
    AVG(CASE WHEN Periodo = 4 THEN Nota END) AS P4
FROM mt_notas a
INNER JOIN mt_materias b ON a.IdMateria = b.IdMateria 
WHERE a.IdObs = '$IdObs'
GROUP BY a.IdMateria,b.NomMateria
ORDER BY b.NomMateria;");

$html = ''; // inicializar antes de concatenar

$css1 = file_get_contents(ROOT_PATH . '/assets/css/base/Normalize.css');
$css2 = file_get_contents(ROOT_PATH . '/assets/css/base/Globals.css');
$css3 = file_get_contents(ROOT_PATH . '/assets/css/pages/report_styles.css');

$styles = '<style>' . $css1 . $css2 . $css3 . '</style>';

ob_start();
?>
<html>
<style>
  .linea {
    margin: 20px 0;
  }
</style>

<head> <?= $styles ?> </head>

<body>
  <div class="LogoHeader">

  </div>
  <div class="report-header">
    <img src="<?php echo BASE_URL; ?>/assets/logo/favicon.ico">
    <div>
      <h1>DocuEstudia</h1>
      <p>Soacha,Cundinamarca</p>
      <p>Calle 123 #456 N Tel. 444-44-44</p>
      <p>docuestudia@colegio.edu.co</p>
    </div>
    <?php foreach ($datos as $fila) { ?>
      <img width="100" src="<?php echo BASE_URL; ?>/assets/images/photostudent/<?php echo $fila['NomImg'] ?>">
    </div>
    <div class="student-info">
      <table>
        <tr>
          <td><strong>Nombre:</strong> <?php echo $fila['NombreCompleto'] ?></td>
          <td><strong>Fecha:</strong> <?php echo date("d/m/Y"); ?></td>
        </tr>
        <tr>
          <td><strong>Grado:</strong><?php echo $fila['NomGrado'] ?> </td>
          <td><strong>Grupo:</strong><?php echo $fila['IdGrupo'] ?></td>
        </tr>
        <tr>
          <td><strong>Periodo:</strong> 2</td>
        </tr>
      </table>
    <?php } ?>
  </div>

  <h2>Reporte Académico</h2>
  <table class="Custom_Table">
    <thead>
      <tr>
        <th>Asignatura</th>
        <th>P1 - 25%</th>
        <th>P2 - 25%</th>
        <th>P3 - 25%</th>
        <th>P4 - 25%</th>
        <th>Acumulado - 100%</th>
        <th>Valoración</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()):
        $acumulado = ($row['P1'] + $row['P2'] + $row['P3'] + $row['P4']) / 4;
        if ($acumulado >= 4.7) {
          $valoracion = 'Superior';
        } elseif ($acumulado >= 4.0) {
          $valoracion = 'Alto';
        } elseif ($acumulado >= 3.0) {
          $valoracion = 'Básico';
        } else {
          $valoracion = 'Bajo';
        }
        ?>
        <tr>
          <td><?= $row['NomMateria'] ?></td>
          <td><?= number_format($row['P1'], 2) ?></td>
          <td><?= number_format($row['P2'], 2) ?></td>
          <td><?= number_format($row['P3'], 2) ?></td>
          <td><?= number_format($row['P4'], 2) ?></td>
          <td><?= number_format($acumulado, 2) ?></td>
          <td><?= $valoracion ?></td>

        </tr>

      <?php endwhile; ?>

    </tbody>
  </table>

  <div style="margin-top:3rem;">
    <!-- Escala -->
    <table width="100%">
      <tr>
        <td width="30%" valign="top">
          <table class="Custom_Table" width="100%">
            <tr>
              <th colspan="3">
                Escala de Valoración
              </th>
            </tr>
            <tr>
              <td>Superior</td>
              <td>S</td>
              <td>(4.7 - 5.0)</td>
            </tr>
            <tr>
              <td>Alto</td>
              <td>A</td>
              <td>(4.0 - 4.6)</td>
            </tr>
            <tr>
              <td>Básico</td>
              <td>Bs</td>
              <td>(3.0 - 3.9)</td>
            </tr>
            <tr>
              <td>Bajo</td>
              <td>BJ</td>
              <td>(1.0 - 2.9)</td>
            </tr>
          </table>
        </td>
        <!-- Observaciones -->
        <td width="60%" valign="top">
          <h3 style="text-align:center">OBSERVACIONES</h3>
          <br>
          <hr class="linea">
          <hr class="linea">
          <hr class="linea">
          <hr class="linea">
        </td>
      </tr>
    </table>
  </div>
  <!-- Firmas -->
  <br>
  <br>
  <table width="100%">
    <tr>
      <td width="50%" gap="10px">
        <hr class="linea">
        <h3 style="text-align:center">RECTOR</h3>
      </td>
      <td width="50%">
        <hr class="linea">
        <h3 style="text-align:center">DIRECTOR DE CURSO</h3>
      </td>
    </tr>
  </table>
</body>

</html>

<?php
$html = ob_get_clean();
// Generar PDF
PdfGenerator::render($html, "reporte_notas.pdf");