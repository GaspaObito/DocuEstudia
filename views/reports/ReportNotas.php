<?php
require_once(__DIR__ . "/../../config/config.php");
require_once ROOT_PATH . '/models/DatabaseConnection.php';
require_once ROOT_PATH . '/views/reports/PdfGenerator.php';

// Consulta de notas
$result = $conexion->query("SELECT IdMateria, Periodo, Nota FROM mt_notas ORDER BY Periodo, IdMateria");
$html = ''; // inicializar antes de concatenar

$css1 = file_get_contents(ROOT_PATH . '/assets/css/base/Normalize.css');
$css2 = file_get_contents(ROOT_PATH . '/assets/css/base/Globals.css');
$css3 = file_get_contents(ROOT_PATH . '/assets/css/pages/report_styles.css');

$styles = '<style>' . $css1 . $css2 . $css3 . '</style>';

ob_start();
?>
<html>

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
      <p>Email@colegio.edu.co</p>
    </div>
    <img src="<?php echo BASE_URL; ?>/assets/images/phototeacher/Profesor_411121141.jpg">
  </div>
  <div class="student-info">
    <table>
      <tr>
        <td><strong>Nombre:</strong> CORREA OCAMPO GUADALUPE</td>
        <td><strong>Fecha:</strong> 15/08/2023</td>
      </tr>
      <tr>
        <td><strong>Año:</strong> 2023</td>
        <td><strong>Grado:</strong> 5° 5°B</td>
      </tr>
      <tr>
        <td><strong>Periodo:</strong> 2</td>
      </tr>
    </table>
  </div>
  <h2>Reporte Académico</h2>
  <table class="Custom_Table">
    <thead>
      <tr>
        <th>Aignatura</th>
        <th>Periodo</th>
        <th>Nota</th>
        <th>Acumulado</th>
        <th>Valoracion</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $row['IdMateria'] ?></td>
          <td><?= $row['Periodo'] ?></td>
          <?php
          $nota = $row['Nota'];
          $valoracion = '';

          if ($nota >= 4.7 && $nota <= 5.0) {
            $valoracion = 'Superior';
          } elseif ($nota >= 4.0 && $nota <= 4.6) {
            $valoracion = 'Alto';
          } elseif ($nota >= 3.0 && $nota <= 3.9) {
            $valoracion = 'Básico';
          } elseif ($nota >= 1.0 && $nota <= 2.9) {
            $valoracion = 'Bajo';
          } else {
            $valoracion = 'Sin valoración';
          }
          ?>

          <td><?= number_format($nota, 2) ?></td>
          <td><?= $row['Periodo'] ?></td>
          <td><?= $valoracion ?></td>

        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</body>

</html>
<?php
$html = ob_get_clean();
// Generar PDF
PdfGenerator::render($html, "reporte_notas.pdf");