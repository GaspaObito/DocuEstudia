<?php
require_once(__DIR__ . "/../../config/config.php");
require_once(ROOT_PATH . "/templates/HomeHeader.php");
require_once(ROOT_PATH . "/config/ProtectPages.php");
?>
<main class="ContainerGeneral">
   <h1 id="TitleStart">DASHBOARD <i class="fa-solid fa-chart-line"></i></h1>
 <div id="chart"></div>

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

</main>
<?php include(ROOT_PATH . "/templates/HomeFooter.php"); ?>