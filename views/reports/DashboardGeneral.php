<?php
require_once(__DIR__ . "/../../config/config.php");
require_once(ROOT_PATH . "/templates/HomeHeader.php");
require_once(ROOT_PATH . "/config/ProtectPages.php");
require_once(ROOT_PATH . "/controllers/DashboardController.php");
?>
<main class="ContainerGeneral">
  
  <h1 id="TitleStart">DASHBOARDS <i class="fa-solid fa-chart-line"></i></h1>
  <ul class="formulario__campos1 list_Reports">
    <a class="boton" href="<?php echo BASE_URL; ?>/views/reports/DashboardGeneral.php?action=Listar1">Promedio por Materia</a>
    <a class="boton" href="<?php echo BASE_URL; ?>/views/reports/DashboardGeneral.php?action=Listar2">Promedio por Estudiante</a>
    <a class="boton" href="<?php echo BASE_URL; ?>/views/reports/DashboardGeneral.php?action=Listar3">Evolucion por Periodo</a>
    <a class="boton" href="<?php echo BASE_URL; ?>/views/reports/DashboardGeneral.php?action=Listar4">Estudiantes en Riesgo</a>
    <a class="boton" href="<?php echo BASE_URL; ?>/views/reports/DashboardGeneral.php?action=Listar5">Total estudiantes por Grado</a>
    <a class="boton" href="<?php echo BASE_URL; ?>/views/reports/DashboardGeneral.php?action=Listar6">Promedio por Grupo</a>
    <a class="boton" href="<?php echo BASE_URL; ?>/views/reports/DashboardGeneral.php?action=Listar7">Promedio por Grado</a>
    <a class="boton" href="<?php echo BASE_URL; ?>/views/reports/DashboardGeneral.php?action=Listar8">Total Anotaciones por Estudiante</a>
  </ul>
  <!-- 1. Línea — (Ventas y Compras) -->
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

  <div id="chart" class="Dashboard"> </div>

<script>
  var options = {
    chart: {
      height: 600,
      type: '<?php echo $chartData["type"]; ?>'
    },

    series: <?php echo json_encode($chartData['series']); ?>,
    labels: <?php echo json_encode($chartData['labels'] ?? []); ?>,

    title: {
      text: '<?php echo $chartData["Title"]; ?>',
      align: 'center',
      style: {fontSize: '24px', fontWeight: 'bold'}
    },

    subtitle: {
      text: '<?php echo $chartData["subTitle"]; ?>',
      align: 'center'
    },

    <?php if (!empty($chartData['xaxis'])): ?>
    xaxis: <?php echo json_encode($chartData['xaxis']); ?>,
    <?php endif; ?>

    <?php if (!empty($chartData['yaxis'])): ?>
    yaxis: <?php echo json_encode($chartData['yaxis']); ?>,
    <?php endif; ?>
  };

  new ApexCharts(document.querySelector("#chart"), options).render();
</script>
</main>

<?php include(ROOT_PATH . "/templates/HomeFooter.php"); ?>