<?php
/* ==========================================
   CONTROLLER: DashboardController.php
========================================== */

/* ---------- 1. REQUIRES ---------- */
require_once(__DIR__ . "/../config/config.php");
require_once(ROOT_PATH . "/models/DashboardModel.php");

/* ---------- 3. HELPERS ---------- */
function goToAnnotationsList()
{
  redirectTo("/views/reports/DashboardGeneral.php");
}
function prepararChartData($chartData)
{
  if (in_array($chartData['type'], ['pie', 'donut'])) {
    $chartData['series'] = $chartData['data'];
    $chartData['labels'] = $chartData['categories'];
    // No incluir xaxis/yaxis
    unset($chartData['xTitle'], $chartData['yTitle']);
    unset($chartData['xaxis'], $chartData['yaxis']);
  } else {
    $chartData['series'] = [
      ['name' => 'Promedio', 'data' => $chartData['data']]
    ];
    $chartData['xaxis'] = [
      'categories' => $chartData['categories'],
      'title' => ['text' => $chartData['xTitle']]
    ];
    $chartData['yaxis'] = [
      'title' => ['text' => $chartData['yTitle']]
    ];
  }
  return $chartData;
}

/* ---------- 4. ROUTING ---------- */
$method = $_SERVER['REQUEST_METHOD'];
$action = $_POST['action'] ?? $_GET['action'] ?? '';

/* ---------- 5. GET ACTIONS ---------- */
if ($method === 'GET') {

  switch ($action) {

    /* -------- Listar1 -------- */
    case 'Listar1':
      $data = Promedio_por_Materia($conexion);

      $chartData = [
        'Title' => 'Promedio General por Materia',
        'subTitle' => 'Comparación del promedio académico obtenido en cada materia',
        'xTitle' => 'Materias',
        'yTitle' => 'Promedio Académico',
        'type' => 'bar',
        'categories' => $data['categories'],
        'data' => $data['data']
      ];
      $chartData = prepararChartData($chartData);
      break;

    /* -------- Listar2 -------- */
    case 'Listar2':
      $data = Promedio_por_Estudiante($conexion);

      $chartData = [
        'Title' => 'Promedio General por Estudiante',
        'subTitle' => 'Comparación del rendimiento académico promedio por estudiante',
        'xTitle' => 'Estudiantes',
        'yTitle' => 'Promedio Académico',
        'type' => 'bar',
        'categories' => $data['categories'],
        'data' => $data['data']
      ];
      $chartData = prepararChartData($chartData);
      break;

    /* -------- Listar3 -------- */
    case 'Listar3':
      $data = Evolucion_por_Periodo($conexion);

      $chartData = [
        'Title' => 'Evolución del Promedio Académico por Periodo',
        'subTitle' => 'Tendencia del rendimiento académico a lo largo de los periodos evaluados',
        'xTitle' => 'Periodos Académicos',
        'yTitle' => 'Promedio Académico',
        'type' => 'line',
        'categories' => $data['categories'],
        'data' => $data['data']
      ];
      $chartData = prepararChartData($chartData);
      break;

    /* -------- Listar4 -------- */
    case 'Listar4':
      $data = Estudiantes_en_Riesgo($conexion);

      $chartData = [
        'Title' => 'Estudiantes en Riesgo Académico',
        'subTitle' => 'Cantidad de calificaciones inferiores a 3.0 registradas por estudiante',
        'xTitle' => 'Estudiantes',
        'yTitle' => 'Cantidad de Calificaciones en Riesgo',
        'type' => 'area',
        'categories' => $data['categories'],
        'data' => $data['data']
      ];
      $chartData = prepararChartData($chartData);
      break;

    /* -------- Listar5 -------- */
    case 'Listar5':
      $data = Total_Estudiantes_por_Grado($conexion);

      $chartData = [
        'Title' => 'Total de Estudiantes por Grados',
        'subTitle' => 'Número total de estudiantes matriculados en cada Grado',
        'xTitle' => 'Grados',
        'yTitle' => 'Cantidad de Estudiantes',
        'type' => 'pie',
        'categories' => $data['categories'],
        'data' => $data['data']
      ];
      $chartData = prepararChartData($chartData);
      break;

    /* -------- Listar6 -------- */
    case 'Listar6':
      $data = Promedio_por_Grupo($conexion);

      $chartData = [
        'Title' => 'Promedio Académico por Grupo',
        'subTitle' => 'Comparación del promedio general obtenido por cada grupo',
        'xTitle' => 'Grupos',
        'yTitle' => 'Promedio Académico',
        'type' => 'bar', // o 'donut', o 'bar'
        'categories' => $data['categories'],
        'data' => $data['data']
      ];
      $chartData = prepararChartData($chartData);
      break;

    /* -------- Listar7 -------- */
    case 'Listar7':
      $data = Promedio_por_Grado($conexion);

      $chartData = [
        'Title' => 'Promedio Académico por Grado',
        'subTitle' => 'Comparación del promedio general obtenido por cada grado',
        'xTitle' => 'Grados',
        'yTitle' => 'Promedio Académico',
        'type' => 'donut',
        'categories' => $data['categories'],
        'data' => $data['data']
      ];
      $chartData = prepararChartData($chartData);
      break;

    /* -------- Listar8 -------- */
    case 'Listar8':
      $data = Total_Anotaciones_por_Estudiante($conexion);

      $chartData = [
        'Title' => 'Total Anotaciones por Estudiante',
        'subTitle' => 'Cantidad de observaciones registradas por estudiante',
        'xTitle' => 'Estudiantes',
        'yTitle' => 'Cantidad de Observaciones',
        'type' => 'heatmap',
        'categories' => $data['categories'],
        'data' => $data['data']
      ];
      $chartData = prepararChartData($chartData);
      break;
  }
}