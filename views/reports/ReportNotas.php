<?php
require_once(__DIR__ . "/../../config/config.php");
require_once ROOT_PATH . '/models/DatabaseConnection.php';
require_once ROOT_PATH . '/views/reports/PdfGenerator.php';
require_once ROOT_PATH . '/models/StudentInfoModel.php';

// Consulta de notas
$result = $conexion->query("SELECT a.IdMateria, b.NomMateria, a.Periodo, a.Nota
FROM mt_notas a INNER JOIN mt_materias b ON a.IdMateria = b.IdMateria
WHERE a.IdObs='$IdObs'
GROUP BY a.IdMateria, b.NomMateria, a.Periodo 
ORDER BY a.Periodo, a.IdMateria;");
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
        <th>Periodo</th>
        <th>Nota</th>
        <th>Acumulado</th>
        <th>Valoracion</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $row['NomMateria'] ?></td>
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