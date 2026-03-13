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

      series: [{
        name: 'Promedio',
        data: <?php echo json_encode($chartData['data']); ?>
      }],

      title: {
        text: '<?php echo $chartData["Title"]; ?>',
        align: 'center',
        style: {fontSize: '24px', fontWeight: 'bold'}
      },

      subtitle: {text: '<?php echo $chartData["subTitle"]; ?>', align: 'center'},

      xaxis: {
        categories: <?php echo json_encode($chartData['categories']); ?>,
        title: { text: '<?php echo $chartData["xTitle"]; ?>' }
      },
      
      yaxis: {
        title: { text: '<?php echo $chartData["yTitle"]; ?>' }
      }
    };
    new ApexCharts(document.querySelector("#chart"), options).render();
  </script>
  
<!-- 4. Donut — Distribución por categoría -->
<div id="chart4 "></div>
<script>
var options4 = {
  chart: {
    type: "donut",
    height: 350
  },
  series: [44, 33, 54],
  labels: ["Ropa", "Calzado", "Accesorios"]
};
new ApexCharts(document.querySelector("#chart4"), options4).render();
</script>

<!-- 5. Mixto (Barras + Línea) — Ideal para ventas vs margen -->
 <div id="chart5 "></div>
<script>
var options5 = {
  chart: {
    type: 'line',
    height: 350,
    stacked: false
  },
  series: [
    {
      name: 'Ventas', type: 'column', data: [40, 60, 50, 90, 100, 80]
    },
    {
      name: 'Margen %', type: 'line', data: [20, 30, 25, 35, 40, 38]
    }
  ],
  xaxis: {
    categories: ['Ene','Feb','Mar','Abr','May','Jun']
  }
};

new ApexCharts(document.querySelector("#chart5"), options5).render();
</script>

<!-- 7. Timeline / Gráfico de rango — Ideal para procesos o tareas -->
 <div id="chart7 "></div>
<script>
var options7 = {
  chart: {
    type: 'rangeBar',
    height: 350
  },
  plotOptions: {
    bar: {
      horizontal: true
    }
  },
  series: [{
    data: [
      { x: 'Fase 1', y: [new Date('2025-01-01').getTime(), new Date('2025-01-10').getTime()] },
      { x: 'Fase 2', y: [new Date('2025-01-11').getTime(), new Date('2025-01-20').getTime()] },
      { x: 'Fase 3', y: [new Date('2025-01-11').getTime(), new Date('2025-01-20').getTime()] }
    ]
  }],
  xaxis: {
    type: 'datetime'
  }
};
new ApexCharts(document.querySelector("#chart7"), options7).render();
</script>

</main>

<?php include(ROOT_PATH . "/templates/HomeFooter.php"); ?>