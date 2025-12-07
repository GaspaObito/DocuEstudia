<?php
require_once(__DIR__ . "/../../config/config.php");
require_once(ROOT_PATH . "/templates/HomeHeader.php");
require_once(ROOT_PATH . "/config/ProtectPages.php");
?>
<main class="ContainerGeneral">
   <h1 id="TitleStart">DASHBOARD <i class="fa-solid fa-chart-line"></i></h1>
 <div id="chart"></div>
<!-- 1. Línea — (Ventas y Compras) -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
var options = {
    series: [{
        name: 'Ventas',
        data: [10, 40, 28, 51, 42, 109, 100]
    }],
    chart: {
        height: 350,
        type: 'line'
    },
    xaxis: {
        categories: ['Ene','Feb','Mar','Abr','May','Jun','Jul']
    }
};

var chart = new ApexCharts(document.querySelector("#chart"), options);
chart.render();
</script>

<!-- 2. Barras — Comparación por categorías -->
<div id="chart2"></div>
<script>
var options2 = {
  chart: {
    type: "bar",
    height: 350
  },
  series: [
    { name: "Ventas", data: [44, 55, 41, 67, 22, 43] }
  ],
  xaxis: {
    categories: ["Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"]
  }
};

new ApexCharts(document.querySelector("#chart2"), options2).render();
</script>

<!-- 3. Área — Progreso mensual -->
<div id="chart3"></div>
<script>
var options3 = {
  chart: {
    type: "area",
    height: 350
  },
  series: [
    { name: "Ingresos", data: [10, 25, 30, 50, 42, 70, 80] }
  ],
  xaxis: {
    categories: ["Ene","Feb","Mar","Abr","May","Jun","Jul"]
  }
};

new ApexCharts(document.querySelector("#chart3"), options3).render();
</script>

<!-- 4. Donut — Distribución por categoría -->

<div id="chart4"></div>
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
 <div id="chart5"></div>
<script>
var options5 = {
  chart: {
    type: 'line',
    height: 350,
    stacked: false
  },
  series: [
    {
      name: 'Ventas',
      type: 'column',
      data: [40, 60, 50, 90, 100, 80]
    },
    {
      name: 'Margen %',
      type: 'line',
      data: [20, 30, 25, 35, 40, 38]
    }
  ],
  xaxis: {
    categories: ['Ene','Feb','Mar','Abr','May','Jun']
  }
};

new ApexCharts(document.querySelector("#chart5"), options5).render();
</script>

<!-- 6. Heatmap (Mapa de calor) — Ideal para actividad o asistencia -->

<div id="chart6"></div>
<script>
var options6 = {
  chart: {
    type: 'heatmap',
    height: 350
  },
  series: [
    {
      name: "Actividad",
      data: [
        { x: "Lun", y: 10 },
        { x: "Mar", y: 20 },
        { x: "Mié", y: 9 },
        { x: "Jue", y: 30 },
        { x: "Vie", y: 25 }
      ]
    }
  ]
};

new ApexCharts(document.querySelector("#chart6"), options6).render();
</script>

<!-- 7. Timeline / Gráfico de rango — Ideal para procesos o tareas -->
 <div id="chart7"></div>
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